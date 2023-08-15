<?php
$tanggal = date('Y-m-d'); // Tanggal Request
$kode = 'technobooks-wWnG3LjcXJhCPiX'; // Kode Akses
$jumlah = "1077"; // Jumlah
$bank = 'OVO'; // BNI/BCA/GOPAY/OVO/INDOSAT/TELKOMSEL

$url = "https://cekduit.net/api/input.php";

$curlHandle = curl_init();
curl_setopt($curlHandle, CURLOPT_URL, $url);
curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kode=".$kode."&jumlah=".$jumlah."&bank=".$bank."&tanggal=".$tanggal);
curl_setopt($curlHandle, CURLOPT_HEADER, 0);
curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
curl_setopt($curlHandle, CURLOPT_POST, 1);
$result = curl_exec($curlHandle);
curl_close($curlHandle);

$b = json_decode($result, true);

print_r($b);
