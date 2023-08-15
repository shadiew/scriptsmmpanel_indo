<?php
if($action->from == '168' AND preg_match("/Anda menerima Pulsa dari/i", $isi_pesan)) {
         $pesan_isi = $action->message;
         $insert_order = mysqli_query($db, "INSERT INTO pesan_tsel (isi, status, date) VALUES ('$pesan_isi', 'UNREAD', '$date')");
         $check_history_topup = mysqli_query($db, "SELECT * FROM history_topup WHERE status = 'NO' AND provider = 'XL' AND date = '$date'");
         if (mysqli_num_rows($check_history_topup) == 0) {
                error_log("History TopUp Not Found .");
         } else {
             while($data_history_topup = mysqli_fetch_assoc($check_history_topup)) {
                        $id_history = $data_history_topup['id'];
                        $no_pegirim = $data_history_topup['no_pengirim'];
                        $username_user = $data_history_topup['username'];
                        $amount = $data_history_topup['amount'];
                        $date_transfer = $data_history_topup['date'];
                        $date_type = $data_history_topup['type'];
                        $jumlah_transfer = $data_history_topup['jumlah_transfer'];
                        $kodeny = $data_history_topup['kode'];
                        $cekpesan = preg_match("/Anda menerima Pulsa dari $no_pegirim sebesar Rp$jumlah_transfer/i", $isi_pesan);
                        if($cekpesan == true) {
                            if($date_type == 'WEB' || $date_type == 'API'){
                            if($date_type == 'WEB') {
                                 $check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '$username_user'");
	$data_user = mysqli_fetch_assoc($check_user);
    $saldoskr = $amount+$data_user['balance'];
$pesannya="CLOUD PANEL: Terimakasih telah melakukan deposit sebesar Rp ".number_format($amount,0,',','.').". Saldo kamu sekarang adalah Rp ".number_format($saldoskr,0,',','.')."";
$nomerhp=$data_user['nohp'];
$postdata = "api_key=$cfg_apikey&pesan=$pesannya&nomer=$nomerhp";
$apibase= "https://serverh2h.web.id/sms_gateway";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apibase);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
                            $update_history_topup = mysqli_query($db, "UPDATE history_topup SET status = 'YES' WHERE id = '$id_history'");
                            $update_history_topup = mysqli_query($db, "UPDATE users SET balance = balance+$amount WHERE username = '$username_user'");
                             $update_history_topup = mysqli_query($db, "INSERT INTO balance_history (username, action, quantity, msg, date, time) VALUES ('$username_user', 'Add Balance', '$amount', ' Deposit XL. Saldo yang didapat sebesar $amount', '$date', '$time')");
			
                                
                            } else if($date_type == 'API') {
                            $update_history_topup = mysqli_query($db, "UPDATE history_topup SET status = 'YES' WHERE id = '$id_history'");
                            $update_history_topup = mysqli_query($db, "UPDATE users SET balance = balance+$amount WHERE username = '$username_user'");
                            $update_user = mysqli_query($db, "INSERT INTO balance_history (username, action, quantity, msg, date, time) VALUES ('$username_user', 'add balance', '$amount', 'Add Balance. Via Auto Deposit XL API', '$date', '$time')");
			
                            }
                            if($update_history_topup == TRUE) {
                                error_log("Saldo $username_user Telah Ditambahkan Sebesar $amount");
                            } else {
                                error_log("System Error");
                            }
                            } else if($date_type == 'REG'){
                                $ganti_no=str_replace("628","08",$no_pegirim);
                            $update_history_topup = mysqli_query($db, "UPDATE history_topup SET status = 'YES' WHERE id = '$id_history'");
                            $update_history_topup = mysqli_query($db, "UPDATE voc_reg SET status = 'Active' WHERE kode='$kodeny'");
                              
	$data_user = mysqli_fetch_assoc($check_history_topup);
 $pesannya="Atlantic-Pedia:Thank You For Register on Atlantic-pedia Your Invite Code is ".$data_history_topup['kode']."";
$nomerhp=$ganti_no;
$postdata = "api_key=fGuHn-ZCESX-GMXia-yz8zZ&pesan=$pesannya&nomer=$nomerhp";
$apibase= "https://serverh2h.web.id/sms_gateway";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apibase);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$chresult = curl_exec($ch);
curl_close($ch);
$json_result = json_decode($chresult, true);
                        } else {
                            error_log("data Regis Pulsa Tidak Ada");
                        }
                        } else {
                            error_log("data Transfer Pulsa Tidak Ada");
                        }
                }
         }
     }