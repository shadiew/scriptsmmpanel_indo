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
                        <th>Nama API</th>
                        <th>API KEY</th>
                        <th>API ID/Secret Key/PIN</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody><?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											?>
                    	<tr>
                    		<td><?php echo $data_query['id'] ?></td>
													<td><?php echo $data_query['name'] ?></td>
													<td><?php echo $data_query['api_key'] ?></td>
                    		<td><?php echo $data_query['api_id'] ?></td>
                    		<td>
                    			<div class="demo-inline-spacing">
		                          <button type="button" class="btn btn-icon btn-sm btn-danger">
		                            <span class="ti ti-trash"></span>
		                          </button>
		                          <button type="button" class="btn btn-icon btn-sm btn-primary">
		                            <span class="ti ti-pencil"></span>
		                          </button>
		                      </div>
                    		</td>
                    	</tr><?php
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