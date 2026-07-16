<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '256M'); // สบายใจได้ ฟังก์ชัน fgetcsv กินแรมไม่ถึง 5MB แม้ไฟล์จะใหญ่มาก

// บังคับการอ่านภาษาไทย/ลาวในไฟล์ CSV สำหรับ PHP 7.4 เพื่อป้องกันตัวอักษรต่างดาว
setlocale(LC_ALL, 'th_TH.UTF-8');

// ==========================================
// 🛠️ ZONE 1: ระบบตรวจสอบฟอร์มและเซิร์ฟเวอร์ (ป้องกันอาการนิ่ง/หน้าขาว)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. ตรวจสอบว่าขนาดไฟล์ใหญ่เกินกว่าที่เซิร์ฟเวอร์ยอมรับหรือไม่
    if (empty($_POST) && empty($_FILES)) {
        die("<div style='color:red; font-size:18px; padding:20px; font-family:sans-serif;'>
                ❌ <b>เซิร์ฟเวอร์ปฏิเสธข้อมูล:</b> ไฟล์ CSV อาจมีขนาดใหญ่เกินไป<br>
                กรุณาตรวจสอบค่า <code>upload_max_filesize</code> และ <code>post_max_size</code> ในไฟล์ php.ini ครับ
             </div>");
    }
    // 2. ตรวจสอบชื่อปุ่มในฟอร์ม HTML ว่าสะกดตรงกันไหม
    if (!isset($_POST['import'])) {
        die("<div style='color:orange; font-size:18px; padding:20px; font-family:sans-serif;'>
                ⚠️ <b>หาปุ่มส่งไม่เจอ:</b> ในฟอร์ม HTML ปุ่มกดของคุณต้องตั้งชื่อว่า <code>name='import'</code> ครับ
             </div>");
    }
    // 3. ตรวจสอบชื่อ input file ในฟอร์ม HTML
    if (!isset($_FILES['excel_file'])) {
        die("<div style='color:orange; font-size:18px; padding:20px; font-family:sans-serif;'>
                ⚠️ <b>หาช่องเลือกไฟล์ไม่เจอ:</b> ในฟอร์ม HTML ช่องอัปโหลดต้องตั้งชื่อว่า <code>name='excel_file'</code> ครับ
             </div>");
    }
}

// ==========================================
// ⚙️ ZONE 2: เรียกใช้ไฟล์เชื่อมต่อตารางข้อมูล และฟังก์ชันแปลงคอลัมน์
// ==========================================
include("init.php");

if (!isset($con) || !$con) {
    die("❌ <b>การเชื่อมต่อล้มเหลว:</b> ไม่พบตัวแปรเชื่อมต่อฐานข้อมูล <code>\$con</code> กรุณาตรวจสอบไฟล์ init.php");
}

/**
 * ฟังก์ชันแปลงชื่อคอลัมน์ Excel (A, B, C...) ให้เป็นตัวเลข Index ของอาเรย์ PHP (เริ่มจาก 0)
 * ทำให้เขียนโค้ดระบุคอลัมน์ได้ง่ายเหมือนเดิม โดยไม่ต้องนั่งนับเลข
 */
function excelColumnToIndex($column) {
    $column = strtoupper(trim($column));
    $length = strlen($column);
    $index = 0;
    for ($i = 0; $i < $length; $i++) {
        $index = $index * 26 + (ord($column[$i]) - ord('A') + 1);
    }
    return $index - 1; 
}

// ==========================================
// 🚀 ZONE 3: เริ่มกระบวนการแกะและนำเข้าไฟล์ CSV
// ==========================================
if (isset($_POST['import'])) {
    
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName    = $_FILES['excel_file']['name'];
    
    // ตรวจสอบนามสกุลไฟล์
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension !== 'csv') {
        echo "<script>alert('ข้อผิดพลาด: กรุณาอัปโหลดเฉพาะไฟล์นามสกุล .csv เท่านั้น');window.history.back();</script>";
        exit;
    }

    try {
        if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
            
            // ระบบตรวจสอบตัวคั่นคำใน CSV อัตโนมัติ (รองรับทั้งเครื่องหมาย , และ ; )
            $firstLine = fgets($handle);
            $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
            rewind($handle); // รีเซ็ตหัวอ่านกลับไปบรรทัดแรกสุดใหม่

            // เตรียมคำสั่ง SQL (เปลี่ยนชื่อฟิลด์ตามโครงสร้างตารางลูกค้าของคุณ)
            $sql = "INSERT INTO customer_import (
                        external_id, outlet_name, outlet_name_la, phone_number, 
                        Province, district, village,
  region_LA,
  Province_LA,
  Village_LA,
  latitude,
  longitude,
  business_segment_code,
  channel_code,
  sub_channel_full,
  classification_code,
  Sale_Id,
  Sale_full_name,
  credit,
  Debt_collection,
  Number_of_days_overdue,
  Contract_expiration_date


                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                $count = 0;
                $rowIndex = 0;

                // วนลูปอ่านไฟล์ CSV ทีละบรรทัด
                while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                    $rowIndex++;

                    // ข้ามแถวแรกที่เป็นหัวตาราง (Header)
                    if ($rowIndex == 1) continue;

                    // ดึงข้อมูลแต่ละคอลัมน์โดยใช้ชื่ออักษรแบบ Excel (A, B, C, D, F, G, H)
                    $external_id    = isset($data[excelColumnToIndex('A')]) ? trim((string)$data[excelColumnToIndex('A')]) : '';
                    $outlet_name    = isset($data[excelColumnToIndex('B')]) ? trim((string)$data[excelColumnToIndex('B')]) : '';
                    $outlet_name_la = isset($data[excelColumnToIndex('C')]) ? trim((string)$data[excelColumnToIndex('C')]) : '';
                    $phone_number   = isset($data[excelColumnToIndex('D')]) ? trim((string)$data[excelColumnToIndex('D')]) : '';
                    $Province       = isset($data[excelColumnToIndex('F')]) ? trim((string)$data[excelColumnToIndex('F')]) : '';
                    $district       = isset($data[excelColumnToIndex('G')]) ? trim((string)$data[excelColumnToIndex('G')]) : '';
                    $village        = isset($data[excelColumnToIndex('H')]) ? trim((string)$data[excelColumnToIndex('H')]) : '';

                    $region_LA    = isset($data[excelColumnToIndex('A')]) ? trim((string)$data[excelColumnToIndex('I')]) : '';
                    $Province_LA    = isset($data[excelColumnToIndex('B')]) ? trim((string)$data[excelColumnToIndex('J')]) : '';
                    $Village_LA = isset($data[excelColumnToIndex('C')]) ? trim((string)$data[excelColumnToIndex('K')]) : '';
                    $latitude   = isset($data[excelColumnToIndex('D')]) ? trim((string)$data[excelColumnToIndex('L')]) : '';
                    $longitude       = isset($data[excelColumnToIndex('F')]) ? trim((string)$data[excelColumnToIndex('M')]) : '';
                    $business_segment_code       = isset($data[excelColumnToIndex('G')]) ? trim((string)$data[excelColumnToIndex('N')]) : '';
                    $channel_code        = isset($data[excelColumnToIndex('H')]) ? trim((string)$data[excelColumnToIndex('O')]) : '';


                    $sub_channel_full    = isset($data[excelColumnToIndex('A')]) ? trim((string)$data[excelColumnToIndex('P')]) : '';
                    $classification_code    = isset($data[excelColumnToIndex('B')]) ? trim((string)$data[excelColumnToIndex('Q')]) : '';
                    $Sale_Id = isset($data[excelColumnToIndex('C')]) ? trim((string)$data[excelColumnToIndex('R')]) : '';
                    $Sale_full_name   = isset($data[excelColumnToIndex('D')]) ? trim((string)$data[excelColumnToIndex('S')]) : '';
                    $credit       = isset($data[excelColumnToIndex('F')]) ? trim((string)$data[excelColumnToIndex('T')]) : '';
                    $Debt_collection       = isset($data[excelColumnToIndex('G')]) ? trim((string)$data[excelColumnToIndex('U')]) : '';
                    $Number_of_days_overdue        = isset($data[excelColumnToIndex('H')]) ? trim((string)$data[excelColumnToIndex('V')]) : '';

$raw_date = isset($data[excelColumnToIndex('W')]) ? trim((string)$data[excelColumnToIndex('W')]) : '';

// 2. ตรวจสอบและแปลงให้เป็นรูปแบบ YYYY-MM-DD (ปี-เดือน-วัน)
if (!empty($raw_date)) {
    // แทนที่เครื่องหมาย / ด้วย - เพื่อให้ PHP เข้าใจฟอร์แมต วัน-เดือน-ปี ของฝั่งเอเชีย/ยุโรป ได้ถูกต้อง
    $clean_date = str_replace('/', '-', $raw_date);
    $time = strtotime($clean_date);
    
    // ถ้าแปลงค่าสำเร็จ ให้จัดฟอร์แมตเป็น ปี-เดือน-วัน (เช่น 2026-06-23) ถ้าล้มเหลวให้เป็นค่าว่าง
    $Contract_expiration_date = ($time !== false) ? date('Y-m-d', $time) : '';
} else {
    $Contract_expiration_date = '';
}


                    // ตรวจสอบ: จะบันทึกเฉพาะแถวที่มี รหัสลูกค้า (external_id) เท่านั้น เพื่อป้องกันแถวว่างท้ายไฟล์
                    if ($external_id !== '') {
                        
                        // ผูกตัวแปรเข้ากับคำสั่ง SQL ("sssssss" หมายถึงมีตัวแปรแบบ String ทั้งหมด 7 ตัว)
                        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssss", 
                            $external_id, 
                            $outlet_name, 
                            $outlet_name_la, 
                            $phone_number,
                            $Province,
                            $district, 
                            $village,
$region_LA,
$Province_LA,
$Village_LA,
$latitude,
$longitude,
$business_segment_code,
$channel_code,
$sub_channel_full,
$classification_code,
$Sale_Id,
$Sale_full_name,
$credit,
$Debt_collection,
$Number_of_days_overdue,
$Contract_expiration_date

                        );
                        
                        // สั่งบันทึกลงฐานข้อมูล ถ้าเกิดปัญหาที่ระบบฐานข้อมูลให้แสดง Error ทันที
                        if (!mysqli_stmt_execute($stmt)) {
                            die("<div style='color:red; padding:20px; font-family:sans-serif;'>
                                    ❌ <b>MySQL Execute Error ในแถวที่ $rowIndex:</b> " . mysqli_stmt_error($stmt) . "
                                 </div>");
                        }
                        $count++;
                    }
                }

                // ทำความสะอาดและเคลียร์หน่วยความจำ
                fclose($handle);
                mysqli_stmt_close($stmt);

                echo "<script>alert('นำเข้าข้อมูลลูกค้าสำเร็จทั้งหมด $count แถว!');window.location='customer_list.php';</script>";

            } else {
                echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . mysqli_error($con);
            }
        } else {
            echo "ไม่สามารถเปิดไฟล์ CSV ได้";
        }
        
    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาดในระบบ: " . $e->getMessage();
    }
}



mysqli_query($con,"TRUNCATE customers");



mysqli_query($con,"INSERT INTO customers (customer_id, customer_name, phone, village,district)
SELECT external_id, outlet_name, phone_number, village,district
FROM customer_import");


mysqli_query($con,"TRUNCATE customer_import");

mysqli_close($con);
?>