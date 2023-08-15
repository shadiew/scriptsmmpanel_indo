<?php
require '../mainconfig.php';
require '../lib/check_session.php';
// query list for paging
if (isset($_GET['search'])) {
	if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM login_logs WHERE user_id = '".$_SESSION['login']."' AND ip_address LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC"; // edit
	} else {
		$query_list = "SELECT * FROM login_logs WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
	}
} else {
	$query_list = "SELECT * FROM login_logs WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
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
                        <th>Id</th>
                        <th>waktu</th>
                        <th>IP</th>
                        
                       
                      </tr>
                    </thead>
                    <tbody>
                    	<?php	
										while ($data_query = mysqli_fetch_assoc($new_query)) {
										?>
                		<tr>
		                    <td><?php echo $data_query['id'] ?></td>
		                    <td><?php echo format_date(substr($data_query['created_at'], 0, -9)).", ".substr($data_query['created_at'], -8) ?></td>
		                    <td><?php echo $data_query['ip_address'] ?></td>
		                    
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