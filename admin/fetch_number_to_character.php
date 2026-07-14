
<?php
include("init.php");

$amount_number=mysqli_real_escape_string($con,@$_POST['total_amount']);
$amount_number = filter_var($amount_number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);	



function Convert($amount_number)
{
$amount_number = number_format($amount_number, 2, ".","");
$pt = strpos($amount_number , ".");
$number = $fraction = "";
if ($pt === false)
$number = $amount_number;
else
{
$number = substr($amount_number, 0, $pt);
$fraction = substr($amount_number, $pt + 1);
}
$ret = "";
$baht = ReadNumber ($number);
if ($baht != "")
$ret .= $baht . "ກີບ";
$satang = ReadNumber($fraction);
if ($satang != "")
$ret .=  $satang . "สตางค์";
else
//$ret .= "ຖ້ວນ";
$ret .= "";
return $ret;
}
function ReadNumber($number)
{
$position_call = array("ແສນ", "ຫມື່ນ", "ພັນ", "ຮ້ອຍ", "ສີບ", "");
$number_call = array("", "ໜື່ງ", "ສອງ", "ສາມ", "ສີ່", "ຫ້າ", "ຫົກ", "ເຈັດ", "ແປດ", "ເກົົ້າ");
$number = $number + 0;
$ret = "";
if ($number == 0) return $ret;
if ($number > 1000000)
{
 $ret .= ReadNumber(intval($number / 1000000)) . "ລ້ານ";
$number = intval(fmod($number, 1000000));
}

if ($number == 1000000)
{
 $ret .= ReadNumber(intval($number / 1000000)) . "ລ້ານ";
$number = intval(fmod($number, 1000000));
}

$divider = 100000;
$pos = 0;
while($number > 0)
{

   $d = intval($number / $divider);

if(($divider == 10) && ($d == 2)){

//$d = intval($number / $divider);
$ret .= (($divider == 10) && ($d == 2)) ? "ຊາວ" :
((($divider == 10) && ($d == 1)) ? "" :
((($divider == 1) && ($d == 1) && ($ret != "")) ? "ເອັດ" : $number_call[$d]));
$ret .= ("");
$number = $number % $divider;
$divider = $divider / 10;
$pos++;

}else{

//$d = intval($number / $divider);
$ret .= (($divider == 10) && ($d == 2)) ? "ຊາວ" :
((($divider == 10) && ($d == 1)) ? "" :
((($divider == 1) && ($d == 1) && ($ret != "")) ? "ເອັດ" : $number_call[$d]));
$ret .= ($d ? $position_call[$pos] : "");
$number = $number % $divider;
$divider = $divider / 10;
$pos++;


}
}
return $ret;
}




?>

<?php echo Convert($amount_number);?>