<?php
include("init.php");
$Id = isset($_GET['Id']) ? (int)$_GET['Id'] : 0;
if ($Id <= 0) { header("Location: Credit_Term_Agreement.php"); exit(); }
$row = mysqli_fetch_assoc(mysqli_query($con, "SELECT Id, Outlet_Name, number_cta, File_CTA FROM tb_cta WHERE Id=$Id"));
if (!$row) { header("Location: Credit_Term_Agreement.php"); exit(); }
$files = mysqli_query($con, "SELECT * FROM tb_cta_files WHERE cta_id=$Id ORDER BY uploaded_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PDF History - <?php echo htmlspecialchars($row['Outlet_Name']); ?></title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/fontawesome-all.css" rel="stylesheet">
</head>
<body>
<div class="container">
<br>
<h3 align="center">ປະຫວັດການອັບໂຫລດໄຟລ໌ - <?php echo htmlspecialchars($row['Outlet_Name']); ?></h3>
<p align="center"><b>ເລກທີສັນຍາ:</b> <?php echo htmlspecialchars($row['number_cta']); ?> | <b>File ປົດຈຳ:</b> <?php echo htmlspecialchars($row['File_CTA'] ?? '-'); ?></p>
<br>
<a href="edit_cta.php?Id=<?=$Id?>" class="btn btn-success"><i class="fa fa-upload"></i> ອັບໂຫລດໄຟລ໌ໃໝ່</a>
<a href="Credit_Term_Agreement.php" class="btn btn-danger"><i class="fa fa-times"></i> ປິດ</a>
<br><br>
<table class="table table-bordered" style="width:80%" align="center">
<thead>
<tr>
<th>#</th>
<th>ຊື່ຕົ້ນາຍດັ້ງ</th>
<th>ຊື່ໄຟລ໌</th>
<th>ຂະໜາດ</th>
<th>ປະເພດ</th>
<th>ອັບໂຫລດເມື່ອ</th>
<th>ເຄົ້າ</th>
</tr>
</thead>
<tbody>
<?php $n=1; while($f=mysqli_fetch_assoc($files)): ?>
<tr>
<td><?php echo $n++; ?></td>
<td><?php echo htmlspecialchars($f['original_name']); ?></td>
<td><?php echo htmlspecialchars($f['filename']); ?></td>
<td><?php echo round($f['file_size']/1024,1); ?> KB</td>
<td><?php echo htmlspecialchars($f['mime_type']); ?></td>
<td><?php echo date("d/m/Y H:i", strtotime($f['uploaded_at'])); ?></td>
<td><a href="pdf_file/<?php echo htmlspecialchars($f['filename']); ?>" target="_blank"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-download"></i> ເບິ່ງ</button></a></td>
</tr>
<?php endwhile; ?>
<?php if ($n==1): ?>
<tr><td colspan="7" align="center">- ຍັງບໍ່ມີໄຟລ໌ແບບການ -</td></tr>
<?php endif; ?>
</tbody>
</table>
</div>
</body>
</html>
