<?php
include "init.php";
if (!$con) { echo "No connection"; exit; }
echo "=== Invoice INV-118430 ===\n";
$r = mysqli_query($con, "SELECT Id, sale_id, customer_id, Outlet_External_ID FROM product_sale WHERE sale_id LIKE '%INV-118430%'");
echo "Found " . mysqli_num_rows($r) . " records\n";
while ($row = mysqli_fetch_assoc($r)) {
    echo "sale_id: [" . $row['sale_id'] . "]\n";
    echo "customer_id: [" . $row['customer_id'] . "]\n";
    echo "Outlet_External_ID: [" . $row['Outlet_External_ID'] . "]\n";
}
echo "\n=== Customer 683334 in customers ===\n";
$r = mysqli_query($con, "SELECT customer_id, customer_name FROM customers WHERE customer_id = '683334'");
echo "Found " . mysqli_num_rows($r) . " records\n";
while ($row = mysqli_fetch_assoc($r)) {
    echo "customer_id: [" . $row['customer_id'] . "]\n";
    echo "customer_name: [" . $row['customer_name'] . "]\n";
}
echo "\n=== Customer 683334 in customer_import ===\n";
$r = mysqli_query($con, "SELECT external_id, outlet_name FROM customer_import WHERE external_id LIKE '683334%'");
echo "Found " . mysqli_num_rows($r) . " records\n";
while ($row = mysqli_fetch_assoc($r)) {
    echo "external_id: [" . $row['external_id'] . "]\n";
    echo "outlet_name: [" . $row['outlet_name'] . "]\n";
}
echo "\n=== Count product_sale with customer_id 683334 ===\n";
$r = mysqli_query($con, "SELECT COUNT(*) as cnt FROM product_sale WHERE customer_id = '683334'");
$row = mysqli_fetch_assoc($r);
echo "Count: " . $row['cnt'] . "\n";
?>
