<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '256M');

setlocale(LC_ALL, 'th_TH.UTF-8');

// ==========================================
// 🛠️ ZONE 1: ระบบดักจับปัญหา
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST) && empty($_FILES)) {
        die("<div style='color:red; font-size:20px; padding:20px;'>❌ <b>เซิร์ฟเวอร์สลัดข้อมูลทิ้ง:</b> ไฟล์ใหญ่เกินเกณฑ์กำหนดของ post_max_size</div>");
    }
    if (!isset($_POST['import']) || !isset($_FILES['excel_file'])) {
        die("<div style='color:orange; font-size:20px; padding:20px;'>⚠️ <b>ตั้งชื่อ Form ไม่ตรง:</b> กรุณาเช็กชื่อปุ่มหรืออินพุตไฟล์ในหน้า HTML</div>");
    }
}

// ==========================================
// ⚙️ ZONE 2: โหลดไฟล์เชื่อมต่อ และฟังก์ชันคำนวณ
// ==========================================
include("init.php");

if (!isset($con) || !$con) {
    die("❌ <b>ข้อผิดพลาด:</b> ไม่พบตัวแปรเชื่อมต่อฐานข้อมูล \$con");
}

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
// 🚀 ZONE 3: เริ่มกระบวนการ Sync (Strict WHERE Logic)
// ==========================================
if (isset($_POST['import'])) {
    
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName    = $_FILES['excel_file']['name'];
    
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileExtension !== 'csv') {
        echo "<script>alert('กรุณาอัปโหลดเฉพาะไฟล์ .csv เท่านั้น');window.history.back();</script>";
        exit;
    }

    try {
        if (($handle = fopen($fileTmpPath, "r")) !== FALSE) {
            
            // ตรวจจับเครื่องหมายคั่นข้อมูลอัตโนมัติ
            $firstLine = fgets($handle);
            $separator = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
            rewind($handle);

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 1: แกะหาช่วงวันที่ในไฟล์ เพื่อใช้ทำตรรกะลบออกอย่างปลอดภัย
            // -----------------------------------------------------------------
            $dates_in_csv = [];
            $rowIndex = 0;
            while (($previewData = fgetcsv($handle, 0, $separator)) !== FALSE) {
                $rowIndex++;
                if ($rowIndex == 1) continue;
                
                $uIndex = excelColumnToIndex('U');
                $status = isset($previewData[$uIndex]) ? strtolower(trim((string)$previewData[$uIndex])) : '';
                
                if ($status === 'delivered') {
                    $dateVal = isset($previewData[excelColumnToIndex('I')]) ? trim((string)$previewData[excelColumnToIndex('I')]) : '';
                    if ($dateVal !== '') {
                        $dates_in_csv[$dateVal] = true;
                    }
                }
            }
            rewind($handle); // รีเซ็ตหัวอ่านกลับไปเริ่มต้นใหม่

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 2: เตรียมคำสั่ง SQL (Check, Insert, Update)
            // -----------------------------------------------------------------
            
            // คำสั่งเช็กว่ามีข้อมูลอยู่แล้วไหม โดยอิงจาก Item_ID และ Invoiced_Date เป๊ะๆ
            $sql_check = "SELECT COUNT(*) FROM sale_import WHERE Item_ID = ? AND Invoiced_Date = ?";
            
            $sql_insert = "INSERT INTO sale_import (
                                Item_ID, Display_ID, Invoiced_Date, Invoice_Number, 
                                Outlet_External_ID, Outlet_Name, Extended_Status, 
                                Product_SKU, Product_Name, Quantity, Price, Total
                            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            
            $sql_update = "UPDATE sale_import SET 
                                Display_ID = ?,  Invoice_Number = ?, 
                                Outlet_External_ID = ?, Outlet_Name = ?, Extended_Status = ?, 
                                Product_SKU = ?, Product_Name = ?, Quantity = ?, Price = ?, Total = ? 
                            WHERE Item_ID = ? AND Invoiced_Date = ?";
                    
            $stmt_check  = mysqli_prepare($con, $sql_check);
            $stmt_insert = mysqli_prepare($con, $sql_insert);
            $stmt_update = mysqli_prepare($con, $sql_update);

            if ($stmt_check && $stmt_insert && $stmt_update) {
                $insert_count = 0;
                $update_count = 0;
                $skippedCount = 0;
                $rowIndex = 0;
                $csv_record_keys = []; // เก็บสถิติรายชื่อที่มีใน CSV รอบนี้ป้องกันการลบผิด

                while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                    $rowIndex++;
                    if ($rowIndex == 1) continue; // ข้ามหัวตาราง

                    $uIndex = excelColumnToIndex('U');
                    $Extended_Status = isset($data[$uIndex]) ? trim((string)$data[$uIndex]) : '';

                    if (strtolower($Extended_Status) === 'delivered') {

                        $Item_ID            = isset($data[excelColumnToIndex('A')])  ? trim((string)$data[excelColumnToIndex('A')])  : '';
                        $Display_ID         = isset($data[excelColumnToIndex('C')])  ? trim((string)$data[excelColumnToIndex('C')])  : '';
                        $Invoiced_Date      = isset($data[excelColumnToIndex('I')])  ? trim((string)$data[excelColumnToIndex('I')])  : '';
                        $Invoice_Number     = isset($data[excelColumnToIndex('M')])  ? trim((string)$data[excelColumnToIndex('M')])  : '';
                        $Outlet_Name        = isset($data[excelColumnToIndex('AK')]) ? trim((string)$data[excelColumnToIndex('AK')]) : '';
                        $Outlet_External_ID = isset($data[excelColumnToIndex('AL')]) ? trim((string)$data[excelColumnToIndex('AL')]) : '';
                        $Product_SKU        = isset($data[excelColumnToIndex('BL')]) ? trim((string)$data[excelColumnToIndex('BL')]) : '';
                        $Product_Name       = isset($data[excelColumnToIndex('BN')]) ? trim((string)$data[excelColumnToIndex('BN')]) : '';
                        $Quantity           = isset($data[excelColumnToIndex('BO')]) ? trim((string)$data[excelColumnToIndex('BO')]) : '';
                        $Price              = isset($data[excelColumnToIndex('BP')]) ? trim((string)$data[excelColumnToIndex('BP')]) : '';
                        $Total              = isset($data[excelColumnToIndex('BU')]) ? trim((string)$data[excelColumnToIndex('BU')]) : '';

                        if ($Invoice_Number !== '' && $Item_ID !== '' && $Invoiced_Date !== '') {
                            
                            $currentKey = $Item_ID . '_' . $Invoiced_Date;
                            $csv_record_keys[$currentKey] = true; 

                            // 🔄 สั่งรัน SQL เช็กแบบเจาะลึกรายแถว
                            mysqli_stmt_bind_param($stmt_check, "ss", $Item_ID, $Invoiced_Date);
                            mysqli_stmt_execute($stmt_check);
                            mysqli_stmt_bind_result($stmt_check, $row_exists);
                            mysqli_stmt_fetch($stmt_check);
                            mysqli_stmt_reset($stmt_check); // ล้างหน่วยความจำตัวเช็กเพื่อให้รันลูปถัดไปได้

                            if ($row_exists > 0) {
                                // บังคับอัปเดตเฉพาะแถวที่ Item_ID และ Invoiced_Date ตรงกันเท่านั้น!
                                mysqli_stmt_bind_param($stmt_update, "ssssssssssss", 
                                    $Display_ID, $Invoice_Number,
                                    $Outlet_External_ID, $Outlet_Name, $Extended_Status,
                                    $Product_SKU, $Product_Name, $Quantity, $Price, $Total,
                                    $Item_ID, $Invoiced_Date
                                );
                                mysqli_stmt_execute($stmt_update);
                                $update_count++;
                            } else {
                                // ไม่มีในระบบเลย สั่งเพิ่มใหม่
                                mysqli_stmt_bind_param($stmt_insert, "ssssssssssss", 
                                    $Item_ID, $Display_ID, $Invoiced_Date, $Invoice_Number,
                                    $Outlet_External_ID, $Outlet_Name, $Extended_Status,
                                    $Product_SKU, $Product_Name, $Quantity, $Price, $Total
                                );
                                mysqli_stmt_execute($stmt_insert);
                                $insert_count++;
                            }
                        }
                    } else {
                        $skippedCount++;
                    }
                }

                fclose($handle);
                mysqli_stmt_close($stmt_check);
                mysqli_stmt_close($stmt_insert);
                mysqli_stmt_close($stmt_update);

                // -----------------------------------------------------------------
                // 🔄 ขั้นตอนที่ 3: ตรรกะลบออก (เฉพาะในกลุ่มวันที่ของไฟล์ และไม่มีใน CSV ล่าสุด)
                // -----------------------------------------------------------------
                $delete_count = 0;
                if (!empty($dates_in_csv)) {
                    $date_escaped = [];
                    foreach (array_keys($dates_in_csv) as $d) {
                        $date_escaped[] = "'" . mysqli_real_escape_string($con, $d) . "'";
                    }
                    $date_range_str = implode(',', $date_escaped);

                    // ดึงเฉพาะข้อมูลเก่าที่อยู่ในช่วงเวลาของไฟล์ CSV รอบนี้ขึ้นมาสแกนลบ
                    $res = mysqli_query($con, "SELECT Item_ID, Invoiced_Date FROM sale_import WHERE Invoiced_Date IN ($date_range_str)");
                    
                    $delete_sql = "DELETE FROM sale_import WHERE Item_ID = ? AND Invoiced_Date = ?";
                    $del_stmt = mysqli_prepare($con, $delete_sql);

                    if ($del_stmt) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $old_key = $row['Item_ID'] . '_' . $row['Invoiced_Date'];
                            
                            // ถ้าข้อมูลในฐานข้อมูล (ช่วงเดือนนี้) ดันไม่มีอยู่ในไฟล์ CSV รอบปัจจุบัน แปลว่าโดนลบออกจากไฟล์ไปแล้ว -> สั่งลบออกจากตาราง
                            if (!isset($csv_record_keys[$old_key])) {
                                mysqli_stmt_bind_param($del_stmt, "ss", $row['Item_ID'], $row['Invoiced_Date']);
                                mysqli_stmt_execute($del_stmt);
                                $delete_count++;
                            }
                        }
                        mysqli_stmt_close($del_stmt);
                    }
                }

                // แจ้งผลลัพธ์ผ่าน Alert
                echo "<script>
                        alert('ดำเนินการซิงค์ข้อมูลเสร็จสิ้น!\\n- เพิ่มข้อมูลใหม่: $insert_count รายการ\\n- อัปเดตข้อมูลเดิมตามเงื่อนไข: $update_count รายการ\\n- ลบข้อมูลที่หายไปจากไฟล์ (เฉพาะเดือน/วันเดียวกัน): $delete_count รายการ\\n- แถวที่ข้าม: $skippedCount แถว');
                        window.location='sale_list.php';
                      </script>";

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