<?php
require '../../mainconfig.php';
require '../../lib/check_session_admin.php';
require 'lib/ajax_table.php';
require '../../lib/header_admin.php';
?>
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              

              <!-- DataTable with Buttons -->
              <div class="card">
                <div class="card-datatable table-responsive pt-0">
                  <table id="admin" class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Saldo</th>
                        <th>Pengeluaran</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody><?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											$label = ($data_query['status'] == 1) ? 'success' : 'danger';
											?>
                    	<tr>
                    		<td>#<?php echo $data_query['id'] ?></td>
							<td><?php echo $data_query['username'] ?></td>
							<td><?php echo $data_query['full_name'] ?></td>
							<td><?php echo $data_query['email'] ?></td>
							<td>Rp <?php echo number_format($data_query['balance'],0,',','.') ?></td>
							<td>Rp <?php echo number_format($model->db_query($db, "SUM(price) as total", "orders WHERE user_id = '".$data_query['id']."'")['rows']['total'],0,',','.') ?></td>
							<td><?php echo $data_query['level'] ?></td>
							<td><div class="btn-group mb-2">
														<button data-toggle="dropdown" class="btn btn-<?php echo $label ?> btn-sm dropdown-toggle" aria-haspopup="true" aria-expanded="false"><?php echo $data_query['status'] == "1" ? 'Active' : 'Nonactive' ?> </button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="javascript:;" onclick="update_data('<?php echo $config['web']['base_url'] ?>admin/user/lib/status.php?id=<?php echo $data_query['id'] ?>&status=1')">Active</a>
															<a class="dropdown-item" href="javascript:;" onclick="update_data('<?php echo $config['web']['base_url'] ?>admin/user/lib/status.php?id=<?php echo $data_query['id'] ?>&status=0')">Nonactive</a>
														</div>
													</div></td>
							<td><div class="demo-inline-spacing">
								<button type="button" class="btn btn-icon btn-sm btn-danger">
                            <span class="ti ti-trash"></span>
                          </button>
                          <button type="button" class="btn btn-icon btn-sm btn-warning">
                            <span class="ti ti-pencil"></span>
                          </button></div>
                      		</td>

                    	</tr>
                    	<?php
											}
											?>
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>

<?php
require '../../lib/footer_admin.php';
?>