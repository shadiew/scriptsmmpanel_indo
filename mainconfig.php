<?php

date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '128M');

/* CONFIG */
$config['web'] = array(
	'maintenance' => 0, // 1 = yes, 0 = no
	'title' => 'Topup Ceria',
	'name_logo' => 'Engeeks',
	'meta' => array(
		'description' => '',
		'keywords' => ''
	),
	'base_url' => 'https://localhost/new/',
	'register_url' => 'https://localhost/new/auth/register.php'
);

$config['register'] = array(
	'price' => array(
		'member' => 10000,
		'reseller' => 30000,
	),
	'bonus' => array(
		'member' => 5000,
		'reseller' => 10000,
	)
);

$config['db'] = array(
	'host' => 'localhost',
	'name' => 'smmku',
	'username' => 'root',
	'password' => ''
);
/* END - CONFIG */

require 'lib/db.php';
require 'lib/model.php';
require 'lib/function.php';

session_start();
$model = new Model();
