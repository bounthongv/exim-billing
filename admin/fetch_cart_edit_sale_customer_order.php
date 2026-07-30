<?php
include('init.php');

// เริ่ม session หากยังไม่ได้เปิด
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$total_price = 0;
$total_item = 0;
$total_qty = 0;
$total_crate_price = 0;
$total_qty_order = 0;
$total_qty_limit = 0;
$total_crate_qty = 0;
?>

<!-- ================= DEBUG PANEL (กดเพื่อดูสาเหตุที่ข้อมูลไม่ขึ้น) =================
<div style="max-width: 1250px; margin: 10px auto; font-family: sans-serif;">
    <details style="background: #222; color: #0ff; padding: 10px; border-radius: 5px; cursor: pointer;">
        <summary style="font-weight: bold; color: #fff;">🔍 คลิกตรงนี้เพื่อ Debug ดูค่าใน SESSION (กดเปิด/ปิดได้)</summary>
        <div style="margin-top: 10px; background: #111; padding: 10px; border-radius: 3px; font-family: monospace;">
            <?php
            echo "<b>1. Session Status:</b> " . (session_status() === PHP_SESSION_ACTIVE ? "<span style='color:#0f0;'>ACTIVE</span>" : "<span style='color:#f00;'>INACTIVE</span>") . "<br>";
            echo "<b>2. Session ID:</b> " . session_id() . "<br>";
            echo "<b>3. Target Key Exists:</b> " . (isset($_SESSION["cart_edit_sale_customer_order"]) ? "<span style='color:#0f0;'>YES</span>" : "<span style='color:#f00;'>NO</span>") . "<br>";
            
            if (isset($_SESSION["cart_edit_sale_customer_order"])) {
                echo "<b>4. Is Array Empty?:</b> " . (empty($_SESSION["cart_edit_sale_customer_order"]) ? "<span style='color:#ff0;'>EMPTY (ไม่มีรายการในตระกร้า)</span>" : "<span style='color:#0f0;'>HAS DATA (" . count($_SESSION["cart_edit_sale_customer_order"]) . " items)</span>") . "<br>";
            }

            echo "<br><b>--- ข้อมูลทั้งหมดใน $_SESSION ปัจจุบัน ---</b><br>";
            echo "<pre style='color: #0f0; max-height: 200px; overflow: auto;'>";
            print_r($_SESSION);
            echo "</pre>";
            ?>
        </div>
    </details>
</div>
 =========================================================================== -->

