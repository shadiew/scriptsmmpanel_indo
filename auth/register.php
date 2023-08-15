<?php 
// Copyright by Penulis Web (Muhammad Sofyan Murtadlo)
// Hargailah orang lain jika Anda ingin dihargai
require '../mainconfig.php';
if (isset($_SESSION['login'])) {
	exit(header("Location: ".$config['web']['base_url']));
}
// 		Google Captcha
function dapetin($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        $data = curl_exec($ch);
        curl_close($ch);
                return json_decode($data, true);
}
if ($_POST) {
	$data = array('full_name', 'username', 'email', 'password', 'confirm_password');
	if (check_input($_POST, $data) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$validation = array(
			'full_name' => protect_input($_POST['full_name']),
			'username' => protect_input($_POST['username']),
			'email' => protect_input($_POST['email']),
			'password' => protect_input($_POST['password']),
			'confirm_password' => protect_input($_POST['confirm_password']),
		);
// 		Google Captcha
		    $secret_key = '6LdY76cUAAAAAE7PahEwewK3uA_Pb2jwXn3PP5Zp'; //masukkan secret key-nya berdasarkan secret key masig-masing saat create api key nya
            $captcha=$_POST['g-recaptcha-response'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret_key) . '&response=' . $captcha;
            $recaptcha = dapetin($url);
		
		if (check_empty($validation) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			$check_ip = $model->db_query($db, "ip_address", "register_logs", "ip_address = '".get_client_ip()."'");
			if ($check_ip['count'] > 0) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Anda sudah mendaftarkan akun sebelumnya.');
			} else if ($validation['password'] <> $validation['confirm_password']) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Konfirmasi password tidak sesuai.');
			} else if (strlen($validation['username']) < 5 OR strlen($validation['password']) < 5) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username/Password minimal 5 karakter.');
			} else if (strlen($validation['username']) > 12 OR strlen($validation['password']) > 12) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username/Password maksimal 12 karakter.');
			} 
			// 		Google Captcha
			else if ($recaptcha['success'] == false) {
	            $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Maaf, Anda kami deteksi sebagai robot.');
			} else {
				$input_post = array(
					'level' => 'Member',
					'username' => strtolower($validation['username']),
					'email' => htmlspecialchars($_POST['email']),
					'password' => password_hash($validation['password'], PASSWORD_DEFAULT),
					'full_name' => htmlspecialchars($_POST['full_name']),
					'balance' => 0,
					'api_key' => str_rand(30),
					'created_at' => date('Y-m-d H:i:s')
				);
				if ($model->db_query($db, "username", "users", "username = '".mysqli_real_escape_string($db, $input_post['username'])."'")['count'] > 0) {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.');
				} else {
					$insert = $model->db_insert($db, "users", $input_post);
					if ($insert == true) {
						$model->db_insert($db, "register_logs", array('user_id' => $insert, 'ip_address' => get_client_ip(), 'created_at' => date('Y-m-d H:i:s')));
						$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => '<br />Username: '.$input_post['username'].'<br />Password: '.$validation['password']);
					} else {
						$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Member gagal didaftarkan.');
					}
				}
			}
		}
	}
}
require '../lib/auth/header.php';
 ?>
 
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-plus"></i> Daftar Akun Baru</h1>
              </div>
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
              <form class="user" method="post">
              	<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
              	<div class="form-group">
                  <input type="text" class="form-control form-control-user" id="full_name" name="full_name" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                  </div>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control form-control-user" id="g-recaptcha-response" name="g-recaptcha-response">
				</div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  <i class="fa fa-check"></i> Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="./login.php">Login Sekarang!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>


<?php
require '../lib/auth/footer.php';
?>