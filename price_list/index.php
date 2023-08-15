<?php
require("../mainconfig.php");
require("../lib/header.php");
// query list for paging
if (isset($_GET['search']) AND isset($_GET['category'])) {
	if (!empty($_GET['search']) AND !empty($_GET['category'])) {
		$query_list = "SELECT * FROM services WHERE service_name LIKE '%".protect_input($_GET['search'])."%' AND category_id LIKE '%".protect_input($_GET['category'])."%' AND status = '1' ORDER BY id DESC"; // edit
	} else if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM services WHERE service_name LIKE '%".protect_input($_GET['search'])."%' AND status = '1' ORDER BY id DESC"; // edit
	} else if (!empty($_GET['category'])) {
		$query_list = "SELECT * FROM services WHERE category_id LIKE '%".protect_input($_GET['category'])."%' AND status = '1' ORDER BY id DESC"; // edit		
	} else {
		$query_list = "SELECT * FROM services WHERE status = '1' ORDER BY id DESC"; // edit
	}
} else {
	$query_list = "SELECT * FROM services WHERE status = '1' ORDER BY id DESC"; // edit
}
$records_per_page = 30; // edit

$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query); 
//     
?>

		<div class="container-xxl flex-grow-1 container-p-y">
              

              <!-- DataTable with Buttons -->
              <div class="card">
                <div class="card-datatable table-responsive pt-0">
                  <table id="myDataTable" class="table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Kategori</th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Min</th>
                        <th>Max</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    	<?php
												while ($data_query = mysqli_fetch_assoc($new_query)) {
												$cat_id = $data_query['category_id'];
											    $check_cat = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM categories
                                                WHERE id = '".$data_query['category_id']."'"));
												?>
                		<tr>
		                    <td><?php echo $data_query['id']; ?></td>
		                    <td><?php echo $check_cat['name']; ?></td>
		                    <td><?php echo $data_query['service_name']; ?></td>
		                    <td><sup>Rp</sup>.<?php echo number_format($data_query['price'],0,',','.'); ?>/K</td>
		                    <td><?php echo number_format($data_query['min'],0,',','.'); ?></td>
		                    <td><?php echo number_format($data_query['max'],0,',','.'); ?></td>
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
require("../lib/footer.php");
?>