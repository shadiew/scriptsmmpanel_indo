<?php
require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/header.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-xl-12">
                  <div class="nav-align-top nav-tabs-shadow mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#parameter"
                          aria-controls="navs-top-home"
                          aria-selected="true">
                          Parameter
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#layanan"
                          aria-controls="navs-top-profile"
                          aria-selected="false">
                          Layanan
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#pemesanan"
                          aria-controls="navs-top-messages"
                          aria-selected="false">
                          Pemesanan
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#status"
                          aria-controls="navs-top-messages"
                          aria-selected="false">
                          Status
                        </button>
                      </li>
                      
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="parameter" role="tabpanel">
                          <table class="table table-bordered">
                            <tr>
                              <td width="50%">HTTP METHOD</td>
                              <td>POST</td>
                            </tr>
                            <tr>
                              <td>FORMAT RESPON</td>
                              <td>JSON</td>
                            </tr>
                            <tr>
                              <td>API URL</td>
                              <td><?php echo $config['web']['base_url'] ?>api/json.php</td>
                            </tr>
                            <tr>
                              <td>API KEY</td>
                              <td><?php echo $login['api_key'] ?> <a href="<?php echo $config['web']['base_url'] ?>user/post-settings.php?action=api_key" class="btn btn-xs btn-custom" title="Buat ulang"><i class="fa fa-random"></i></a></td>
                            </tr>
                            <tr>
                              <td>CONTOH CLASS</td>
                              <td><a href="<?php echo $config['web']['base_url'] ?>api/example.api.txt" target="_blank">CONTOH API</a></td>
                            </tr>
                          </table>
                      </div>
                      <div class="tab-pane fade" id="layanan" role="tabpanel">
                       <div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Parameter</th>
      <th>Keterangan</th>
    </tr>
    <tr>
      <td>api_key</td>
      <td>API Key Anda.</td>
    </tr>
    <tr>
      <td>action</td>
      <td>services</td>
    </tr>
  </table>
</div><br>
<h6>Contoh Respon Yang Ditampilkan</h6>
<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Resppon Sukses</th>
      <th>Respon Gagal</th>
    </tr>
    <tr>
      <td>
<pre>{
  "status": true,
  "data": [
    {
      "id": 1,
      "name": "Instagram Followers S1",
      "price": 10000,
      "min": 100,
      "max": 10000,
      "note": "Super Fast, Input Username",
      "category": "Instagram Followers"
    },
    {
      "id": 2,
      "name": "Instagram Likes S1",
      "price": 5000,
      "min": 100,
      "max": 10000,
      "note": "Super Fast, Input Post Url",
      "category": "Instagram Likes"
    },
  ]
}
</pre>
      </td>
      <td>
<pre>{
  "status": false,
  "data": {
    "msg": "API Key salah"
  }
}
</pre>
<b>Kemungkinan pesan yang ditampilkan:</b>
<ul>
  <li>Permintaan tidak sesuai</li>
  <li>API Key salah</li>
</ul>
      </td>
    </tr>
  </table>
</div>
                        
                      </div>
                      <div class="tab-pane fade" id="pemesanan" role="tabpanel">
                        <div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Parameter</th>
      <th>Keterangan</th>
    </tr>
    <tr>
      <td>api_key</td>
      <td>API Key Anda.</td>
    </tr>
    <tr>
      <td>action</td>
      <td>order</td>
    </tr>
    <tr>
      <td>service</td>
      <td>ID Layanan, dapat dilihat di <a href="<?php echo $config['web']['base_url'] ?>price_list">Daftar Layanan</a>.</td>
    </tr>
    <tr>
      <td>data</td>
      <td>Data yang dibutuhkan sesuai layanan, seperti url/username target pesanan.</td>
    </tr>
    <tr>
      <td>quantity</td>
      <td>Jumlah pesan.</td>
    </tr>
  </table>
</div><br>
<h6>Contoh Respon Yang Ditampilkan</h6>
<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Resppon Sukses</th>
      <th>Respon Gagal</th>
    </tr>
    <tr>
      <td>
<pre>{
  "status": true,
  "data": {
    "id": "123"
  }
}
</pre>
      </td>
      <td>
<pre>{
  "status": false,
  "data": {
    "msg": "Saldo tidak cukup"
  }
}
</pre>
<b>Kemungkinan pesan yang ditampilkan:</b>
<ul>
  <li>Permintaan tidak sesuai</li>
  <li>API Key salah</li>
  <li>Layanan tidak ditemukan</li>
  <li>Jumlah pesan tidak sesuai</li>
  <li>Saldo tidak cukup</li>
  <li>Layanan tidak tersedia</li>
</ul>
      </td>
    </tr>
  </table>
</div>
                      </div>
                      <div class="tab-pane fade" id="status" role="tabpanel">
                        <div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Parameter</th>
      <th>Keterangan</th>
    </tr>
    <tr>
      <td>api_key</td>
      <td>API Key Anda.</td>
    </tr>
    <tr>
      <td>action</td>
      <td>status</td>
    </tr>
    <tr>
      <td>id</td>
      <td>ID Pesanan.</td>
    </tr>
  </table>
</div><br>
<h6>Contoh Respon Yang Ditampilkan</h6>
<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th width="50%">Resppon Sukses</th>
      <th>Respon Gagal</th>
    </tr>
    <tr>
      <td>
<pre>{
  "status": true,
  "data": {
    "status": "Processing",
    "start_count": 199,
    "remains": 0
  }
}
</pre>
<b>Kemungkinan status yang ditampilkan:</b>
<ul>
  <li>Pending</li>
  <li>Processing</li>
  <li>Partial</li>
  <li>Error</li>
  <li>Success</li>
</ul>
      </td>
      <td>
<pre>{
  "status": false,
  "data": {
    "msg": "Pesanan tidak ditemukan"
  }
}
</pre>
<b>Kemungkinan pesan yang ditampilkan:</b>
<ul>
  <li>Permintaan tidak sesuai</li>
  <li>API Key salah</li>
  <li>Pesanan tidak ditemukan</li>
</ul>
      </td>
    </tr>
  </table>
</div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>

<?php
require '../lib/footer.php';
?>