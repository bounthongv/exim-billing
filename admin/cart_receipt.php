<?php

//action.php

include("init.php");

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'select_item')
	{
		//
		if(isset($_SESSION["cart_receipt"]))
		{   		
		unset($_SESSION["cart_receipt"]);
		}
		
		
		if(isset($_POST['item_list'])){
			$e_list=0;
for ($i = 0; $i < count($_POST['item_list']); $i++) {
			
			
		       $sale_id=mysqli_real_escape_string($con,$_POST['item_list'][$i]);
			  
       
/*
"SELECT product_sale.* from (    
      SELECT product_sale.sale_id,product_sale.sale_date,


	  sum(product_sale.amount) as total_amt,
	  sum(product_sale.qty) as total_qty


   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
	  ,customers.customer_name,

    ,product_sale.total,
	
	
sum(product_sale.price*product_sale.qty) as total,

	product_sale.payment,product_sale.remain
			

		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
	   
       where 1=1   and  product_sale.sale_id='$sale_id'  and (product_sale.status is null or product_sale.status='' 
       or product_sale.status='0')
         group by product_sale.sale_id,product_sale.product_id

       ) as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id desc
			    ";
*/














"SELECT product_sale.sale_id,product_sale.sale_date,


	  sum(product_sale.amount) as total_amt,
	  sum(product_sale.qty) as total_qty


   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
	  ,customers.customer_name,
	  customers.customer_id,
/*
    ,product_sale.total,
	*/
	
sum(product_sale.price*product_sale.qty) as total,

	product_sale.payment,product_sale.remain
			

		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	     left join customers on customers.customer_id=product_sale.customer_id
	   
       where 1=1   and  product_sale.sale_id='$sale_id'  and (product_sale.status is null or product_sale.status='' 
       or product_sale.status='0')
         group by product_sale.sale_id";











"SELECT product_sale.*
		,sum(product_sale.last_amount) as t_total_amt
		,count(product_sale.total_qty) as total_item
		 
	/*	,sum(product_sale.total_amt) as total_amt */

,sum(product_sale.qty*price) as total
,sum(product_sale.qty) as qty_p 
,product_sale.payment
,product_sale.remain
/* ,product_sale.qty_p */

		from 	  
   (SELECT product_sale.*,sum(product_sale.amount) as total_amt,sum(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
			,sr_list.sr_fname,sr_list.sr_lname
	,custoemr_sale_order.qty_p
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       left join sr_list on product_sale.sr=sr_list.sr_id
	   
	  LEFT JOIN (select sum(product_sale.qty) as qty_p ,product_sale.sale_id
           from  product_sale 
     	          left join products on products.Product_ID=product_sale.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001' and product_sale.sale_id='$sale_id'  group by sale_id) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id
					 
	   
       where 1=1 and product_sale.sale_id='$sale_id' and (product_sale.status is null or product_sale.status='' or product_sale.status='0')
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id asc";









           $sql_d=mysqli_query($con,"SELECT product_sale.*
		,sum(product_sale.last_amount) as t_total_amt
		,count(product_sale.total_qty) as total_item
	/*	,sum(product_sale.total_amt) as total_amt */

,sum(product_sale.qty*price) as total_amt
,sum(product_sale.qty) as qty_p 
,sum(product_sale.total) as total_2 
/* ,product_sale.qty_p */
		from 	  
   (SELECT product_sale.*,(product_sale.amount) as total_amt,(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
			,sr_list.sr_fname,sr_list.sr_lname
	,custoemr_sale_order.qty_p
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       left join sr_list on product_sale.sr=sr_list.sr_id
	   
	  LEFT JOIN (select sum(product_sale.qty) as qty_p ,product_sale.sale_id,product_sale.sale_date
           from  product_sale 
     	          left join products on products.Product_ID=product_sale.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001'  and product_sale.sale_id='$sale_id' group by sale_id,sale_date) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id and product_sale.sale_date=custoemr_sale_order.sale_date
					 
	   
       where 1=1   and product_sale.sale_id='$sale_id' and (product_sale.status is null or product_sale.status='' or product_sale.status='0')
        ) 
       as product_sale
          
	   group by product_sale.sale_id,product_sale.sale_date order by product_sale.sale_id,product_sale.sale_date ASC
			    ");		 
		$f=mysqli_fetch_array($sql_d);
	       
		   $e_list++;
		  echo $e_list;
	       $item_array = array(
			    
				'list_id'               =>     $e_list,
				'sale_id'               =>     $f["sale_id"],  
				'sale_date'             =>     $f["sale_date"],  
				'total'                 =>     $f["total_2"],
				'payment'               =>     $f["payment"], 
				'remain'                =>     $f["remain"]
			);
			$_SESSION["cart_receipt"][] = $item_array;
    
	 
	
    
    }
	  header("location:add_receipt.php");
	
	}else{
		
		header("location:add_receipt.php");
		}
		
		
	}





if($_POST["action"] == 'select_item_2')
	{


if(isset($_POST['item_list'])){

if(isset($_SESSION["cart_receipt"]))
		{   		
		unset($_SESSION["cart_receipt"]);
		}

    $e_list = 0;
    $customer_id = '';
    $customer_name = '';

    for ($i = 0; $i < count($_POST['item_list']); $i++) {
        $sale_id = mysqli_real_escape_string($con, $_POST['item_list'][$i]);

/*
SELECT product_sale.sale_id, product_sale.sale_date,
            sum(product_sale.amount) as total_amt,
            sum(product_sale.qty) as total_qty,
            stocks.stock_name, products.Product_Name, products.size, products.Unit,
            customers.customer_id, customers.customer_name,
            sum(product_sale.price*product_sale.qty) as total,
            product_sale.payment, product_sale.remain
            FROM product_sale 
            LEFT JOIN products ON products.Product_ID=product_sale.product_id
            LEFT JOIN stocks ON stocks.stock_id=product_sale.stock_id
            LEFT JOIN customers ON customers.customer_id=product_sale.customer_id
            WHERE 1=1 AND product_sale.sale_id='$sale_id' 
            AND (product_sale.status IS NULL OR product_sale.status='' OR product_sale.status='0')
            GROUP BY product_sale.sale_id




			SELECT product_sale.sale_id, product_sale.sale_date,
            sum(product_sale.amount) as total_amt,
            sum(product_sale.qty) as total_qty,
            stocks.stock_name, products.Product_Name, products.size, products.Unit,
            customers.customer_id, customers.customer_name,
			sum(product_sale.price*product_sale.qty) as total,
            product_sale.payment, product_sale.remain
            FROM product_sale 
            LEFT JOIN products ON products.Product_ID=product_sale.product_id
            LEFT JOIN stocks ON stocks.stock_id=product_sale.stock_id
            LEFT JOIN customers ON customers.customer_id=product_sale.customer_id
            WHERE 1=1 AND product_sale.sale_id='$sale_id' 
            AND (product_sale.status IS NULL OR product_sale.status='' OR product_sale.status='0')
            GROUP BY product_sale.sale_id
			
			
*/









"SELECT product_sale.*
		,sum(product_sale.last_amount) as t_total_amt
		,count(product_sale.total_qty) as total_item
		 
	/*	,sum(product_sale.total_amt) as total_amt */

,sum(product_sale.qty*price) as total_amt
,sum(product_sale.qty) as qty_p 

/* ,product_sale.qty_p */

		from 	  
   (SELECT product_sale.*,sum(product_sale.amount) as total_amt,sum(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
			,sr_list.sr_fname,sr_list.sr_lname
	,custoemr_sale_order.qty_p
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       left join sr_list on product_sale.sr=sr_list.sr_id
	   
	  LEFT JOIN (select sum(product_sale.qty) as qty_p ,product_sale.sale_id
           from  product_sale 
     	          left join products on products.Product_ID=product_sale.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001'and product_sale.sale_id='$sale_id'  group by sale_id) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id
					 
	   
       where 1=1 and product_sale.sale_id='$sale_id' and (product_sale.status is null or product_sale.status='' or product_sale.status='0')
         group by product_sale.sale_id,product_sale.product_id ) 
       as product_sale
          
	   group by product_sale.sale_id order by product_sale.sale_id asc";












        $sql_d = mysqli_query($con, "SELECT product_sale.*
		,sum(product_sale.last_amount) as t_total_amt
		,count(product_sale.total_qty) as total_item
	/*	,sum(product_sale.total_amt) as total_amt */

,sum(product_sale.qty*price) as total_amt
,sum(product_sale.qty) as qty_p 
,sum(product_sale.total) as total_2 
/* ,product_sale.qty_p */
		from 	  
   (SELECT product_sale.*,(product_sale.amount) as total_amt,(product_sale.qty) as total_qty
   ,stocks.stock_name,products.Product_Name,products.size,products.Unit 
			,tb_groups.Group_Name,products.version,customers.customer_name
			,sr_list.sr_fname,sr_list.sr_lname
	,custoemr_sale_order.qty_p
		   FROM  product_sale 
		   left join products on products.Product_ID=product_sale.product_id
       left join stocks on stocks.stock_id=product_sale.stock_id
	   left join customers on customers.customer_id=product_sale.customer_id
       left join tb_groups on tb_groups.Group_ID=products.group_id
       left join sr_list on product_sale.sr=sr_list.sr_id
	   
	  LEFT JOIN (select sum(product_sale.qty) as qty_p ,product_sale.sale_id,product_sale.sale_date
           from  product_sale 
     	          left join products on products.Product_ID=product_sale.product_id
		          left join tb_groups on tb_groups.Group_ID=products.group_id
              where 1=1 and tb_groups.Group_ID='001'  and product_sale.sale_id='$sale_id' group by sale_id,sale_date) as custoemr_sale_order 
      
		             on product_sale.sale_id=custoemr_sale_order.sale_id and product_sale.sale_date=custoemr_sale_order.sale_date
					 
	   
       where 1=1   and product_sale.sale_id='$sale_id' and (product_sale.status is null or product_sale.status='' or product_sale.status='0')
        ) 
       as product_sale
          
	   group by product_sale.sale_id,product_sale.sale_date order by product_sale.sale_id,product_sale.sale_date ASC
			    ");		 
        
        $f = mysqli_fetch_array($sql_d);

        if($f) {
            $e_list++;
            // *** ลบ echo $e_list; ออก ***
            
            $item_array = array(
                'list_id'   => $e_list,
                'sale_id'   => $f["sale_id"],  
                'sale_date' => $f["sale_date"],  
                'total'     => $f["total_2"],
                'payment'   => $f["payment"], 
                'remain'    => $f["remain"]
            );
            $_SESSION["cart_receipt"][] = $item_array;

            if($i == 0){
                $customer_id   = $f["customer_id"];
                $customer_name = $f["customer_name"];
            }
        }
    }

    $_SESSION['customer_id']   = $customer_id;
    $_SESSION['customer_name'] = $customer_name;
	$_SESSION['payment_name'] = $customer_name;


    // *** ส่งคืนเฉพาะ JSON และใส่ exit กันโค้ดทำงานต่อ ***
    header('Content-Type: application/json');
    echo json_encode(array(
        'status'        => 'ok',
        'customer_id'   => $customer_id,
        'customer_name' => $customer_name,
		'payment_name' => $customer_name
    ));
    exit; // *** ตัด header("location:add_receipt.php"); ออก ***
}


	}





    if($_POST["action"] == 'update_x1')
	{
		foreach($_SESSION["cart_receipt"] as $keys => $values)
		{
			if($values["list_id"] == $_POST["Product_ID"])
			{
				
			 $total=mysqli_real_escape_string($con,$_POST['total']);
			 $total=filter_var($total, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			 
		     $_SESSION["cart_receipt"][$keys]['total']=$total;
	
			}
		}
	}
	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["cart_receipt"] as $keys => $values)
		{
			if($values["sale_id"] == $_POST["Product_ID"])
			{
				unset($_SESSION["cart_receipt"][$keys]);
			}
		}
	}
	
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["cart_receipt"]);
	}
}
if(@$_GET["action"] == 'empty')
	{
		unset($_SESSION["cart_receipt"]);
		header("location:add_receipt.php");
	}




if(isset($_GET["action"]) && $_GET["action"] == 'close_and_clear')
{
    unset($_SESSION["cart_receipt"]);
    unset($_SESSION["customer_id"]);
    unset($_SESSION["customer_name"]);
    
    header("location:index.php");
    exit;
}




?>