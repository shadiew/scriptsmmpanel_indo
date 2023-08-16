<?php

// include file koneksi database
require('../mainconfig.php');

$cekmutasi = [
    'api_signature' => 'Masukkan API Signature Anda disini',
];

$incomingApiSignature = isset($_SERVER['HTTP_API_SIGNATURE']) ? $_SERVER['HTTP_API_SIGNATURE'] : '';

// validasi API Signature
if (! hash_equals($cekmutasi['api_signature'], $incomingApiSignature)) {
    exit('Invalid Signature');
}

$post = file_get_contents('php://input');
$json = json_decode($post);

if (json_last_error() !== JSON_ERROR_NONE) {
    exit('Invalid JSON');
}

if ($json->action === 'payment_report') {
    foreach ($json->content->data as $data) {
        // Waktu transaksi dalam format unix timestamp
        $time = $data->unix_timestamp;

        // Tipe transaksi : credit / debit
        $type = $data->type;

        // Jumlah (2 desimal) : 50000.00
        $amount = $data->amount;

        // Berita transfer
        $description = $data->description;

        // Saldo rekening (2 desimal) : 1500000.00
        $balance = $data->balance;

        if ($type === 'credit') { // dana masuk
            $amount = $conn->real_escape_string($amount);
            $sql = "SELECT * FROM deposits WHERE amount = '" . $amount . "' AND status = 'Pending' ORDER BY id ASC LIMIT 1";

            if (($exec = $conn->query($sql))) {
                while ($invoice = $exec->fetch_object()) {
                    // Invoice dengan nominal ini ditemukan, lanjutkan proses
                    // contoh proses update status pembayaran invoice UNPAID -> PAID
                    $update = "UPDATE deposits SET status = 'Success' WHERE id = " . $invoice->id;
                    $conn->query($update) or die($conn->error);
                }
            }
        }
    }
}
?>