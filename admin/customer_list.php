<?php
include("init.php");

/* ---------- suggested code for a NEW customer ---------- */
$sql_max = mysqli_query($con, "select max(SUBSTRING(customer_id, 2, 7)) as id from customers");
$row_max = $sql_max ? mysqli_fetch_row($sql_max) : array(0);
$max_id  = (int)$row_max[0];
$suppliers_id = 'C' . str_pad($max_id + 1, 4, '0', STR_PAD_LEFT);   // C0001, C0002, ...
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/fontawesome-all.css" rel="stylesheet">
<link href="js/iconic.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<?php include("header.php"); ?>

<style>
td { padding:10px; height:20px; }
#search { border:1px solid #008000; border-radius:4px; background-color:#008000; padding:5px; color:#FFF; font-family:"Phetsarath OT"; }
input { padding:4px; border:1px solid #D8D8D8; border-radius:4px; }
.bgtd { background-color:#EBEBEB; }
.container_new { padding-left:10px; }
</style>

<link rel="stylesheet" href="select2/select2.min.css">
<script src="select2/select2.full.min.js"></script>
<script>
$(function () { $('.select2').select2(); });
</script>

<div class="container_new">
  <br>
  <h3 align="center">ລາຍການລູກຄ້າ</h3><br>

  <!-- ===================== search bar ===================== -->
  <table>
    <tr>
      <td><br>
        <button type="button" class="btn btn-success add_customer" data-toggle="modal" data-target="#customer_modal">
          <i class="fa fa-plus-square"></i>&nbsp; ເພີ່ມ
        </button>
      </td>
      <td>ປະເພດ<br>
        <select name="c_type" id="c_type" class="form-control s_customer">
          <option value="">ທັງໝົດ</option>
          <option value="002">wholesaler</option>
          <option value="003">outlet</option>
        </select>
      </td>
      <td>ລະຫັດ<br><input type="text" id="c_id" class="form-control s_customer"></td>
      <td>ຊື່ລູກຄ້າ<br><input type="text" id="c_name" class="form-control s_customer"></td>
      <td>ບ້ານ<br><input type="text" id="c_village" class="form-control s_customer"></td>
      <td>ເມືອງ<br><input type="text" id="c_district" class="form-control s_customer"></td>
      <td>ຈຳນວນສະແດງ<br><input type="text" id="limit_row" class="form-control s_customer" value="1000"></td>
      <td><br>
        <button type="button" class="btn btn-success" id="print_excel"><i class="fa fa-file-excel" aria-hidden="true"></i></button>
      </td>
      <td>
        <form action="import_customer_file.php" method="post" enctype="multipart/form-data">
          <input type="file" name="excel_file" accept=".csv" required>
          <button type="submit" name="import">นำเข้าข้อมูล</button>
        </form>
      </td>
    </tr>
  </table>

  <!-- ===================== list ===================== -->
  <div class="row">
    <div class="col-lg-12">
      <br>
      <div id="display_stock_list"></div>
    </div>
  </div>

  <?php if (isset($_SESSION['smg'])) { echo $_SESSION['smg']; unset($_SESSION['smg']); } ?>
  <br><br>
</div>

<!-- =========================================================
     ONE modal used for both ADD and EDIT (no duplicate ids)
     ========================================================= -->
<div class="modal" id="customer_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">ແກ້ໄຂລາຍການລູກຄ້າ</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="customer_form" action="insert_customer.php" method="post" enctype="multipart/form-data">

          <button type="submit" class="btn btn-primary">ບັນທືກ</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">ປິດ</button>

          <input type="hidden" name="action" id="action" value="Update">
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="customer_id2" id="customer_id2" value="">

          <table border="0">
            <tr>
              <td align="right">ລະຫັດ:</td>
              <td><input type="text" class="form-control" name="customer_id" id="customer_id" required></td>
            </tr>
            <tr>
              <td align="right">ຊື່ ລູກຄ້າ :</td>
              <td><input type="text" class="form-control" name="customer_name" id="customer_name"></td>
              <td align="right">latitude:</td>
              <td><input type="text" class="form-control" name="latitude" id="latitude"></td>
              <td align="right">Sale_Id:</td>
              <td><input type="text" class="form-control" name="Sale_Id" id="Sale_Id"></td>
            </tr>
            <tr>
              <td align="right">ຊື່ ລູກຄ້າ ລາວ:</td>
              <td><input type="text" class="form-control" name="outlet_name_la" id="outlet_name_la"></td>
              <td align="right">longitude :</td>
              <td><input type="text" class="form-control" name="longitude" id="longitude"></td>
              <td align="right">Sale_full_name :</td>
              <td><input type="text" class="form-control" name="Sale_full_name" id="Sale_full_name"></td>
            </tr>
            <tr>
              <td align="right">ເບີໂທລະສັບ:</td>
              <td><input type="text" class="form-control" name="phone" id="phone"></td>
              <td align="right">business_segment_code:</td>
              <td><input type="text" class="form-control" name="business_segment_code" id="business_segment_code"></td>
              <td align="right">ເຄຣດິດ :</td>
              <td><input type="checkbox" class="form-control" id="credit" name="credit" value="YES"></td>
            </tr>
            <tr>
              <td align="right">ບ້ານ:</td>
              <td><input type="text" class="form-control" name="village" id="village"></td>
              <td align="right">channel_code:</td>
              <td><input type="text" class="form-control" name="channel_code" id="channel_code"></td>
              <td align="right">ວົງເງິນຕິດໜີ້:</td>
              <td><input type="text" class="form-control" name="Debt_collection" id="Debt_collection" disabled></td>
            </tr>
            <tr>
              <td align="right">ເມືອງ:</td>
              <td><input type="text" class="form-control" name="district" id="district"></td>
              <td align="right">sub_channel_full:</td>
              <td><input type="text" class="form-control" name="sub_channel_full" id="sub_channel_full"></td>
              <td align="right">ຈໍານວນມື້ຕິດໜີ້ :</td>
              <td><input type="text" class="form-control" name="Number_of_days_overdue" id="Number_of_days_overdue" disabled></td>
            </tr>
            <tr>
              <td align="right">ແຂວງ:</td>
              <td><input type="text" class="form-control" name="Province" id="Province"></td>
              <td align="right">classification_code:</td>
              <td><input type="text" class="form-control" name="classification_code" id="classification_code"></td>
              <td align="right">ວັນທີໝົດອາຍຸສັນຍາ:</td>
              <td><input type="date" class="form-control" name="Contract_expiration_date" id="Contract_expiration_date" disabled></td>
            </tr>
            <tr>
              <td align="right">ຈຳນວນໃບບິນ:</td>
              <td><input type="text" class="form-control" name="bill" id="bill" value="0"></td>
              <td align="right">TIN:</td>
              <td><input type="text" class="form-control" name="TIN" id="TIN" value="0"></td>
            </tr>
          </table>

        </form>
      </div>

    </div>
  </div>
</div>

<script src="js/numeral.min.js"></script>
<script>
$(function () {

    var NEW_CODE = '<?php echo htmlspecialchars($suppliers_id, ENT_QUOTES); ?>';
    var TODAY    = '<?php echo date("Y-m-d"); ?>';

    /* ---------------- list loading ---------------- */
    function loadList() {
        $.post('fetch_customer_list.php', {
            c_type: $('#c_type').val(),
            c_id: $('#c_id').val(),
            c_name: $('#c_name').val(),
            c_v: $('#c_village').val(),
            c_d: $('#c_district').val(),
            limit_row: $('#limit_row').val()
        }, function (html) {
            $('#display_stock_list').html(html);
        });
    }
    loadList();

    var timer = null;
    $(document).on('keyup change', '.s_customer', function () {
        clearTimeout(timer);
        timer = setTimeout(loadList, 250);
    });

    /* ---------------- credit checkbox ---------------- */
    var $debt = $('#Debt_collection, #Number_of_days_overdue, #Contract_expiration_date');

    function applyCredit(on) {
        $('#credit').prop('checked', on);
        $debt.prop('disabled', !on);
    }

    $('#credit').on('change', function () {
        var on = this.checked;
        applyCredit(on);
        if (!on) {
            $debt.val('');
        } else {
            if ($('#Debt_collection').val() === '')         $('#Debt_collection').val('0');
            if ($('#Number_of_days_overdue').val() === '')  $('#Number_of_days_overdue').val('0');
            if ($('#Contract_expiration_date').val() === '') $('#Contract_expiration_date').val(TODAY);
        }
    });

    /* ---------------- fill the modal ---------------- */
    // form field id  ->  data-* attribute on the edit button
    var MAP = {
        id: 'id',
        customer_id: 'customer_id',
        customer_id2: 'customer_id',
        customer_name: 'customer_name',
        outlet_name_la: 'outlet_name_la',
        phone: 'phone',
        Province: 'province',
        district: 'district',
        village: 'village',
        latitude: 'latitude',
        longitude: 'longitude',
        business_segment_code: 'business_segment_code',
        channel_code: 'channel_code',
        sub_channel_full: 'sub_channel_full',
        classification_code: 'classification_code',
        Sale_Id: 'sale_id',
        Sale_full_name: 'sale_full_name',
        bill: 'bill',
        TIN: 'tin'
    };

    $(document).on('click', '.edit_customer', function () {
        var btn = $(this);

        $.each(MAP, function (field, key) {
            var v = btn.attr('data-' + key);
            $('#' + field).val(v === undefined ? '' : v);
        });
        if ($('#bill').val() === '') $('#bill').val('0');
        if ($('#TIN').val() === '')  $('#TIN').val('0');

        var on = (btn.attr('data-credit') === 'YES');
        applyCredit(on);
        if (on) {
            $('#Debt_collection').val(btn.attr('data-debt_collection') || '');
            $('#Number_of_days_overdue').val(btn.attr('data-days_overdue') || '');
            var d = btn.attr('data-contract_date') || '';
            $('#Contract_expiration_date').val(/^\d{4}-\d{2}-\d{2}$/.test(d) ? d : '');
        } else {
            $debt.val('');
        }

        $('#action').val('Update');
        $('#modal_title').text('ແກ້ໄຂລາຍການລູກຄ້າ');
    });

    $(document).on('click', '.add_customer', function () {
        $('#customer_form')[0].reset();
        $.each(MAP, function (field) { $('#' + field).val(''); });
        $('#customer_id').val(NEW_CODE);
        $('#bill').val('0');
        $('#TIN').val('0');
        applyCredit(false);
        $debt.val('');
        $('#action').val('Add');
        $('#modal_title').text('ເພີ່ມລູກຄ້າ');
    });

    /* ---------------- delete / excel ---------------- */
    $(document).on('click', '.delete_Id', function () {
        var Id = $(this).attr('id');
        var customer_id = $(this).attr('data-customer_id');
        if (confirm('ທ່ານ ຕ້ອງການລົບແທ້ບໍ່?')) {
            window.location = 'delete_customer.php?Id=' + encodeURIComponent(Id) +
                              '&customer_id=' + encodeURIComponent(customer_id);
        }
    });

    $(document).on('click', '#print_excel', function () {
        window.open('customer_list_excel.php?c_type=' + encodeURIComponent($('#c_type').val()) +
            '&c_id=' + encodeURIComponent($('#c_id').val()) +
            '&c_name=' + encodeURIComponent($('#c_name').val()) +
            '&c_v=' + encodeURIComponent($('#c_village').val()) +
            '&c_d=' + encodeURIComponent($('#c_district').val()) +
            '&limit_row=' + encodeURIComponent($('#limit_row').val()), '_blank');
    });
});
</script>
</html>