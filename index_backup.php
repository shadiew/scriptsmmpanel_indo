<?php
require 'mainconfig.php';
if (!isset($_SESSION['login'])) {
	header("Location: ".$cfg_baseurl."welcome");
} else { require 'lib/header.php';
?>
						<div class="row">
							<div class="col-lg-12 text-center" style="margin: 15px 0;">
								<h3 class="text-uppercase"><i class="fa fa-user-circle-o fa-fw"></i> Informasi Akun</h3>
							</div>
							<div class="col-lg-8">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-area-chart"></i> Grafik Pesanan & Deposit 7 Hari Terakhir</h4>
										<div id="last-order-chart" style="height: 200px;"></div>
								</div>
							</div>
							<div class="col-lg-4 text-center">
								<div class="card-box widget-flat border-custom bg-custom text-white">
									<h3 class="m-b-10">Rp <?php echo number_format($model->db_query($db, "SUM(price) as total", "orders WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?> (<?php echo number_format($model->db_query($db, "*", "orders WHERE user_id = '".$_SESSION['login']."'")['count'],0,',','.') ?>)</h3>
									<p class="text-uppercase m-b-5 font-13 font-600"><i class="mdi mdi-cart-outline"></i> Pesanan Saya</p>
								</div>
								<div class="card-box widget-flat border-custom bg-custom text-white">
									<i class="mdi mdi-cash-multiple"></i>
									<h3 class="m-b-10">Rp <?php echo number_format($model->db_query($db, "SUM(amount) as total", "deposits WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?> (<?php echo number_format($model->db_query($db, "*", "deposits WHERE user_id = '".$_SESSION['login']."'")['count'],0,',','.') ?>)</h3>
									<p class="text-uppercase m-b-5 font-13 font-600">Deposit Saya</p>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="profile-user-box card-box bg-custom">
									<div class="row">
										<div class="col-lg-6">
											<span class="pull-left mr-3"><img src="<?php echo $config['web']['base_url'] ?>assets/images/profile.png" alt="Profile" class="thumb-lg rounded-circle"></span>
											<div class="media-body text-white">
												<h4 class="mt-1 mb-1 font-18"><?php echo $login['full_name'] ?></h4>
												<p class="font-13 text-light"><?php echo $login['full_name'] ?> terdaftar sejak <?php echo format_date(substr($login['created_at'], 0, -9)).", ".substr($login['created_at'], -8) ?>.</p>
												<p class="text-light mb-0">Sisa Saldo: Rp <?php echo number_format($login['balance'],0,',','.'); ?></p>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="text-right">
												<a class="btn btn-light" href="<?php echo $config['web']['base_url'] ?>user/settings.php"><i class="fa fa-gear fa-spin fa-fw"></i> Pengaturan Akun</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-12 text-center" style="margin: 15px 0;">
								<h3 class="text-uppercase"><i class="fa fa-bullhorn fa-fw"></i> Informasi Website</h3>
							</div>
							<div class="col-lg-8">
								<div class="card-box">
								<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-info-circle"></i> 5 Informasi Terbaru</h4>
									<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>TANGGAL/WAKTU</th>
												<th>KONTEN</th>
											</tr>
										</thead>
										<tbody>

<?php
$news = $model->db_query($db, "*", "news", null, "id DESC", "LIMIT 5");
if ($news['count'] == 1) { ?>
	<tr>
		<td><?php echo format_date(substr($news['rows']['created_at'], 0, -9)).", ".substr($news['rows']['created_at'], -8) ?></td>
		<td><?php echo nl2br($news['rows']['content']) ?></td>
	</tr>
<?php
} else {
	foreach ($news['rows'] as $key => $value) {
?>
<tr>
	<td><?php echo format_date(substr($value['created_at'], 0, -9)).", ".substr($value['created_at'], -8) ?></td>
	<td><?php echo nl2br($value['content']) ?></td>
</tr>
<?php
	}
}
if ($news['count'] >= 5) { ?>

<?php
}
?>
										</tbody>
									</table>
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-link fa-fw"></i> Sitemap</h4>
									<ul>
										<li><a href="<?php echo $config['web']['base_url'] ?>page/contact">Kontak</a></li>
										<li><a href="<?php echo $config['web']['base_url'] ?>page/tos">Ketentuan Layanan</a></li>
										<li><a href="<?php echo $config['web']['base_url'] ?>page/faq">Pertanyaan Umum</a></li>
									</ul>
								</div>
							</div>
						</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>

<div class="modal hide fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-info-circle"></i> 5 Informasi Terbaru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
									<table class="table table-bordered">
										<tbody>

<?php
$news = $model->db_query($db, "*", "news", null, "id DESC", "LIMIT 5");
if ($news['count'] == 1) { ?>
	<tr>
		<td><?php echo nl2br($news['rows']['content']) ?></td>
	</tr>
<?php
} else {
	foreach ($news['rows'] as $key => $value) {
?>
<tr>
	<td><?php echo format_date(substr($value['created_at'], 0, -9)).", ".substr($value['created_at'], -8) ?></td>
	<td><?php echo nl2br($value['content']) ?></td>
</tr>
<?php
	}
}
if ($news['count'] >= 5) { ?>

<?php
}
?>
										</tbody>
									</table>
									</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Saya Sudah Membacanya</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
Morris.Area({
	element: 'last-order-chart',
	data: [
<?php
$date_list = array();
for ($i = 6; $i > -1; $i--) {
	$date_list[] = date('Y-m-d', strtotime('-'.$i.' days'));
}

for ($i = 0; $i < count($date_list); $i++) {
	$get_order = $model->db_query($db, "*", "orders", "user_id = '".$login['id']."' AND DATE(created_at) = '".$date_list[$i]."'");
	$get_deposit = $model->db_query($db, "*", "deposits", "user_id = '".$login['id']."' AND DATE(created_at) = '".$date_list[$i]."' AND status = 'Success'");
	print("{ y: '".format_date($date_list[$i])."', a: ".$get_order['count'].", b: ".$get_deposit['count']." }, ");
}
?>
	],
	xkey: 'y',
	ykeys: ['a','b'],
	labels: ['Pesanan','Deposit'],
	lineColors: ['#02c0ce','#53c68c'],
	gridLineColor: '#eef0f2',
	pointSize: 0,
	lineWidth: 0,
	resize: true,
	parseTime: false
});
</script>
<?php
}
require 'lib/footer.php';
?>