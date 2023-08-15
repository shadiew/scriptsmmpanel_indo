<?php
require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/header.php';

$orders = mysqli_query($db, "SELECT SUM(orders.price) AS tamount, count(orders.id) AS tcount, orders.user_id, users.full_name FROM orders JOIN users ON orders.user_id = users.id WHERE MONTH(orders.created_at) = '".date('m')."' AND YEAR(orders.created_at) = '".date('Y')."' GROUP BY orders.user_id ORDER BY tamount DESC LIMIT 5");
$deposits = mysqli_query($db, "SELECT SUM(deposits.amount) AS tamount, count(deposits.id) AS tcount, deposits.user_id, users.full_name FROM deposits JOIN users ON deposits.user_id = users.id WHERE MONTH(deposits.created_at) = '".date('m')."' AND YEAR(deposits.created_at) = '".date('Y')."' AND deposits.status = 'Success' GROUP BY deposits.user_id ORDER BY tamount DESC LIMIT 5");
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- Website Analytics -->
                <div class="col-xl-6">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Top 5 Pemesanan Terbayak</h5>
                      
                    </div>
                    <div class="table-responsive card-datatable">
                      <table id="myDataTable" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
$no = 1;
while($data = mysqli_fetch_array($orders)) {
if ($no == 1) {
?> 
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['full_name'] ?></td>
                        <td>Rp <?php echo number_format($data['tamount'],0,',','.') ?> (<?php echo number_format($data['tcount'],0,',','.') ?>)</td>
                      </tr>
<?php
} else { 
?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['full_name'] ?></td>
                        <td>Rp <?php echo number_format($data['tamount'],0,',','.') ?> (<?php echo number_format($data['tcount'],0,',','.') ?>)</td>
                      </tr>

<?php 
}
?>
<?php
  $no++;
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Top 5 Deposit Terbayak</h5>
                      
                    </div>
                    <div class="table-responsive card-datatable">
                      <table id="myDataTables" class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
$no = 1;
while($data = mysqli_fetch_array($deposits)) {
if ($no == 1) {
?> 
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['full_name'] ?></td>
                        <td>Rp <?php echo number_format($data['tamount'],0,',','.') ?> (<?php echo number_format($data['tcount'],0,',','.') ?>)</td>
                      </tr>
<?php
} else { 
?>
                      <tr>
                        <td><?php echo $no ?></td>
                        <td><?php echo $data['full_name'] ?></td>
                        <td>Rp <?php echo number_format($data['tamount'],0,',','.') ?> (<?php echo number_format($data['tcount'],0,',','.') ?>)</td>
                      </tr>

<?php 
}
?>
<?php
  $no++;
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
    $(document).ready(function() {
      // Initialize DataTable
      $('#myDataTables').DataTable({
        // Add any additional configuration options here
      });
    });
  </script>
<?php
require '../lib/footer.php';
?>