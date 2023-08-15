<?php
require '../mainconfig.php';
require '../lib/check_session.php';
// query list for paging
if (isset($_GET['search']) AND isset($_GET['status'])) {
  if (!empty($_GET['search']) AND !empty($_GET['status'])) {
    $query_list = "SELECT * FROM deposits WHERE user_id = '".$_SESSION['login']."' AND method_name LIKE '%".protect_input($_GET['search'])."%' AND status LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC"; // edit
  } else if (!empty($_GET['search'])) {
    $query_list = "SELECT * FROM deposits WHERE user_id = '".$_SESSION['login']."' AND method_name LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC"; // edit
  } else if (!empty($_GET['status'])) {
    $query_list = "SELECT * FROM deposits WHERE user_id = '".$_SESSION['login']."' AND status LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC"; // edit    
  } else {
    $query_list = "SELECT * FROM deposits WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
  }
} else {
  $query_list = "SELECT * FROM deposits WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
}
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page"])) {
  $starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query); 
// 
require '../lib/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
              

              <!-- DataTable with Buttons -->
              <div class="card">
                <div class="card-datatable table-responsive pt-0">
                  <table id="myDataTable" class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Waktu</th>
                        <th>Pembayaran</th>
                        <th>Jenis</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Saldo</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php  
                    while ($data_query = mysqli_fetch_assoc($new_query)) {
                    if($data_query['status'] == "Pending") {
                      $label = "warning";
                    } else if($data_query['status'] == "Canceled") {
                      $label = "danger";
                    } else if($data_query['status'] == "Success") {
                      $label = "success";
                    }
                    ?>
                		<tr>
		                    <td><?php echo $data_query['id'] ?></td>
		                    <td><?php echo format_date(substr($data_query['created_at'], 0, -9)).", ".substr($data_query['created_at'], -8) ?></td>
		                    <td><?php echo $data_query['payment'] == "bank" ? 'Transfer Bank' : 'Transfer Pulsa' ?></td>
		                    <td><?php echo $data_query['type'] == "auto" ? 'Otomatis' : 'Manual' ?></td>
		                    <td><?php echo $data_query['method_name'] ?></td>
		                    <td><sup>Rp</sup>.<?php echo number_format($data_query['post_amount'],0,',','.') ?></td>
                        <td><sup>Rp</sup>.<?php echo number_format($data_query['amount'],0,',','.') ?></td>
                        <td><small><?php echo $data_query['note'] ?></small></td>
                        <td><span class="badge bg-<?php echo $label; ?>"><?php echo $data_query['status'] ?></span></td>
                		</tr>
                		<?php
												}
												?>
                  </table>
                </div>
              </div>
              <!--/ DataTable with Buttons -->
        </div>
        <?php
require '../lib/footer.php';
?>