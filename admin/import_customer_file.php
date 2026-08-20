<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '256M');

// บังคับการอ่านภาษาไทย/ลาวในไฟล์ CSV สำหรับ PHP 7.4
setlocale(LC_ALL, 'th_TH.UTF-8');

// ==========================================
// 🛠️ ZONE 1: ระบบตรวจสอบฟอร์มและเซิร์ฟเวอร์
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST) && empty($_FILES)) {
        die("<div style='color:red; font-size:18px; padding:20px; font-family:sans-serif;'>
                ❌ <b>เซิร์ฟเวอร์ปฏิเสธข้อมูล:</b> ไฟล์ CSV อาจมีขนาดใหญ่เกินไป<br>
                กรุณาตรวจสอบค่า <code>upload_max_filesize</code> และ <code>post_max_size</code> ในไฟล์ php.ini ครับ
             </div>");
    }
    if (!isset($_POST['import'])) {
        die("<div style='color:orange; font-size:18px; padding:20px; font-family:sans-serif;'>
                ⚠️ <b>หาปุ่มส่งไม่เจอ:</b> ในฟอร์ม HTML ปุ่มกดของคุณต้องตั้งชื่อว่า <code>name='import'</code> ครับ
             </div>");
    }
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
 * แปลงชื่อคอลัมน์ Excel (A, B, C...) ให้เป็น Index อาเรย์ PHP
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
// 🚀 ZONE 3: เริ่มกระบวนการแกะ นำเข้า และซิงค์ข้อมูล
// ==========================================
if (isset($_POST['import'])) {
    
    $fileTmpPath   = $_FILES['excel_file']['tmp_name'];
    $fileName      = $_FILES['excel_file']['name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($fileExtension !== 'csv') {
        echo "<script>alert('ข้อผิดพลาด: กรุณาอัปโหลดเฉพาะไฟล์นามสกุล .csv เท่านั้น');window.history.back();</script>";
        exit;
    }

    try {
        if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
            
            // ตรวจสอบตัวคั่นคำ ( , หรือ ; )
            $firstLine = fgets($handle);
            $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
            rewind($handle);

            // 1. เตรียม Prepared Statements สำหรับตารางพัก customer_import (เช็ก, อัปเดต, เพิ่ม)
            $checkImportStmt  = mysqli_prepare($con, "SELECT external_id FROM customer_import WHERE external_id = ?");
            $updateImportStmt = mysqli_prepare($con, "UPDATE customer_import SET 
                outlet_name = ?, outlet_name_la = ?, phone_number = ?, Province = ?, district = ?, village = ?, 
                region_LA = ?, Province_LA = ?, Village_LA = ?, latitude = ?, longitude = ?, 
                business_segment_code = ?, channel_code = ?, sub_channel_full = ?, classification_code = ?, 
                Sale_Id = ?, Sale_full_name = ?
                WHERE external_id = ?");
            $insertImportStmt = mysqli_prepare($con, "INSERT INTO customer_import (
                external_id, outlet_name, outlet_name_la, phone_number, Province, district, village, 
                region_LA, Province_LA, Village_LA, latitude, longitude, business_segment_code, 
                channel_code, sub_channel_full, classification_code, Sale_Id, Sale_full_name
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            // 2. เตรียม Prepared Statements สำหรับตารางหลัก customers (เช็ก, อัปเดต, เพิ่ม)
            $checkCustStmt  = mysqli_prepare($con, "SELECT customer_id FROM customers WHERE customer_id = ?");
            $updateCustStmt = mysqli_prepare($con, "UPDATE customers SET customer_name = ?, phone = ?, village = ?, district = ? WHERE customer_id = ?");
            $insertCustStmt = mysqli_prepare($con, "INSERT INTO customers (customer_id, customer_name, phone, village, district) VALUES (?, ?, ?, ?, ?)");

            if ($checkImportStmt && $updateImportStmt && $insertImportStmt && $checkCustStmt && $updateCustStmt && $insertCustStmt) {
                $count = 0;
                $rowIndex = 0;

                while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                    $rowIndex++;
                    if ($rowIndex == 1) continue; // ข้าม Header

                    $external_id           = isset($data[excelColumnToIndex('A')]) ? trim((string)$data[excelColumnToIndex('A')]) : '';
                    $outlet_name           = isset($data[excelColumnToIndex('B')]) ? trim((string)$data[excelColumnToIndex('B')]) : '';
                    $outlet_name_la        = isset($data[excelColumnToIndex('C')]) ? trim((string)$data[excelColumnToIndex('C')]) : '';
                    $phone_number          = isset($data[excelColumnToIndex('D')]) ? trim((string)$data[excelColumnToIndex('D')]) : '';
                    $Province              = isset($data[excelColumnToIndex('F')]) ? trim((string)$data[excelColumnToIndex('F')]) : '';
                    $district              = isset($data[excelColumnToIndex('G')]) ? trim((string)$data[excelColumnToIndex('G')]) : '';
                    $village               = isset($data[excelColumnToIndex('H')]) ? trim((string)$data[excelColumnToIndex('H')]) : '';
                    $region_LA             = isset($data[excelColumnToIndex('I')]) ? trim((string)$data[excelColumnToIndex('I')]) : '';
                    $Province_LA           = isset($data[excelColumnToIndex('J')]) ? trim((string)$data[excelColumnToIndex('J')]) : '';
                    $Village_LA            = isset($data[excelColumnToIndex('K')]) ? trim((string)$data[excelColumnToIndex('K')]) : '';
                    $latitude              = isset($data[excelColumnToIndex('L')]) ? trim((string)$data[excelColumnToIndex('L')]) : '';
                    $longitude             = isset($data[excelColumnToIndex('M')]) ? trim((string)$data[excelColumnToIndex('M')]) : '';
                    $business_segment_code = isset($data[excelColumnToIndex('N')]) ? trim((string)$data[excelColumnToIndex('N')]) : '';
                    $channel_code          = isset($data[excelColumnToIndex('O')]) ? trim((string)$data[excelColumnToIndex('O')]) : '';
                    $sub_channel_full      = isset($data[excelColumnToIndex('P')]) ? trim((string)$data[excelColumnToIndex('P')]) : '';
                    $classification_code   = isset($data[excelColumnToIndex('Q')]) ? trim((string)$data[excelColumnToIndex('Q')]) : '';
                    $Sale_Id               = isset($data[excelColumnToIndex('R')]) ? trim((string)$data[excelColumnToIndex('R')]) : '';
                    $Sale_full_name        = isset($data[excelColumnToIndex('S')]) ? trim((string)$data[excelColumnToIndex('S')]) : '';

                    if ($external_id !== '') {
                        
                        // ==========================================
                        // A. จัดการตาราง customer_import (WHERE + IF-ELSE)
                        // ==========================================
                        mysqli_stmt_bind_param($checkImportStmt, "s", $external_id);
                        mysqli_stmt_execute($checkImportStmt);
                        mysqli_stmt_store_result($checkImportStmt);

                        if (mysqli_stmt_num_rows($checkImportStmt) > 0) {
                            // IF: พบใน customer_import -> UPDATE
                            mysqli_stmt_bind_param($updateImportStmt, "ssssssssssssssssss", 
                                $outlet_name, $outlet_name_la, $phone_number, $Province, $district, $village, 
                                $region_LA, $Province_LA, $Village_LA, $latitude, $longitude, 
                                $business_segment_code, $channel_code, $sub_channel_full, $classification_code, 
                                $Sale_Id, $Sale_full_name, $external_id
                            );
                            mysqli_stmt_execute($updateImportStmt);
                        } else {
                            // ELSE: ไม่พบใน customer_import -> INSERT
                            mysqli_stmt_bind_param($insertImportStmt, "ssssssssssssssssss", 
                                $external_id, $outlet_name, $outlet_name_la, $phone_number, $Province, $district, $village, 
                                $region_LA, $Province_LA, $Village_LA, $latitude, $longitude, 
                                $business_segment_code, $channel_code, $sub_channel_full, $classification_code, 
                                $Sale_Id, $Sale_full_name
                            );
                            mysqli_stmt_execute($insertImportStmt);
                        }

                        // ==========================================
                        // B. จัดการตาราง customers (WHERE + IF-ELSE)
                        // ==========================================
                        mysqli_stmt_bind_param($checkCustStmt, "s", $external_id);
                        mysqli_stmt_execute($checkCustStmt);
                        mysqli_stmt_store_result($checkCustStmt);

                        if (mysqli_stmt_num_rows($checkCustStmt) > 0) {
                            // IF: พบใน customers -> UPDATE
                            mysqli_stmt_bind_param($updateCustStmt, "sssss", $outlet_name, $phone_number, $village, $district, $external_id);
                            mysqli_stmt_execute($updateCustStmt);
                        } else {
                            // ELSE: ไม่พบใน customers -> INSERT
                            mysqli_stmt_bind_param($insertCustStmt, "sssss", $external_id, $outlet_name, $phone_number, $village, $district);
                            mysqli_stmt_execute($insertCustStmt);
                        }

                        $count++;
                    }
                }

                // ปิดการเชื่อมต่อและคืนหน่วยความจำ
                fclose($handle);
                mysqli_stmt_close($checkImportStmt);
                mysqli_stmt_close($updateImportStmt);
                mysqli_stmt_close($insertImportStmt);
                mysqli_stmt_close($checkCustStmt);
                mysqli_stmt_close($updateCustStmt);
                mysqli_stmt_close($insertCustStmt);

                echo "<script>alert('ประมวลผลข้อมูลสำเร็จทั้งหมด $count แถว!');window.location='customer_list.php';</script>";

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

mysqli_close($con);
?>