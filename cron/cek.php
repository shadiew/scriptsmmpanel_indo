<?
date_default_timezone_set('asia/jakarta');
require '../mainconfig.php';


$tgl=date('Y-m-d 23:59:59');
$tgl1=date('Y-m-d 00:00:01', strtotime('-1 day', strtotime($tgl)));

$check_order = mysqli_query($db, "SELECT * FROM deposits WHERE status='Pending' AND type='auto' AND (created_at BETWEEN '$tgl1' AND '$tgl')");
if (mysqli_num_rows($check_order) == 0) {
	die("Order Error or Partial not found.");
} else {
	while($data_order = mysqli_fetch_assoc($check_order)) {
$id = $data_order['id'];
$userid=$data_order['user_id'];
$jumlah= $data_order['post_amount'];
$bank = $data_order['method_name'];   
$tanggal = $data_order['created_at'];
$balance= $data_order['amount'];
$kode= 'zzal1994-HgymkehR2kNgmQy';
$url = "https://cekduit.net/api/status.php";

$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kode=".$kode."&jumlah=".$jumlah."&bank=".$bank."&tanggal=".$tanggal);
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$result = curl_exec($curlHandle);
curl_close($curlHandle);


$hasil = json_decode($result, true);
$status= $hasil['status'];
if($hasil['status'] == 1) {
	$b = "UPDATE users SET balance = balance+$balance  WHERE id = '$userid'";
	mysqli_query($db, $b);
		$b = "UPDATE deposits SET status = 'Success' WHERE id = '$id'";
	mysqli_query($db, $b);
        echo "Sukses deposit - $balance - $id <br>";
    
}elseif($hasil['status'] == 0) {
    echo "Dana/Saldo tidak diterima $id $balance <br>";
    
}

	}
}