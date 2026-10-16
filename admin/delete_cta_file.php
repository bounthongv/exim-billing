<?php
include("init.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit();
}

$file_id = isset($_POST['file_id']) ? (int)$_POST['file_id'] : 0;
$cta_id  = isset($_POST['cta_id'])  ? (int)$_POST['cta_id']  : 0;

if ($file_id <= 0 || $cta_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid parameters"]);
    exit();
}

// Get the file record
$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tb_cta_files WHERE Id=$file_id AND cta_id=$cta_id"));
if (!$row) {
    echo json_encode(["status" => "error", "message" => "File not found"]);
    exit();
}

$filepath = __DIR__ . "/pdf_file/" . $row['filename'];

// Delete from database
	mysqli_query($con, "DELETE FROM tb_cta_files WHERE Id=$file_id");

// ຖ້າ file ທີ່ລຶບແມ່ນ file ປັດຈຸບັນຂອງ tb_cta → ໃຫ້ລຶບຊື່ໃນ File_CTA ອອກ (ຫລືຕັ້ງເປັນ file ລ່າສຸດທີ່ຍັງເຫລືອ)
mysqli_query($con, "UPDATE tb_cta SET File_CTA = (SELECT f.filename FROM (SELECT filename FROM tb_cta_files WHERE cta_id=$cta_id ORDER BY Id DESC LIMIT 1) f) WHERE Id=$cta_id AND File_CTA='" . mysqli_real_escape_string($con, $row['filename']) . "'");

// Delete from disk
$deleted = false;
if (file_exists($filepath)) {
    $deleted = unlink($filepath);
}

echo json_encode(["status" => "ok", "message" => "File deleted"]);
?>
