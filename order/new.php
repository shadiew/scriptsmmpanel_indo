<?php
require '../mainconfig.php';
require '../lib/check_session.php';
if ($_POST) {
  require '../lib/is_login.php';
  $input_data = array('service', 'data', 'quantity');
  if (check_input($_POST, $input_data) == false) {
    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
  } else {
    $validation = array(
      'service' => $_POST['service'],
      'data' => $_POST['data'],
    );
    if (check_empty($validation) == true) {
      $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
    } else {
      $service = $model->db_query($db, "*", "services", "id = '".mysqli_real_escape_string($db, $_POST['service'])."' AND status = '1'");
      if ($service['count'] == 0) {
        $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Layanan tidak ditemukan.');
      } else {
        $total_price = ($service['rows']['price'] / 1000) * $_POST['quantity'];
        $total_profit = ($service['rows']['profit'] / 1000) * $_POST['quantity'];
        $provider = $model->db_query($db, "*", "provider", "id = '".$service['rows']['provider_id']."'");
        if ($provider['count'] == 0) {
          $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Maaf saat ini layanan tidak tersedia, silakan kontak Adminn.');
        } elseif ($_POST['quantity'] < $service['rows']['min']) {
          $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Jumlah minimal pesan '.number_format($service['rows']['min'],0,',','.').'.');
        } elseif ($_POST['quantity'] > $service['rows']['max']) {
          $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Jumlah maksimal pesan '.number_format($service['rows']['max'],0,',','.').'.');
        } elseif ($login['balance'] < $total_price) {
          $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Saldo Anda tidak cukup untuk membuat pesanan, sisa saldo Rp '.number_format($login['balance'],0,',','.').'.');
        } else {
          $result_api = false;
          $curl = '';
          $provider_order_id = '1';
          if ($service['rows']['provider_id'] == '1') { // IRVANKEDE
                        $post_api = array(
                            'api_id' => '10557',
              'api_key' => $provider['rows']['api_key'],
              'service' => $service['rows']['provider_service_id'],
              'target' => $_POST['data'],
              'quantity' => $_POST['quantity']
            );
            $curl = post_curl($provider['rows']['api_url_order'], $post_api);
            $result = json_decode($curl, true);
            if (isset($result['status']) AND $result['status'] == true) {
              $provider_order_id = $result['data']['id'];
              $result_api = true;
            }
          } else if ($service['rows']['provider_id'] == '2') { // JAP
            $post_api = array(
              'key' => $provider['rows']['api_key'],
              'service' => $service['rows']['provider_service_id'],
              'action' => 'add',
              'link' => $_POST['data'],
              'quantity' => $_POST['quantity']
            );
            $curl = post_curl($provider['rows']['api_url_order'], $post_api);
            $result = json_decode($curl, true);
            if (isset($result['order']) AND $result['order'] == true) {
              $provider_order_id = $result['order'];
              $result_api = true;
            }
          } 
          if ($result_api == false) {
            $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Maaf saat ini layanan tidak tersedia, silakan kontak Admin.');
          } else {
            $input_post = array(
              'user_id' => $login['id'],
              'service_name' => $service['rows']['service_name'],
              'data' => $_POST['data'],
              'quantity' => $_POST['quantity'],
              'price' => $total_price,
              'profit' => $total_profit,
              'remains' => $_POST['quantity'],
              'status' => 'Pending',
              'provider_id' => $service['rows']['provider_id'],
              'provider_order_id' => $provider_order_id,
              'created_at' => date('Y-m-d H:i:s'),
              'api_order_log' => $curl
            );
            $insert = $model->db_insert($db, "orders", $input_post);
            if ($insert == true) {
              $model->db_update($db, "users", array('balance' => $login['balance'] - $total_price), "id = '".$login['id']."'");
              $model->db_insert($db, "balance_logs", array('user_id' => $login['id'], 'type' => 'minus', 'amount' => $total_price, 'note' => 'Membuat Pesanan. ID Pesanan: '.$insert.'.', 'created_at' => date('Y-m-d H:i:s')));
              $_SESSION['result'] = array('alert' => 'success', 'title' => 'Pesanan berhasil dibuat.', 'msg' => '<br />ID Pesanan: '.$insert.'<br />Layanan: '.$input_post['service_name'].'<br />Jumlah Pesan: '.number_format($input_post['quantity'],0,',','.').'<br />Total Harga: Rp '.number_format($total_price,0,',','.').'');
            } else {
              $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Pesanan gagal dibuat.');
            }
          }
        }
      }
    }
  }
}
require '../lib/header.php';
?>

            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Pemesanan Baru</h5>
                      
                    </div>
                    <div class="card-body">
                      <form method="post" id="ajax-result">
                        <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select class="form-control" id="category">
                                  <option value="0">Pilih Salah Satu...</option>
                                <?php
                                $category = $model->db_query($db, "*", "categories", null, "name ASC");
                                if ($category['count'] == 1) {
                                  print('<option value="'.$category['rows']['id'].'">'.$category['rows']['name'].'</option>');
                                } else {
                                foreach ($category['rows'] as $key) {
                                  print('<option value="'.$key['id'].'">'.$key['name'].'</option>');
                                }
                                }
                                ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label" for="multicol-last-name">Layanan</label>
                            <select class="form-control" name="service" id="service">
                              <option value="0">Pilih Salah Satu...</option>
                            </select>
                          </div>
                        </div>


                        <div class="mb-3" id="description">
                        </div>

                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Min Order</label>
                            <span class="form-control" id="min">0</span>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Max Order</label>
                            <span class="form-control" id="max">0</span>
                          </div>
                        </div>

                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-email">Harga</label>
                          <div class="input-group input-group-merge">
                            <span class="form-control" id="price"></span>
                            <span class="input-group-text">/1000</span>
                          </div>
                          
                        </div>

                        <div class="row g-3">
                          <div class="col-md-6">
                            <label class="form-label">Target</label>
                            <input type="text" class="form-control" name="data" placeholder="Link/username">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="quantity" placeholder="1000" id="quantity">
                          </div>
                        </div>
                        <input type="hidden" id="rate">

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-phone">Total Harga</label>
                          <input type="text" class="form-control" id="total-price" readonly>
                          <small class="text-danger">*Inputkan jumlah pesan</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Pesan</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Informasi</h5>
                      
                    </div>
                    <div class="card-body">
                      <p>Selamat Datang di Layanan Kami. layanan kami dapat diakses 24jam nonstop.<br>Berikut Panduan Pembelian Layanan:</p>
                      <li>Pilih Kategori Layanan</li>
                      <li>Pilih Layanan</li>
                      <li>Input jumlah</li>
                      <li>Input target sesuai informasi</li>
                      <li>Pastikan semua sudah benar, kesalahan input resiko di tanggung konsumen. Kemudian Klik Tombol <span class="badge bg-primary">Pesan</span></li>
                      <br>
                      <p>Pastikan Saldo anda Cukup. Jika terjadi error atau tidak dapat order, silahkan hubungi Admin di <span class="badge bg-warning">082221584446</span></p>
                    </div>
                  </div>
                </div>
              </div>

              
            </div>
            <!-- / Content -->
<script type="text/javascript">
$(document).ready(function() {
  $('#category').change(function() {
    var category = $('#category').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $config['web']['base_url'] ?>ajax/order-get-service.php",
      data: "category=" + category,
      dataType: "html",
      success: function(data) {
        $('#service').html(data);
        $('#description').html('Deskripsi layanan.');
        $('#min').html('0');
        $('#max').html('0');
        $('#price').val('0');
      }, error: function() {
        $('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
      }
    });
  });
  $('#service').change(function() {
    var service = $('#service').val();
    $.ajax({
      type: "POST",
      url: "<?php echo $config['web']['base_url'] ?>ajax/order-select-service.php",
      data: "service=" + service,
      dataType: "json",
      success: function(data) {
        $('#description').html(data.description);
        $('#min').html(data.min);
        $('#max').html(data.max);
        $('#price').html(data.price);
        $('#rate').val(data.price);
      }, error: function() {
        $('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
      }
    });
  });
  $('#quantity').keyup(function() {
    var quantity = $('#quantity').val(), rate = $('#rate').val() / 1000;
    $('#total-price').val(quantity * rate);
  });
});
</script>
<?php
require '../lib/footer.php';
?>