<?php
/**
 * Penulis Kode - SMM Panel script
 * Domain: http://penuliskode.com/
 * Documentation: http://penuliskode.com/smm/script/version-n1/documentation.html
 *
 */

if (isset($_SESSION['login']) AND $config['web']['maintenance'] == 1) {
	exit("<center><h1>SORRY, WEBSITE IS UNDER MAINTENANCE!</h1></center>");
}

require 'is_login.php';
?>
<!--
SMM Panel script by penuliskode.com
Anda dilarang untuk melakukan penyalinan source code dalam website ini, hargailah karya orang lain jika ingin dihargai.
https://id.wikisource.org/wiki/Undang-Undang_Republik_Indonesia_Nomor_28_Tahun_2014
-->
<!DOCTYPE html>
<html>
	<head>
	    <meta name="google-site-verification" content="6irIt2zKEBM9MQ6jT_3FW36w352DBgljrgG62ka2MLw" />
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo $config['web']['meta']['description'] ?>">
		<meta name="keywords" content="<?php echo $config['web']['meta']['keywords'] ?>">
		<meta name="author" content="<?php echo $config['web']['meta']['author'] ?>">
		<link rel="icon" href="<?php echo $config['web']['base_url'] ?>assets/images/logo.jpg" type="image/png">
		<title><?php echo $config['web']['title'] ?></title>
		<link href="<?php echo $config['web']['base_url'] ?>assets/plugins/morris/morris.css" rel="stylesheet" />
		<link href="<?php echo $config['web']['base_url'] ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $config['web']['base_url'] ?>assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $config['web']['base_url'] ?>assets/css/style.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/modernizr.min.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/jquery.min.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/popper.min.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/waves.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/js/jquery.slimscroll.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/plugins/morris/morris.min.js"></script>
		<script src="<?php echo $config['web']['base_url'] ?>assets/plugins/raphael/raphael-min.js"></script>
        <link href="<?php echo $config['web']['base_url'] ?>assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!--<link href="<?php echo $config['web']['base_url'] ?>assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        //<link href="<?php echo $config['web']['base_url'] ?>assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
		//<script src="<?php echo $config['web']['base_url'] ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
        //<script src="<?php echo $config['web']['base_url'] ?>assets/plugins/datatables/dataTables.bootstrap4.min.js"></script> -->
		<style type="text/css">.hide{display:none!important}.show{display:block!important}</style>
		<script type="text/javascript">
        function modal_open(type, url) {
			$('#modal').modal('show');
			if (type == 'add') {
				$('#modal-title').html('<i class="fa fa-plus-square"></i> Tambah Data');
			} else if (type == 'edit') {
				$('#modal-title').html('<i class="fa fa-edit"></i> Ubah Data');
			} else if (type == 'delete') {
				$('#modal-title').html('<i class="fa fa-trash"></i> Hapus Data');
			} else if (type == 'detail') {
				$('#modal-title').html('<i class="fa fa-search"></i> Detail Data');
			} else {
				$('#modal-title').html('Empty');
			}
        	$.ajax({
        		type: "GET",
        		url: url,
        		beforeSend: function() {
        			$('#modal-detail-body').html('Sedang memuat...');
        		},
        		success: function(result) {
        			$('#modal-detail-body').html(result);
        		},
        		error: function() {
        			$('#modal-detail-body').html('Terjadi kesalahan.');
        		}
        	});
        	$('#modal-detail').modal();
        }
		function update_data(url) {
			$('#modal-delete').modal('hide');
			$.ajax({
				type: "GET",
				url: url,
				dataType: "html",
				success: function($data) {
					$('#body-result').html($data);
					$('#datatable').DataTable().ajax.reload();
				}, error: function() {
					$('#body-result').html('<div class="alert alert-danger alert-dismissable"><b>Respon:</b> Gagal!<br /><b>Pesan:</b> Terjadi kesalahan!</div>');
				},
				beforeSend: function() {
					$('#body-result').html('<div class="progress progress-striped active"><div style="width: 100%" class="progress-bar progress-bar-primary"></div></div>');
				}
			});
		}
    	</script>
