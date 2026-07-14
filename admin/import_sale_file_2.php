<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
set_time_limit(0);
ini_set('memory_limit', '256M'); // คงไว้ที่ 256M ตามข้อจำกัดเซิร์ฟเวอร์

include("init.php");
include_once(__DIR__ . '/../LAOS/phpspreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

// 1. สร้างคลาสเพื่อทำหน้าที่ "แผ่นกรองคอลัมน์"
class CustomColumnFilter implements IReadFilter
{
    public function readCell(string $columnAddress, int $row, string $worksheetName = ''): bool
    {
        $allowedColumns = ['A','C','I','M','AL','AK', 'U','BL','BN','BO', 'BP', 'BU'];
        if (in_array($columnAddress, $allowedColumns, true)) {
            return true;
        }
        return false;
    }
}

if (isset($_POST['import'])) {
    
    $fileTmpPath = $_FILES['excel_file']['tmp_name'];
    
    try {
        // 2. สร้าง Reader
        $reader = IOFactory::createReaderForFile($fileTmpPath);
        
        // ⚡ เทคนิคประหยัดแรมขั้นสุด
        $reader->setReadDataOnly(true);
        $filterSubset = new CustomColumnFilter();
        $reader->setReadFilter($filterSubset);
        
        // โหลดไฟล์
        $spreadsheet = $reader->load($fileTmpPath);
        $worksheet = $spreadsheet->getActiveSheet();

        // 3. เตรียมคำสั่ง SQL
        $sql = "INSERT INTO sale_import (Item_ID,Display_ID,Invoiced_Date,Invoice_Number,Outlet_External_ID,Outlet_Name,Extended_Status,Product_SKU,Product_Name, Quantity, Price, Total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        if ($stmt) {
            $count = 0;
            
            // วนลูปอ่านข้อมูลทีละแถว
            foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
                // ข้ามแถวที่ 1 (Header หัวตาราง)
                if ($rowIndex == 1) continue; 

$extendedStatus = trim((string)$worksheet->getCell('U' . $rowIndex)->getValue());

// 🔥 เงื่อนไขเพิ่มเติม: จะนำเข้าข้อมูลเฉพาะแถวที่มีสถานะเท่ากับ 'delivered' เท่านั้น
                if ($extendedStatus === 'delivered') {

                // ดึงค่าจากคอลัมน์ที่ต้องการ และตัดช่องว่าง (trim) ทันที

                $Item_ID = trim((string)$worksheet->getCell('A' . $rowIndex)->getValue());
                $Display_ID = trim((string)$worksheet->getCell('C' . $rowIndex)->getValue());
                $Invoiced_Date = trim((string)$worksheet->getCell('I' . $rowIndex)->getValue());
                $Invoice_Number = trim((string)$worksheet->getCell('M' . $rowIndex)->getValue());
                $Outlet_External_ID = trim((string)$worksheet->getCell('AL' . $rowIndex)->getValue());
                $Outlet_Name = trim((string)$worksheet->getCell('AK' . $rowIndex)->getValue());
                $Extended_Status = trim((string)$worksheet->getCell('U' . $rowIndex)->getValue());
                $Product_SKU    = trim((string)$worksheet->getCell('BL' . $rowIndex)->getValue());
                $Product_Name   = trim((string)$worksheet->getCell('BN' . $rowIndex)->getValue());
                $Quantity       = trim((string)$worksheet->getCell('BO' . $rowIndex)->getValue());
                $Price          = trim((string)$worksheet->getCell('BP' . $rowIndex)->getValue());
                $Total          = trim((string)$worksheet->getCell('BU' . $rowIndex)->getValue());

                // ตรวจสอบ: บันทึกเฉพาะแถวที่มีเลขที่ Invoice เท่านั้น (ป้องกันแถวว่างท้ายไฟล์)
                if ($Invoice_Number !== '') {
                    mysqli_stmt_bind_param($stmt, "ssssssssssss", $Item_ID, $Display_ID, $Invoiced_Date, $Invoice_Number,$Outlet_External_ID,$Outlet_Name, $Extended_Status,$Product_SKU,$Product_Name, $Quantity, $Price, $Total);
                    mysqli_stmt_execute($stmt);
                    $count++;
                }
            }
        }

            mysqli_stmt_close($stmt);

echo "<script>alert('นำเข้าข้อมูลสำเร็จทั้งหมด $count แถว! (โดยไม่กินแรมคอลัมน์อื่น)');window.location='sale_list.php';</script>";


        } else {
            echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . mysqli_error($con);
        }
        
    } catch (Exception $e) {
        echo "เกิดข้อผิดพลาดในการอ่านไฟล์ Excel: " . $e->getMessage();
    }
}

mysqli_close($con);
?>