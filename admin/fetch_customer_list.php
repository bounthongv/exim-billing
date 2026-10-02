<?php
include("init.php");

/* ---------- helpers ---------- */
function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function post_val($con, $key){
    return isset($_POST[$key]) ? mysqli_real_escape_string($con, trim($_POST[$key])) : '';
}

/* ---------- filters ---------- */
$where = "";

$c_id = post_val($con, 'c_id');
if ($c_id !== '') { $where .= " AND ci.external_id LIKE '%$c_id%'"; }

$c_name = post_val($con, 'c_name');
if ($c_name !== '') { $where .= " AND (ci.outlet_name LIKE '%$c_name%' OR ci.outlet_name_la LIKE '%$c_name%')"; }

$c_type = post_val($con, 'c_type');
if ($c_type !== '') { $where .= " AND c.customer_type = '$c_type'"; }

$c_village = post_val($con, 'c_v');
if ($c_village !== '') { $where .= " AND ci.village LIKE '%$c_village%'"; }

$c_district = post_val($con, 'c_d');
if ($c_district !== '') { $where .= " AND ci.district LIKE '%$c_district%'"; }

$limit = isset($_POST['limit_row']) ? (int)$_POST['limit_row'] : 0;
if ($limit <= 0)      { $limit = 500; }
if ($limit > 20000)   { $limit = 20000; }

/* ---------- query ---------- */
$sql = "SELECT ci.*, c.bill AS bill, c.TIN AS TIN
        FROM customer_import ci
        LEFT JOIN customers c ON c.customer_id = ci.external_id
        WHERE 1=1 $where
        ORDER BY ci.external_id
        LIMIT $limit";

$sp = mysqli_query($con, $sql);
if (!$sp) {
    echo "<div class='alert alert-danger'>SQL error: " . h(mysqli_error($con)) . "</div>";
    exit;
}

/* columns shown in the table (db column => header) */
$columns = array(
    'external_id'             => 'external_id',
    'outlet_name'             => 'outlet_name',
    'outlet_name_la'          => 'outlet_name_la',
    'phone_number'            => 'phone_number',
    'Province'                => 'Province',
    'district'                => 'district',
    'village'                 => 'village',
    'region_LA'               => 'region_LA',
    'Province_LA'             => 'Province_LA',
    'Village_LA'              => 'Village_LA',
    'latitude'                => 'latitude',
    'longitude'               => 'longitude',
    'business_segment_code'   => 'business_segment_code',
    'channel_code'            => 'channel_code',
    'sub_channel_full'        => 'sub_channel_full',
    'classification_code'     => 'classification_code',
    'Sale_Id'                 => 'Sale_Id',
    'Sale_full_name'          => 'Sale_full_name',
    'credit'                  => 'credit',
    'Debt_collection'         => 'Debt_collection',
    'Number_of_days_overdue'  => 'Number_of_days_overdue',
    'Contract_expiration_date'=> 'Contract_expiration_date',
    'bill'                    => 'bill',
);
?>
<table id="example" class="table table-bordered">
  <thead>
    <tr class="bgtd">
      <td align="center"><strong>No</strong></td>
      <?php foreach ($columns as $label) { ?>
        <td><strong><?php echo h($label); ?></strong></td>
      <?php } ?>
      <td><strong>ແກ້ໄຂ</strong></td>
      <td><strong>ລົບ</strong></td>
    </tr>
  </thead>
  <tbody>
<?php
$row_list = 0;
while ($f = mysqli_fetch_assoc($sp)) {
    $row_list++;

    /* data-* attributes used by the edit modal (key => value) */
    $data = array(
        'id'                     => isset($f['id']) ? $f['id'] : '',
        'customer_id'            => $f['external_id'],
        'customer_name'          => $f['outlet_name'],
        'outlet_name_la'         => $f['outlet_name_la'],
        'phone'                  => $f['phone_number'],
        'province'               => $f['Province'],
        'district'               => $f['district'],
        'village'                => $f['village'],
        'latitude'               => $f['latitude'],
        'longitude'              => $f['longitude'],
        'business_segment_code'  => $f['business_segment_code'],
        'channel_code'           => $f['channel_code'],
        'sub_channel_full'       => $f['sub_channel_full'],
        'classification_code'    => $f['classification_code'],
        'sale_id'                => $f['Sale_Id'],
        'sale_full_name'         => $f['Sale_full_name'],
        'credit'                 => $f['credit'],
        'debt_collection'        => $f['Debt_collection'],
        'days_overdue'           => $f['Number_of_days_overdue'],
        'contract_date'          => $f['Contract_expiration_date'],
        'bill'                   => $f['bill'],
        'tin'                    => $f['TIN'],
    );
    $attr = '';
    foreach ($data as $k => $v) {
        $attr .= ' data-' . $k . '="' . h($v) . '"';
    }
?>
    <tr>
      <td align="center"><?php echo $row_list; ?></td>
      <?php foreach ($columns as $col => $label) { ?>
        <td><?php echo h(isset($f[$col]) ? $f[$col] : ''); ?></td>
      <?php } ?>
      <td>
        <button type="button" class="btn btn-success btn-sm edit_customer"
                data-toggle="modal" data-target="#customer_modal"<?php echo $attr; ?>>ແກ້ໄຂ</button>
      </td>
      <td>
        <button type="button" class="btn btn-danger btn-sm delete_Id"
                id="<?php echo h(isset($f['id']) ? $f['id'] : ''); ?>"
                data-customer_id="<?php echo h($f['external_id']); ?>">ລົບ</button>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>