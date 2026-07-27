<?php
include("init.php");
header('Content-Type: application/json; charset=utf-8');

$customer_id   = isset($_POST['customer_id']) ? mysqli_real_escape_string($con, $_POST['customer_id']) : '';
$customer_name = isset($_POST['customer_name']) ? mysqli_real_escape_string($con, $_POST['customer_name']) : '';

if($customer_id==''){
$c="";
}else{
$c="and customers.customer_id = '$customer_id'";
}

if($customer_name==''){
$c2="";
}else{
$c2="and customers.customer_name = '$customer_name'";
}



/*
$stmt2 = "SELECT tb_cta.*,
customers.Debt_collection,
customers.Number_of_days_overdue,
customers.Contract_expiration_date
 FROM tb_cta 
LEFT JOIN (
SELECT customer_import.*,customer_import.external_id as customer_id,
		  customer_import.outlet_name as customer_name
			FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   left join sr_list on customers.sr=sr_list.sr_id
		   left join customer_import on customers.customer_id=customer_import.external_id
) as customers ON customers.customer_id=tb_cta.customer_id

WHERE 1=1 $c";
$result = mysqli_query($con, $stmt2);

status
*/

$stmt2 = "SELECT customer_import.*,customer_import.external_id as customer_id,
		  customer_import.outlet_name as customer_name,
          customers.bill,
          product_sale.amount
			FROM  customers 
		   left join customer_type on customer_type.ct_id=customers.customer_type
		   left join routes on customers.route_id=routes.route_id
		   left join sr_list on customers.sr=sr_list.sr_id
		   left join customer_import on customers.customer_id=customer_import.external_id


left join
(SELECT customer_id,(product_sale.qty) as qty,(product_sale.amount) as amount FROM product_sale 
where `status` is null
group by customer_id) as product_sale
 on product_sale.customer_id=customers.customer_id



WHERE 1=1 $c $c2";
$result = mysqli_query($con, $stmt2);

$row = mysqli_fetch_assoc($result);


if (!$row) {
    echo json_encode(['status' => 'notfound']);
    exit;
}


if($customer_id != '' || $customer_name != ''){

echo json_encode([
    'status'        => 'ok',
    'customer_id'   => $row['customer_id'],
    'customer_name' => $row['customer_name'],
    'Debt_collection'           => $row['Debt_collection'],
    'Number_of_days_overdue'           => $row['Number_of_days_overdue'],
    'Number_of_bills'           =>  $row['bill'],
    'Contract_expiration_date'           => $row['Contract_expiration_date'],
]);

}else{


echo json_encode([
    'status'        => '',
    'customer_id'   => '',
    'customer_name' => '',
    'Debt_collection'           => '',
    'Number_of_days_overdue'           => '',
    'Number_of_bills'           => '',
    'Contract_expiration_date'           => '',
]);


}