<style type="text/css">
.block { position: absolute; width: 100%; height: 100%; background: rgba(0,0,0,.5); z-index: 9999; }
</style>
	</head>
	<body>
	<header id="topnav">
			<div class="topbar-main">
				<div class="container-fluid">
					<div class="logo">
						<a href="https://drive.google.com/file/d/1-VdELQrUq2x2G8aVfazEODm1Pll9vi6V/view?usp=drivesdk" class="logo">
							<span class="logo-small"><i class="fa fa-android"></i></span>
							<span class="logo-large"><i class="fa fa-android"></i> <?php echo $config['web']['title'] ?></span>
						</a>
					</div>
					<div class="menu-extras topbar-custom">
						<ul class="list-unstyled topbar-right-menu float-right mb-0">
							<li class="menu-item">
								<a class="navbar-toggle nav-link">
									<div class="lines">
										<span></span>
										<span></span>
										<span></span>
									</div>
								</a>
							</li>
							<?php
					        if (isset($_SESSION['login'])) { ?>
							<li style="padding: 0 10px;">
								<span class="nav-link">Saldo: Rp <?php echo number_format($login['balance'],0,',','.'); ?></span>
							</li>
							<li class="dropdown notification-list">
								<a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
									aria-haspopup="false" aria-expanded="false">
								<i class="fa fa-user"></i> <span class="ml-1 pro-user-name"><?php echo $login['username']; ?> <i class="mdi mdi-chevron-down"></i> </span>
								</a>
								<div class="dropdown-menu dropdown-menu-right profile-dropdown">
									<a href="<?php echo $config['web']['base_url'] ?>user/settings" class="dropdown-item notify-item"><i class="fa fa-gear fa-fw"></i> <span>Pengaturan Akun</span></a>
									<a href="<?php echo $config['web']['base_url'] ?>logout" class="dropdown-item notify-item"><i class="fa fa-sign-out fa-fw"></i> <span>Keluar</span></a>
								</div>
							</li>
							<?php 
        					}
        					?>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="navbar-custom">
				<div class="container-fluid">
					<div id="navigation">
						<ul class="navigation-menu">
						<li class="has-submenu">
							<a href="#"><i class="fa fa-file"></i> Halaman</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin"> Admin</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>"> Pengguna</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo $config['web']['base_url'] ?>admin"> <i class="fa fa-dashboard"></i> Dashboard</a>
						</li>
						<li class="has-submenu">
							<a href="#"><i class="fa fa-tags"></i> Layanan</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/provider">Provider API</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/category">Kategori</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/service">Layanan</a></li>
							</ul>
						</li>
						<li>
							<a href="<?php echo $config['web']['base_url'] ?>admin/user"><i class="fa fa-users"></i>Pengguna</a>
						</li>
						<li class="has-submenu">
							<a href="#"><i class="fa fa-money"></i> Deposit</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/deposit_method">Metode Deposit</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/voucher">Redeem Voucher</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/deposit">Deposit</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/deposit/report">Laporan</a></li>
							</ul>
						</li>
						<li class="has-submenu">
							<a href="#"><i class="fa fa-shopping-cart"></i> Pesanan</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/order">Pesanan</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/order/report">Laporan</a></li>
							</ul>
						</li>
						<li class="has-submenu">
							<a href="#"><i class="fa fa-file"></i> Log</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/log/login">Masuk</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/log/balance-usage">Penggunaan Saldo</a></li>
							</ul>
						</li>
						<li class="has-submenu">
							<a href="#"><i class="fa fa-list"></i> Lainnya</a>
							<ul class="submenu">
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/page">Halaman</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/ticket">Tiket</a></li>
								<li><a href="<?php echo $config['web']['base_url'] ?>admin/news">Berita & Informasi</a></li>
							</ul>
						</li>
                        </ul>
					</div>
				</div>
			</div>
		</header>

        <div class="wrapper">
			<div class="container-fluid" style="padding-top: 30px;">
			<div class="modal fade" id="modal" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title" id="modal-title"></h4>
						</div>
						<div class="modal-body" id="modal-detail-body">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
						</div>
					</div>
				</div>
			</div>
				
                <div class="row">
                    <div class="col-lg-12" id="body-result">
<?php
if (isset($_SESSION['result'])) {
?>
<div class="alert alert-<?php echo $_SESSION['result']['alert'] ?> alert-dismissable">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<b>Respon :</b> <?php echo $_SESSION['result']['title'] ?><br />
	<b>Pesan :</b> <?php echo $_SESSION['result']['msg'] ?>
</div>
<?php
unset($_SESSION['result']);
}
?>
                    </div>
                </div>
