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
    if (!isset($_POST['import2']) || !isset($_FILES['excel_file_2'])) {
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

/**
 * แปลงวันที่จากฟอร์แมตต่าง ๆ (dd/mm/yyyy, dd-mm-yyyy, พ.ศ., Excel serial, ฯลฯ)
 * ให้เป็นฟอร์แมต yyyy-mm-dd สำหรับเก็บลง MySQL (DATE column)
 */
function convertToMysqlDate($dateStr) {
    $dateStr = trim((string)$dateStr);
    if ($dateStr === '') return '';

    // กรณี yyyy-mm-dd หรือ yyyy/mm/dd อยู่แล้ว (รวมถึงกรณีมี timestamp ต่อท้าย)
    if (preg_match('/^(\d{4})[-\/](\d{1,2})[-\/](\d{1,2})/', $dateStr, $m)) {
        $y  = (int)$m[1];
        $mo = (int)$m[2];
        $d  = (int)$m[3];
        if ($y > 2400) $y -= 543; // เผื่อเป็นปี พ.ศ.
        if (checkdate($mo, $d, $y)) {
            return sprintf('%04d-%02d-%02d', $y, $mo, $d);
        }
        return '';
    }

    // กรณี dd/mm/yyyy, dd-mm-yyyy, d/m/yy
    if (preg_match('/^(\d{1,2})[-\/](\d{1,2})[-\/](\d{2,4})/', $dateStr, $m)) {
        $d  = (int)$m[1];
        $mo = (int)$m[2];
        $y  = (int)$m[3];
        if ($y < 100) $y += ($y < 50 ? 2000 : 1900); // ปี 2 หลัก
        if ($y > 2400) $y -= 543; // พ.ศ. -> ค.ศ.
        if (checkdate($mo, $d, $y)) {
            return sprintf('%04d-%02d-%02d', $y, $mo, $d);
        }
        return '';
    }

    // กรณีเป็นตัวเลขล้วน (Excel serial date)
    if (is_numeric($dateStr)) {
        $unixTs = ((float)$dateStr - 25569) * 86400; // Excel serial -> Unix timestamp
        return gmdate('Y-m-d', (int)$unixTs);
    }

    // สุดท้ายให้ PHP ลองเดารูปแบบเอง
    $ts = strtotime($dateStr);
    if ($ts !== false) {
        return date('Y-m-d', $ts);
    }

    // แปลงไม่ได้เลย
    return '';
}

// ==========================================
// 🚀 ZONE 3: เริ่มกระบวนการ Sync เข้าตารางพัก (sale_import)
// ==========================================
if (isset($_POST['import2'])) {

    $fileTmpPath = $_FILES['excel_file_2']['tmp_name'];
    $fileName    = $_FILES['excel_file_2']['name'];

    // ✅ กวดสอบความผิดพลาดของการอัปโหลดไฟล์
    if ($_FILES['excel_file_2']['error'] !== UPLOAD_ERR_OK || empty($fileTmpPath)) {
        switch ($_FILES['excel_file_2']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $errMsg = 'ขะหนาดไฟล์ใหญ่เกินกำหนดของ upload_max_filesize ใน php.ini';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errMsg = 'ขะหนาดไฟล์ใหญ่เกินกำหนดของฟอร์ม (MAX_FILE_SIZE)';
                break;
            case UPLOAD_ERR_PARTIAL:
                $errMsg = 'ไฟล์ถูกอัปโหลดไม่ครบถ้วน กรุณาลองใหม่อีกครั้ง';
                break;
            case UPLOAD_ERR_NO_FILE:
                $errMsg = 'กรุณาเลือกไฟล์ก่อนกดอัปโหลด';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $errMsg = 'ไม่พบโฟลเดอร์ชั่วคราว (tmp) อยู่เซิร์ฟเวอร์';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $errMsg = 'ไม่สามารถเขียนไฟล์ลงดิสก์ได้';
                break;
            default:
                $errMsg = 'เกิดความผิดพลาดที่ไม่รู้สาเหตุ (code: ' . $_FILES['excel_file_2']['error'] . ')';
                break;
        }
        die("<div style='color:red; font-size:20px; padding:20px;'>❌ <b>อัปโหลดไฟล์ล้มเหลว:</b> {$errMsg}</div>");
    }

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
            // 🔄 ขั้นตอนที่ 1: อ่านทุกแถว, กรองเฉพาะ delivered, เก็บเป็น array ในหน่วยความจำ
            // -----------------------------------------------------------------
            $colD  = excelColumnToIndex('D');
            $colH  = excelColumnToIndex('H');


            $dates_in_csv    = [];
            $csv_record_keys = [];
            $rows_to_insert  = [];
            $rowIndex        = 0;
            $skippedCount    = 0;
            $invalidDateCount = 0;

            while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                $rowIndex++;
                if ($rowIndex == 1) continue; // ข้ามหัวตาราง


                $raw_date = isset($data[$colD]) ? trim((string)$data[$colD]) : '';
                $inv_date = convertToMysqlDate($raw_date);   // ✅ แปลงเป็น yyyy-mm-dd ตรงนี้
                $OMNI     = isset($data[$colH]) ? trim((string)$data[$colH]) : '';

                if ($raw_date !== '' && $inv_date === '') {
                    // แปลงวันที่ไม่สำเร็จ ข้ามแถวนี้ แต่นับไว้เพื่อ debug
                    $invalidDateCount++;
                    continue;
                }

                if ($inv_date === '' || $OMNI === '') {
                    continue;
                }

                $dates_in_csv[$inv_date] = true;
                $csv_record_keys[$inv_date . '_' . $OMNI] = true;

                // ✅ แก้ไข: เก็บครบ 13 คอลัมน์ (เพิ่ม Item_Promotion_Code เป็น Index ที่ 12)
                $rows_to_insert[] = [
                    $inv_date, $OMNI
                ];
            }
            fclose($handle);

            // 🔍 DEBUG
            echo "<div style='background:#eef; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: separator ที่ตรวจพบ = [" . htmlspecialchars($separator) . "]<br>";
            echo "DEBUG: อ่านทั้งหมด " . ($rowIndex - 1) . " แถว (ไม่รวม header)<br>";
            echo "DEBUG: แถวที่แปลงวันที่ไม่สำเร็จ (ถูกข้าม) = " . $invalidDateCount . " แถว<br>";
            if (count($rows_to_insert) > 0) {
                echo "DEBUG: ตัวอย่างแถวแรกที่จะบันทึก (inv_date, OMNI): <pre>" . htmlspecialchars(print_r($rows_to_insert[0], true)) . "</pre>";
            }
            echo "</div>";

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 2: หาว่าแถวไหน "มีอยู่แล้ว" (update) แถวไหน "ใหม่" (insert)
            // -----------------------------------------------------------------
            $existing_keys = [];
            if (!empty($dates_in_csv)) {
                $date_escaped = [];
                foreach (array_keys($dates_in_csv) as $d) {
                    $date_escaped[] = "'" . mysqli_real_escape_string($con, $d) . "'";
                }
                $date_range_str = implode(',', $date_escaped);

                $res_existing = mysqli_query($con, "SELECT inv_date, OMNI FROM import_check_product_sale WHERE inv_date IN ($date_range_str)");
                if ($res_existing) {
                    while ($r = mysqli_fetch_assoc($res_existing)) {
                        $existing_keys[$r['inv_date'] . '_' . $r['OMNI']] = true;
                    }
                }
            }

            $rows_for_insert = [];
            $rows_for_update = [];
            foreach ($rows_to_insert as $row) {
                $key = $row[0] . '_' . $row[1];
                if (isset($existing_keys[$key])) {
                    $rows_for_update[] = $row;
                } else {
                    $rows_for_insert[] = $row;
                }
            }

            $insert_count = 0;
            $update_count = 0;

            mysqli_begin_transaction($con);

            // ---- Batch INSERT สำหรับแถวใหม่ ----
            if (!empty($rows_for_insert)) {
                $sql_insert_base = "INSERT INTO import_check_product_sale (
                                    inv_date, OMNI
                                ) VALUES ";

                $chunks = array_chunk($rows_for_insert, 500);

                foreach ($chunks as $chunk) {
                    $placeholders = [];
                    $values_flat  = [];

                    foreach ($chunk as $row) {
                        $placeholders[] = "(" . implode(',', array_fill(0, 2, '?')) . ")";
                        foreach ($row as $v) {
                            $values_flat[] = $v;
                        }
                    }

                    $sql = $sql_insert_base . implode(',', $placeholders);
                    $stmt = mysqli_prepare($con, $sql);

                    if (!$stmt) {
                        mysqli_rollback($con);
                        die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL (batch insert): " . mysqli_error($con));
                    }

                    $types = str_repeat('s', count($values_flat));
                    $bind_names = [$types];
                    foreach ($values_flat as $i => $v) {
                        $bind_name = 'bind' . $i;
                        $$bind_name = $v;
                        $bind_names[] = &$$bind_name;
                    }
                    call_user_func_array('mysqli_stmt_bind_param', array_merge([$stmt], $bind_names));
                    unset($bind_names);

                    if (!mysqli_stmt_execute($stmt)) {
                        mysqli_rollback($con);
                        die("เกิดข้อผิดพลาดขณะบันทึกข้อมูลใหม่: " . mysqli_stmt_error($stmt));
                    }

                    $insert_count += mysqli_stmt_affected_rows($stmt);
                    mysqli_stmt_close($stmt);
                }
            }

            // ---- UPDATE สำหรับแถวที่มีอยู่แล้ว ----


            mysqli_commit($con);

            // 🔍 DEBUG
            echo "<div style='background:#efe; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: existing_keys ที่พบในตารางอยู่แล้ว = " . count($existing_keys) . " รายการ<br>";
            echo "DEBUG: แถวที่จะ INSERT ใหม่ = " . count($rows_for_insert) . " แถว, insert_count จริง = $insert_count<br>";
            echo "DEBUG: แถวที่จะ UPDATE = " . count($rows_for_update) . " แถว, update_count จริง = $update_count<br>";
            echo "DEBUG: mysqli_error ล่าสุด = " . mysqli_error($con) . "<br>";
            $check_count = mysqli_query($con, "SELECT COUNT(*) AS c FROM import_check_product_sale");
            if ($check_count) {
                $row_check = mysqli_fetch_assoc($check_count);
                echo "DEBUG: จำนวนแถวในตาราง import_check_product_sale ตอนนี้ = " . $row_check['c'] . "<br>";
            }
            echo "</div>";

            // -----------------------------------------------------------------
            // 🔄 ขั้นตอนที่ 3: ลบข้อมูลเก่าที่ไม่อยู่ใน CSV
            // -----------------------------------------------------------------
            $delete_count = 0;
            if (!empty($dates_in_csv) && !empty($csv_record_keys)) {
                $date_escaped = [];
                foreach (array_keys($dates_in_csv) as $d) {
                    $date_escaped[] = "'" . mysqli_real_escape_string($con, $d) . "'";
                }
                $date_range_str = implode(',', $date_escaped);

                $key_escaped = [];
                foreach (array_keys($csv_record_keys) as $k) {
                    $key_escaped[] = "'" . mysqli_real_escape_string($con, $k) . "'";
                }
                $key_range_str = implode(',', $key_escaped);


            }


// 🎯 ขั้นตอนที่ 4: ย้ายข้อมูลจาก sale_import ไป product_sale (UPSERT)
// -----------------------------------------------------------------

        } else {
            echo "ไม่สามารถเปิดไฟล์ CSV ได้";
        }

    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาดในระบบ: " . $e->getMessage();
    }
}

// ล้างตารางพักเมื่อทำงานเสร็จ
//mysqli_query($con, "TRUNCATE import_check_product_sale");
mysqli_close($con);
/*
echo "<script>alert('นำข้อมูลเข้าสำเร็จ');window.location='sale_list.php';</script>";
*/


?>