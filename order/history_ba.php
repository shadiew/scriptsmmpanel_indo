<?php
error_reporting(0);
require '../mainconfig.php';
require '../lib/check_session.php';
// query list for paging
if (isset($_GET['search']) AND isset($_GET['status'])) {
	if (!empty($_GET['search']) AND !empty($_GET['status'])) {
		$query_list = "SELECT * FROM orders WHERE user_id = '".$_SESSION['login']."' AND data LIKE '%".protect_input($_GET['search'])."%' AND status LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC"; // edit
	} else if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM orders WHERE user_id = '".$_SESSION['login']."' AND data LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC"; // edit
	} else if (!empty($_GET['status'])) {
		$query_list = "SELECT * FROM orders WHERE user_id = '".$_SESSION['login']."' AND status LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC"; // edit		
	} else {
		$query_list = "SELECT * FROM orders WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
	}
} else {
	$query_list = "SELECT * FROM orders WHERE user_id = '".$_SESSION['login']."' ORDER BY id DESC"; // edit
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
						<div class="row">
							<div class="col-lg-12">
                    			<div class="card-box">
                        		<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-pencil"></i> STATUS PESANAN</h4>
                        		<div class="alert alert-info">
								<ul>
                                    <li style="margin-left: -20px;">
                                      <span class="text text-uppercase badge badge-warning" style="width: 80px;"> pending </span> : Orderan sedang berada dalam antrian</li>
                                    <li style="margin-left: -20px;"><span class="text text-uppercase badge badge-info" style="width: 80px;"> processing </span> : Orderan sedang diproses</li>
                                    <li style="margin-left: -20px;"><span class="text text-uppercase badge badge-success" style="width: 80px;"> suksess </span> : Orderan telah sukses diterima oleh target</li>
                                    <li style="margin-left: -20px;"><span class="text text-uppercase badge badge-danger" style="width: 80px;"> error </span> : Orderan gagal diterima oleh target (Saldo refund full)</li>
                                    <li style="margin-left: -20px;"><span class="text text-uppercase badge badge-danger" style="width: 80px;"> partial </span> : Orderan terkirim sebagian pada target (Saldo refund sebagian)</li>
                                  </ul>
								</div>
                        		<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-history"></i> Riwayat Pemesanan</h4>
									<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row">
                                        	<div class="form-group col-lg-5">
                                        		<label>Filter Status</label>
                                        		<select class="form-control" name="status">
                                        			<option value="">Semua</option>
                                                   	<option value="Pending" >Pending</option>
                                                    <option value="Processing" >Processing</option>
                                                    <option value="Success" >Success</option>
                                                    <option value="Error" >Error</option>
                                                    <option value="Partial" >Partial</option>
                                        		</select>
                                        	</div>
                                        	<div class="form-group col-lg-5">
                                        		<label>Kata Kunci Cari</label>
                                        		<input type="text" class="form-control" name="search" placeholder="Kata Kunci..." value="">
                                        	</div>
                                        	<div class="form-group col-lg-2">
                                        		<label>Submit</label>
                                        		<button type="submit" class="btn btn-block btn-dark">Filter</button>
                                        	</div>
                                        </div>
								    </form>
									<div class="table-responsive">
                                        <table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>TANGGAL/WAKTU</th>
													<th style="max-width: 100px;">LAYANAN</th>
													<th>DATA</th>
													<th>JUMLAH</th>
													<th>HARGA</th>
													<th>STATUS</th>
												</tr>
											</thead>
											<?php	
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											if($data_query['status'] == "Pending") {
												$label = "warning";
											} else if($data_query['status'] == "Processing") {
												$label = "info";
											} else if($data_query['status'] == "Error") {
												$label = "danger";
											} else if($data_query['status'] == "Partial") {
												$label = "danger";
											} else if($data_query['status'] == "Success") {
												$label = "success";
											}
											?>
											<tbody>
												<tr>
													<td><a href="javascript:;" onclick="modal_open('detail', '<?php echo $config['web']['base_url']; ?>order/detail/sosmed.php?id=<?php echo $data_query['id'] ?>')" class="badge badge-info">#<?php echo $data_query['id']; ?></a></td>
													<td><?php echo format_date(substr($data_query['created_at'], 0, -9)).", ".substr($data_query['created_at'], -8) ?></td>
													<td><?php echo $data_query['service_name'] ?></td>
													<td><?php echo $data_query['data'] ?></td>
													<td><?php echo $data_query['quantity'] ?></td>
													<td>Rp <?php echo number_format($data_query['price'],0,',','.') ?></td>
													<td><span class="badge badge-<?php echo $label; ?>"><?php echo $data_query['status'] ?></span></td>
												</tr>
                                            </tbody>
											<?php
											}
											?>
										</table>
										<?php
                                        require '../lib/pagination.php';
                                        ?>
										</div>
									</div>
								</div>
							</div>
						</div>
<?php
require '../lib/footer.php';
?>