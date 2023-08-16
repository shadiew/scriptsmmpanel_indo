<?php
require 'mainconfig.php';
if (!isset($_SESSION['login'])) {
  header("Location: ".$cfg_baseurl."auth/login");
} else { require 'lib/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- View sales -->
                <div class="col-xl-4 mb-4 col-lg-5 col-12">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-7">
                        <div class="card-body text-nowrap">
                          <h5 class="card-title mb-0">Hallo <?php echo $login['full_name'] ?>! 🎉</h5>
                          <p class="mb-2">Best seller of the month</p>
                          <h4 class="text-primary mb-1">Rp.<?php echo number_format($login['balance'],0,',','.'); ?></h4>
                          <a href="javascript:;" class="btn btn-primary">View Sales</a>
                        </div>
                      </div>
                      <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="<?php echo $config['web']['base_url'] ?>/assets/img/illustrations/card-advance-sale.png"
                            height="140"
                            alt="view sales" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- View sales -->

                <!-- Statistics -->
                <div class="col-xl-8 mb-4 col-lg-7 col-12">
                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <small class="text-muted">Updated 1 month ago</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-4 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                              <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h6 class="mb-0"><?php echo number_format($model->db_query($db, "*", "orders WHERE user_id = '".$_SESSION['login']."'")['count'],0,',','.') ?></h6>
                              <small>Pesanan</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-credit-card ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h6 class="mb-0"><sup>Rp</sup>.<?php echo number_format($model->db_query($db, "SUM(amount) as total", "deposits WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?></h6>
                              <small>Total Deposit</small>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h6 class="mb-0"><sup>Rp</sup>.<?php echo number_format($model->db_query($db, "SUM(price) as total", "orders WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?></h6>
                              <small>Revenue</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Statistics -->

                <!-- Invoice table -->
                <div class="col-xl-xl">
                  <div class="card">
                    <div class="table-responsive card-datatable">
                      <table id="myDataTable" class="table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Waktu</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
$order = $model->db_query($db, "*", "orders", null, "id DESC", "LIMIT 5");
if ($order['count'] == 1) { ?>
                          <tr>
                            <td>#<?php echo $order['rows']['provider_order_id'] ?></td>
                            <td><?php echo $order['rows']['service_name'] ?></td>
                            <td><?php echo $order['rows']['status'] ?></td>
                            <td><?php echo $order['rows']['price'] ?></td>
                            <td><?php echo $order['rows']['quantity'] ?></td>
                            <td><?php echo format_date(substr($order['rows']['created_at'], 0, -9)).", ".substr($order['rows']['created_at'], -8) ?></td>
                          </tr>
                          <?php
} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /Invoice table -->
              </div>
            </div>


            <script type="text/javascript">
                $(window).on('load',function(){
                    $('#basicModal').modal('show');
                });
            </script>
            <!-- Modal -->
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Informasi Website</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <h1 align="center">Selamat Datang</h1>
                                <p align="center">Terimkasih sudah berkunjung</p>
                              </div>
                              <div class="modal-footer">
                                
                                <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Mengerti</button>
                              </div>
                            </div>
                          </div>
                        </div>
<?php
}
require 'lib/footer.php';
?>