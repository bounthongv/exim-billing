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

// ดึงค่าจากแถว CSV ด้วยตัวอักษรคอลัมน์ Excel เช่น getCol($data, 'AK')
function getCol($data, $column) {
    $i = excelColumnToIndex($column);
    return isset($data[$i]) ? trim((string)$data[$i]) : '';
}

// ลำดับคอลัมน์ CSV (ตัวอักษร Excel) ให้ตรงกับลำดับฟิลด์ในตาราง sale_import:
// Item_ID, Display_ID, Created_Date, Delivery_Date, Invoiced_Date, Invoice_Number,
// Outlet_External_ID, Outlet_Name, Sales_Rep_Code, Extended_Status,
// Product_SKU, Product_Name, Quantity, Price, Total, Item_Promotion_Code,
// Created_Date_LAT, Delivery_Date_LAT, Invoiced_Date_LAT
$sale_columns = ['A', 'C', 'E', 'G', 'I', 'M', 'AL', 'AK', 'BJ', 'U', 'BL', 'BN', 'BO', 'BP', 'BU', 'Z', 'F', 'H', 'J'];

// ==========================================
// 🚀 ZONE 3: เริ่มกระบวนการ Sync เข้าตารางพัก (sale_import)
// ==========================================
if (isset($_POST['import'])) {

    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    $fileName    = $_FILES['excel_file']['name'];

    // ✅ กวดสอบความผิดพลาดของการอัปโหลดไฟล์
    if ($_FILES['excel_file']['error'] !== UPLOAD_ERR_OK || empty($fileTmpPath)) {
        switch ($_FILES['excel_file']['error']) {
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
                $errMsg = 'เกิดความผิดพลาดที่ไม่รู้สาเหตุ (code: ' . $_FILES['excel_file']['error'] . ')';
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
            $dates_in_csv    = [];
            $csv_record_keys = [];
            $rows_to_insert  = [];
            $rowIndex        = 0;
            $skippedCount    = 0;

            while (($data = fgetcsv($handle, 0, $separator)) !== FALSE) {
                $rowIndex++;
                if ($rowIndex == 1) continue; // ข้ามหัวตาราง

                $Extended_Status = getCol($data, 'U');

                if (strtolower($Extended_Status) !== 'delivered' && strtolower($Extended_Status) !== 'shipped'  && strtolower($Extended_Status) !== 'ready_for_delivery'  && strtolower($Extended_Status) !== 'processing' ) {
                    $skippedCount++;
                    continue;
                }

                $Item_ID             = getCol($data, 'A');
                $Display_ID          = getCol($data, 'C');
                $Created_Date        = getCol($data, 'E');
                $Delivery_Date       = getCol($data, 'G');
                $Invoiced_Date       = getCol($data, 'I');
                $Invoice_Number      = getCol($data, 'M');
                $Item_Promotion_Code = getCol($data, 'Z');

                // คอลัมน์วันที่แบบ LAT (สมมติว่าอยู่ถัดจากคอลัมน์วันที่เดิม: F, H, J — แก้ตัวอักษรตรงนี้ได้ถ้าไม่ตรง)
                $Created_Date_LAT    = getCol($data, 'F');
                $Delivery_Date_LAT   = getCol($data, 'H');
                $Invoiced_Date_LAT   = getCol($data, 'J');

                $Outlet_Name         = getCol($data, 'AK');
                $Outlet_External_ID  = getCol($data, 'AL');
                $Sales_Rep_Code      = getCol($data, 'BJ');
                $Product_SKU         = getCol($data, 'BL');
                $Product_Name        = getCol($data, 'BN');
                $Quantity            = getCol($data, 'BO');
                $Price               = getCol($data, 'BP');
                $Total               = getCol($data, 'BU');

                if ($Invoice_Number === '' || $Item_ID === '' || $Invoiced_Date === '') {
                    continue;
                }

                $dates_in_csv[$Invoiced_Date] = true;
                $csv_record_keys[$Item_ID . '_' . $Invoiced_Date] = true;

                // เก็บโดยใช้ key เป็นตัวอักษรคอลัมน์ของไฟล์ CSV (ตามที่ใช้กับ excelColumnToIndex)
                $rows_to_insert[] = [
                    'A'  => $Item_ID,
                    'C'  => $Display_ID,
                    'E'  => $Created_Date,
                    'G'  => $Delivery_Date,
                    'I'  => $Invoiced_Date,
                    'M'  => $Invoice_Number,
                    'AL' => $Outlet_External_ID,
                    'AK' => $Outlet_Name,
                    'BJ' => $Sales_Rep_Code,
                    'U'  => $Extended_Status,
                    'BL' => $Product_SKU,
                    'BN' => $Product_Name,
                    'BO' => $Quantity,
                    'BP' => $Price,
                    'BU' => $Total,
                    'Z'  => $Item_Promotion_Code,
                    'F'  => $Created_Date_LAT,
                    'H'  => $Delivery_Date_LAT,
                    'J'  => $Invoiced_Date_LAT
                ];
            }
            fclose($handle);

            // 🔍 DEBUG
            echo "<div style='background:#eef; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: separator ที่ตรวจพบ = [" . htmlspecialchars($separator) . "]<br>";
            echo "DEBUG: อ่านทั้งหมด " . ($rowIndex - 1) . " แถว (ไม่รวม header)<br>";
            echo "DEBUG: ข้าม (ไม่ใช่ delivered) = $skippedCount แถว<br>";
            echo "DEBUG: ผ่านเงื่อนไข delivered และมีค่าครบ = " . count($rows_to_insert) . " แถว<br>";
            if (count($rows_to_insert) > 0) {
                echo "DEBUG: ตัวอย่างแถวแรกที่จะบันทึก (ต้องมี 19 คอลัมน์): <pre>" . htmlspecialchars(print_r($rows_to_insert[0], true)) . "</pre>";
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

                $res_existing = mysqli_query($con, "SELECT Item_ID, Invoiced_Date FROM sale_import WHERE Invoiced_Date IN ($date_range_str)");
                if ($res_existing) {
                    while ($r = mysqli_fetch_assoc($res_existing)) {
                        $existing_keys[$r['Item_ID'] . '_' . $r['Invoiced_Date']] = true;
                    }
                }
            }

            $rows_for_insert = [];
            $rows_for_update = [];
            foreach ($rows_to_insert as $row) {
    $key = $row['A'] . '_' . $row['I']; // A = Item_ID, I = Invoiced_Date
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
                $sql_insert_base = "INSERT INTO sale_import (
                                    Item_ID, Display_ID,Created_Date,Delivery_Date, Invoiced_Date, Invoice_Number,
                                    Outlet_External_ID, Outlet_Name, Sales_Rep_Code, Extended_Status,
                                    Product_SKU, Product_Name, Quantity, Price, Total,
                                    Item_Promotion_Code,
                                    Created_Date_LAT, Delivery_Date_LAT, Invoiced_Date_LAT
                                ) VALUES ";

                $chunks = array_chunk($rows_for_insert, 500);

                foreach ($chunks as $chunk) {
                    $placeholders = [];
                    $values_flat  = [];

                    foreach ($chunk as $row) {
                        $placeholders[] = "(" . implode(',', array_fill(0, count($sale_columns), '?')) . ")";
                        foreach ($sale_columns as $col) {
                            $values_flat[] = $row[$col];
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
            if (!empty($rows_for_update)) {
                $sql_update = "UPDATE sale_import SET
                                Display_ID = ?, Invoice_Number = ?,
                                Created_Date = ?, Delivery_Date = ?,
                                Outlet_External_ID = ?, Outlet_Name = ?, Sales_Rep_Code = ?, Extended_Status = ?,
                                Product_SKU = ?, Product_Name = ?, Quantity = ?, Price = ?, Total = ?,
                                Item_Promotion_Code = ?,
                                Created_Date_LAT = ?, Delivery_Date_LAT = ?, Invoiced_Date_LAT = ?
                            WHERE Item_ID = ? AND Invoiced_Date = ?";
                $stmt_update = mysqli_prepare($con, $sql_update);

                if (!$stmt_update) {
                    mysqli_rollback($con);
                    die("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL (update): " . mysqli_error($con));
                }

                foreach ($rows_for_update as $row) {
                    $Item_ID             = $row['A'];
                    $Display_ID          = $row['C'];
                    $Created_Date        = $row['E'];
                    $Delivery_Date       = $row['G'];
                    $Invoiced_Date       = $row['I'];
                    $Invoice_Number      = $row['M'];
                    $Outlet_External_ID  = $row['AL'];
                    $Outlet_Name         = $row['AK'];
                    $Sales_Rep_Code      = $row['BJ'];
                    $Extended_Status     = $row['U'];
                    $Product_SKU         = $row['BL'];
                    $Product_Name        = $row['BN'];
                    $Quantity            = $row['BO'];
                    $Price               = $row['BP'];
                    $Total               = $row['BU'];
                    $Item_Promotion_Code = $row['Z'];
                    $Created_Date_LAT    = $row['F'];
                    $Delivery_Date_LAT   = $row['H'];
                    $Invoiced_Date_LAT   = $row['J'];

                    // วางลำดับ Parameter ให้ตรงตาม SQL UPDATE (มี 19 ตัวพอดี)
                    mysqli_stmt_bind_param($stmt_update, "sssssssssssssssssss",
    $Display_ID, $Invoice_Number,
    $Created_Date, $Delivery_Date,
    $Outlet_External_ID, $Outlet_Name, $Sales_Rep_Code, $Extended_Status,
    $Product_SKU, $Product_Name, $Quantity, $Price, $Total,
    $Item_Promotion_Code,
    $Created_Date_LAT, $Delivery_Date_LAT, $Invoiced_Date_LAT,
    $Item_ID, $Invoiced_Date
);
                    mysqli_stmt_execute($stmt_update);
                    $update_count++;
                }
                mysqli_stmt_close($stmt_update);
            }

            mysqli_commit($con);

            // 🔍 DEBUG
            echo "<div style='background:#efe; padding:10px; margin:5px; font-family:monospace;'>";
            echo "DEBUG: existing_keys ที่พบในตารางอยู่แล้ว = " . count($existing_keys) . " รายการ<br>";
            echo "DEBUG: แถวที่จะ INSERT ใหม่ = " . count($rows_for_insert) . " แถว, insert_count จริง = $insert_count<br>";
            echo "DEBUG: แถวที่จะ UPDATE = " . count($rows_for_update) . " แถว, update_count จริง = $update_count<br>";
            echo "DEBUG: mysqli_error ล่าสุด = " . mysqli_error($con) . "<br>";
            $check_count = mysqli_query($con, "SELECT COUNT(*) AS c FROM sale_import");
            if ($check_count) {
                $row_check = mysqli_fetch_assoc($check_count);
                echo "DEBUG: จำนวนแถวในตาราง sale_import ตอนนี้ = " . $row_check['c'] . "<br>";
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

                $delete_sql = "DELETE FROM sale_import
                                WHERE Invoiced_Date IN ($date_range_str)
                                AND CONCAT(Item_ID, '_', Invoiced_Date) NOT IN ($key_range_str)";

                if (mysqli_query($con, $delete_sql)) {
                    $delete_count = mysqli_affected_rows($con);
                }
            }


// 🎯 ขั้นตอนที่ 4: ย้ายข้อมูลจาก sale_import ไป product_sale (UPSERT)
// -----------------------------------------------------------------

// ---- 4.1 UPDATE แถวที่มีอยู่แล้วใน product_sale ----
$sql_sync_update = "UPDATE product_sale ps
    INNER JOIN sale_import si
        ON ps.Item_ID = si.Item_ID
    LEFT JOIN (
        SELECT Invoice_Number, /*SUM(Quantity * Price) AS remain*/
        SUM(total) AS remain
        FROM sale_import
        GROUP BY Invoice_Number
    ) AS sale_import_2 ON sale_import_2.Invoice_Number = si.Invoice_Number
    SET
        ps.sr          = si.Sales_Rep_Code,
        ps.customer_id = si.Outlet_External_ID,
        ps.price       = si.Price,
        ps.qty         = si.Quantity,
        ps.Total       = si.total,
        
        ps.Created_Date   = DATE_FORMAT(STR_TO_DATE(si.Created_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        ps.Delivery_Date   = DATE_FORMAT(STR_TO_DATE(si.Delivery_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        ps.sale_date   = DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        ps.sale_time   = DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%H:%i:%s'),


   ps.Created_Date_LAT   = DATE_FORMAT(STR_TO_DATE(si.Created_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d %H:%i:%s'),
   ps.Delivery_Date_LAT  = DATE_FORMAT(STR_TO_DATE(si.Delivery_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d %H:%i:%s'),
   ps.Invoiced_Date_LAT  = DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d'),
   ps.Invoiced_Time_LAT   = DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date_LAT, '%c/%e/%Y, %r'), '%H:%i:%s'),


        ps.order_id    = si.Display_ID,
        ps.remain      = sale_import_2.remain,
        ps.free        = si.Item_Promotion_Code,
        ps.status      = ''
";
$sync_update_ok = mysqli_query($con, $sql_sync_update);
$update_sale_count = $sync_update_ok ? mysqli_affected_rows($con) : 0;




// ---- 4.2 INSERT แถวใหม่ที่ยังไม่มีใน product_sale ----
$sql_sync_insert = "INSERT INTO product_sale
        (sr,customer_id, product_id, price, qty, Total, Created_Date, Delivery_Date, sale_date, sale_time,Created_Date_LAT,Delivery_Date_LAT,Invoiced_Date_LAT,Invoiced_Time_LAT, order_id, sale_id, remain, free,Item_ID,`status`)
    SELECT
        si.Sales_Rep_Code,
        si.Outlet_External_ID,
        si.Product_SKU,
        si.Price,
        si.Quantity,
        si.total,

        DATE_FORMAT(STR_TO_DATE(si.Created_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        DATE_FORMAT(STR_TO_DATE(si.Delivery_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%Y-%m-%d'),
        DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date, '%a, %d %b %Y %H:%i:%s GMT'), '%H:%i:%s'),


    DATE_FORMAT(STR_TO_DATE(si.Created_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d %H:%i:%s'),
    DATE_FORMAT(STR_TO_DATE(si.Delivery_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d %H:%i:%s'),
    DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date_LAT, '%c/%e/%Y, %r'), '%Y-%m-%d'),
    DATE_FORMAT(STR_TO_DATE(si.Invoiced_Date_LAT, '%c/%e/%Y, %r'), '%H:%i:%s'),


        si.Display_ID,
        si.Invoice_Number,
        sale_import_2.remain,
        si.Item_Promotion_Code,
        si.Item_ID,
        ''
    FROM sale_import si
    LEFT JOIN (
        SELECT Invoice_Number,/* SUM(Quantity * Price) AS remain*/
        SUM(total) AS remain
        FROM sale_import
        GROUP BY Invoice_Number
    ) AS sale_import_2 ON sale_import_2.Invoice_Number = si.Invoice_Number
    LEFT JOIN product_sale ps
        ON ps.sale_id = si.Invoice_Number
       AND ps.product_id = si.Product_SKU
    WHERE ps.sale_id IS NULL
";
$sync_insert_ok = mysqli_query($con, $sql_sync_insert);
$insert_sale_count = $sync_insert_ok ? mysqli_affected_rows($con) : 0;






// 🔍 DEBUG
echo "<div style='background:#ffe; padding:10px; margin:5px; font-family:monospace;'>";
echo "DEBUG: UPDATE product_sale " . ($sync_update_ok ? "สำเร็จ" : "ล้มเหลว: " . mysqli_error($con)) . " (แถวที่อัปเดต = $update_sale_count)<br>";
echo "DEBUG: INSERT product_sale " . ($sync_insert_ok ? "สำเร็จ" : "ล้มเหลว: " . mysqli_error($con)) . " (แถวที่เพิ่มใหม่ = $insert_sale_count)<br>";
echo "</div>";

        } else {
            echo "ไม่สามารถเปิดไฟล์ CSV ได้";
        }

    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาดในระบบ: " . $e->getMessage();
    }
}



$sql_sync_update_2 = "UPDATE product_sale p
JOIN (
    SELECT sale_id, SUM(total) AS total_sum,
	payment AS total_payment
    FROM product_sale
    GROUP BY sale_id
) AS grouped ON p.sale_id = grouped.sale_id
SET p.remain = grouped.total_sum-p.payment
WHERE (p.status IS NULL OR p.status = '' OR p.status = '0')
and p.payment=0";

$sync_update_ok_2 = mysqli_query($con, $sql_sync_update_2);
//$update_sale_count_2 = $sync_update_ok_2 ? mysqli_affected_rows($con) : 0;


// ล้างตารางพักเมื่อทำงานเสร็จ
mysqli_query($con, "TRUNCATE sale_import");
mysqli_close($con);

echo "<script>alert('นำข้อมูลเข้าสำเร็จ');window.location='sale_list.php';</script>";



?>