<table class="table" align="center" style="max-width:1250px;">
    <thead>
        <tr align="center" class="bgtd"> 
            <th align="center">ລ/ດ</th> 
            <th align="center">ຮູບ</th> 
            <th align="center">ລາຍການ</th> 
            <th align="center">ຫົວໜ່ວຍ</th>  
            <th align="center">ຈຳນວນ</th> 
            <th align="center">ໃນສາງ</th> 
            <th align="center">ສັ່ງຊື້</th> 
            <th align="center">ລາຄາ</th>  
            <th align="center">ເປັນເງີນ</th> 
 
            <th align="center">ລົບ</th> 
        </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($_SESSION["cart_edit_sale_customer_order"]) && is_array($_SESSION["cart_edit_sale_customer_order"])) {
        $e = 0;
        foreach ($_SESSION["cart_edit_sale_customer_order"] as $keys => $values) {
            $e++;
            // ดึงค่าอย่างปลอดภัย (ป้องกัน Warning Undefined Index)
           $list_id          = isset($values["list_id"]) ? $values["list_id"] : $e;
//$list_id=$e;

            $pic              = isset($values["pic"]) ? $values["pic"] : '';
            $Item_ID       = isset($values["Product_ID"]) ? $values["Item_ID"] : '';
            $customer_id       = isset($values["customer_id"]) ? $values["customer_id"] : '';
            $product_id       = isset($values["Product_ID"]) ? $values["Product_ID"] : '';
            $product_name     = isset($values["product_name"]) ? $values["product_name"] : '';
            $units            = isset($values["units"]) ? $values["units"] : '';
            $product_quantity = isset($values["product_quantity"]) ? floatval($values["product_quantity"]) : 0;
            $crate_qty        = isset($values["crate_qty"]) ? floatval($values["crate_qty"]) : 0;
            $qty_limit        = isset($values["qty_limit"]) ? floatval($values["qty_limit"]) : 0;
            $order_qty        = isset($values["order_qty"]) ? floatval($values["order_qty"]) : 0;
            $product_price    = isset($values["product_price"]) ? floatval($values["product_price"]) : 0;
            $group_id         = isset($values["Group_ID"]) ? $values["Group_ID"] : '';
            $crate_price      = isset($values["crate_price"]) ? floatval($values["crate_price"]) : 0;
            $status_free      = isset($values['status_free']) ? $values['status_free'] : '';
        
//$item_amount      = isset($values["item_amount"]) ? floatval($values["item_amount"]) : 0;

$free      = isset($values['free']) ? $values['free'] : '';


if($free==''){
$item_amount       = $product_quantity * $product_price;
}else{
$item_amount       = 0;

}


            $item_crate_amount = $product_quantity * $crate_price;
    ?>
                <input type="hidden" name="Item_ID[]" style="text-align:center; max-width:40px;" id="Item_ID<?=$list_id;?>"  value="<?=$Item_ID;?>" data-Product_ID="<?=$list_id;?>" onkeyup="amount()">

                <input type="hidden" name="customer_id[]" style="text-align:center; max-width:40px;" id="customer_id<?=$list_id;?>"  value="<?=$customer_id;?>" data-Product_ID="<?=$list_id;?>" onkeyup="amount()">

                <input type="hidden" name="free[]" style="text-align:center; max-width:40px;" id="free<?=$list_id;?>"  value="<?=$free;?>" data-Product_ID="<?=$list_id;?>" onkeyup="amount()">


        <tr>
            <td align="center"><?=$e;?></td>
            <td align="center"><img src="<?=$pic;?>" height="50" alt="" /></td>
            <td><?=$product_id;?> &nbsp; <?=$product_name;?></td>
            <td align="center"><?=$units;?></td>  
            <td align="center">
                <button type="button" class="btn btn-danger btn-sm qty_minus" data-Product_ID="<?=$list_id;?>">-</button>
                <input type="text" name="QTY[]" style="text-align:center; max-width:40px;" id="e_qty<?=$list_id;?>" class="qtu_box qty_enters" value="<?=$product_quantity;?>" data-Product_ID="<?=$list_id;?>" onkeyup="amount()">
                <button type="button" class="btn btn-success btn-sm qty_plus" data-Product_ID="<?=$list_id;?>">+</button>
                
                <input type="hidden" name="crate_qty[]" style="text-align:center; max-width:40px;" id="crate_qty<?=$list_id;?>" class="qtu_box qty_minus_c" value="<?=$crate_qty;?>" data-Product_ID="<?=$product_id;?>" onkeyup="amount()">
            </td>
            
            <td align="center"><?=number_format($qty_limit, 0);?></td>    
            <td align="center"><?=number_format($order_qty, 0);?></td>    
            <td align="right">
                <?=number_format($product_price, 0);?>
                <input type="hidden" name="Price[]" style="text-align:right; max-width:80px;" class="form-control btn-sm price qty_enters" id="e_price<?=$list_id;?>" value="<?=number_format($product_price, 0);?>" onkeyup="amount()" data-Product_ID="<?=$product_id;?>">
            </td>  
            
            <td align="right">
                <input type="text" name="amount[]" style="text-align:right;max-width:100px;" class="form-control" id="amount<?=$list_id;?>" value="<?=number_format($item_amount, 0);?>" readonly>
                
                <input type="hidden" name="qty_limit[]" id="qty_limit<?=$list_id;?>" value="<?=$qty_limit;?>">
                <input type="hidden" name="Group_ID[]" id="Group_ID<?=$list_id;?>" value="<?=$group_id;?>">       
                <input type="hidden" name="Product_ID[]" id="Product_ID<?=$list_id;?>" value="<?=$product_id;?>">
                <input type="hidden" name="list_id[]" id="list_id<?=$list_id;?>" value="<?=$list_id;?>">   
                <input type="hidden" name="e_name[]" id="e_name<?=$list_id;?>" value="<?=$product_name;?>">
                <input type="hidden" name="crate_price[]" id="crate_price<?=$list_id;?>" value="<?=$crate_price;?>">
                <input type="hidden" name="amount_crate[]" style="text-align:right;max-width:100px;" class="form-control" id="amount_crate<?=$list_id;?>" value="<?=number_format($item_crate_amount, 0);?>" readonly>
                <input type="hidden" class="form-control text_right" name="percent_dis[]" id="percent_dis" value="0" onkeyup="discount_per()" />        
                <input type="hidden" class="form-control text_right" name="discount[]" id="discount" value="0" onkeyup="discount_d()" />   
                <input type="hidden" class="form-control text_right" name="total_amount[]" id="total_amount" value="<?=number_format($item_amount, 0);?>" readonly="readonly" />
                <input type="hidden" name="total_amount_crate[]" id="total_amount_crate<?=$list_id;?>" value="<?=number_format($item_amount + $item_crate_amount, 0);?>" readonly="readonly" class="form-control" style="text-align:right;">
            </td>
            


          <?php  /*
            <td align="center">        
                <?php if ($status_free == '') { ?>
                    <button type="button" name="free_p" class="btn btn-sm free_item" id="<?=$list_id;?>" value="<?=$list_id;?>"><i class="fa fa-check free_item" aria-hidden="true"></i></button>
                <?php } else { ?>
                    <button type="button" name="free_p" class="btn btn-success btn-sm" id="<?=$list_id;?>" value="<?=$list_id;?>"><i class="fa fa-check" aria-hidden="true"></i></button>
                <?php } ?>
            </td> 
*/ ?>



            
        <?php
            if($group_id=='003'){
            ?>
            <td>
                <button type="button" name="delete" class="btn btn-danger btn-sm delete_or" id="<?=$list_id;?>" value="<?=$list_id;?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
        <?php
            }else{

            }
       ?>
           




        </tr>
    <?php
            $total_price       += $item_amount;
            $total_item        += 1;
            $total_qty         += $product_quantity;
            $total_crate_price += $item_crate_amount;
            $total_qty_order   += $order_qty;
            $total_qty_limit   += $qty_limit;
            $total_crate_qty   += $crate_qty;
        }
    ?>
        <tr>  
            <td colspan="4" align="right"><strong>ລວມ</strong></td>  
            <td align="center">
                <strong><input type="text" class="btn btn-sm" readonly="readonly" name="total_qty" id="total_qty" value="<?=number_format($total_qty, 0);?>" style="text-align:center; max-width:120px;" /></strong>
            </td> 
            <td align="center"><?=number_format($total_qty_limit, 0);?></td>
            <td align="center"><?=number_format($total_qty_order, 0);?></td>
            <td></td>
            <td align="right">
                <strong>
                    <input type="text" class="btn btn-sm" readonly="readonly" name="total_all" id="total_all" value="<?=number_format($total_price, 0);?>" style="text-align:right; max-width:120px;" />
                    <input type="hidden" class="btn btn-sm" readonly="readonly" name="total_all_amount" id="total_all_amount" value="<?=number_format($total_price, 0);?>" />
                    <input type="hidden" class="btn btn-sm" readonly="readonly" name="total_crate_price" id="total_crate_price" value="<?=number_format($total_crate_price, 0);?>" style="text-align:right; max-width:120px;" />
                    <input type="hidden" class="btn btn-sm" readonly="readonly" name="last_total" id="last_total" value="<?=number_format($total_price + $total_crate_price, 0);?>" style="text-align:right; max-width:120px;" />
                </strong>
            </td> 
            <td></td>
            <td></td>
        </tr>
    <?php
    } else {
    ?>
        <tr>
            <td colspan="11" align="center">
                <div style="padding: 20px; color: #888;">ບໍ່ມີລາຍການຂາຍ </div>
            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>