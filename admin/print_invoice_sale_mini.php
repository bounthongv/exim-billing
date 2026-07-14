<?php 
include("init.php");
?>
<meta charset="utf-8">
<meta http-equiv="refresh" content="5; url=index.php">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <style type="text/css">
    @import url("../LAOS/alice5.css");
body,td,th ,h3, a, h4, h2, h1, h5, h6, menu-grids, col-sm-2, col-sm-3, small, input[type=text] {
	font-family: 'Alice5 MX', Saysettha OT, Phetsarath OT, sans-serif;
	
}
  </style>
<body>

<?php 


?>
<table border="0" align="center">
  <tr>
    <td colspan="2" align="center"><strong>EXIM SOLE Co.,LTD</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center"> ເບີໂທ: 020 99998888</td>
  </tr>
<!--  <tr>
    <td colspan="2" align="center"> ເບີໂທ-Whatapp: 03092189958</td>
  </tr>
-->  <tr>
    <td colspan="2">ວັນທີ:&nbsp;&nbsp; <?php $dd=date_create($f['dates']); echo date_format($dd,"d/m/Y")?>   &nbsp;&nbsp;<?php echo $f['times'];?></td>
  </tr>
  <tr>
    <td colspan="2" align="center">-------------------------------------</td>
  </tr>
  <tr>
    <td width="64" valign="top"><strong>Users:</strong></td>
    <td width="127"><strong><?php echo $f['user'];?></strong></td>
  </tr>
  <tr>
  	<td valign="top"><strong>Password:</strong></td>
    <td><strong><?php echo $f['pass'];?></strong></td>
  </tr>
  <tr>
  	<td valign="top"><strong>ຈຳນວນເງີນ:</strong></td>
    <td><strong><?php echo @number_format($f['amount'],0);?> &nbsp; ບາດ</strong></td>
  </tr>
 </table>
  	<p align="center">ໝາຍເຫດ: ກາລຸນາ ກວດເບີ່ງສີນຄ້າຂອງທ່ານ </p>
<p align="center"> ++++++++++++++++++++</p><br>
<p></p>


</p>

</body>
</html>
<script>
printpage();
function printpage() {
window.print(); 

}
</script>