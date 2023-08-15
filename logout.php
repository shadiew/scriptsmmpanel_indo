<?php
require 'mainconfig.php';
unset($_SESSION['login']);
$_SESSION['result'] = array('alert' => 'success', 'title' => 'Logout!', 'msg' => 'terimakasih, kami senang jika anda kembali lagi.');
exit(header("Location: ".$config['web']['base_url']."auth/login"));