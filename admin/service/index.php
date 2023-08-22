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
                        <th>Kategori</th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Keuntungan</th>
                        <th>API</th>
                        <th>ID API</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
											<?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											$label = ($data_query['status'] == 1) ? 'success' : 'danger';
											$category_data = $model->db_query($db, "*", "categories",  "id = '".$data_query['category_id']."'");
											$provider_data = $model->db_query($db, "*", "provider",  "id = '".$data_query['provider_id']."'");
											?>
						<tr>
							<td><?php echo $data_query['id'] ?></td>
							<td><?php echo $category_data['rows']['name'] ?></td>
							<td><?php echo $data_query['service_name'] ?></td>
							<td><sup>Rp</sup>.<?php echo number_format($data_query['price'],0,',','.') ?>/<small>K</small></td>
							<td><sup>Rp</sup>.<?php echo number_format($data_query['profit'],0,',','.') ?>/<small>K</small></td>
							<td><?php echo $provider_data['rows']['name'] ?></td>
							<td><?php echo $data_query['provider_service_id'] ?></td>
							<td><div class="demo-inline-spacing">
			                        <span class="badge bg-primary">Primary</span>
			                    </div>
			                </td>
			                <td>
			                	<div class="demo-inline-spacing">
			                          <button type="button" class="btn btn-icon btn-sm btn-danger">
			                            <span class="ti ti-trash"></span>
			                          </button>
			                          <button type="button" class="btn btn-icon btn-sm btn-warning">
			                            <span class="ti ti-pencil"></span>
			                          </button>
			                    </div>
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