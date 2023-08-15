 <?php
require("../mainconfig.php");
$start_date = date('Y-m-d 23:59:00');
$end_date = date('Y-m-d 00:00:01', strtotime('-1 day', strtotime($start_date)));
$check_target = mysqli_query($db, "SELECT * FROM deposits WHERE status ='Pending' AND type = 'auto' AND (method_name = 'AUTO_OVO' or method_name = 'AUTO_BCA' or method_name = 'AUTO_BNI' or method_name = 'AUTO_MANDIRI' or method_name = 'AUTO_JENIUS') AND (created_at BETWEEN '$start_date' AND '$end_date')");
if(mysqli_num_rows($check_target) == 0) {
	die("Tidak ada deposit pending");
} else {
	while($data_target = mysqli_fetch_assoc($check_target)) {
        $input_post = array(
            'id' => $data_target['user_id'],
            'user_id' => $data_target['user_id'],
            'method_name' => $data_target['method_name'],
            'amount' => $data_target['amount'],
            'status' => 'Success',
            'created_at' => $data_target['created_at']

        );
        if($input_post['method_name'] == 'AUTO_OVO'){
            $bank_name ='OVO';
        } else if ($input_post['method_name'] == 'AUTO_BCA'){
            $bank_name ='BCA';
        } else if ($input_post['method_name'] == 'AUTO_BNI'){
            $bank_name ='BNI';
        } else if ($input_post['method_name'] == 'AUTO_JENIUS'){
            $bank_name ='JENIUS';
        } else if ($input_post['method_name'] == 'AUTO_MANDIRI'){
            $bank_name ='MANDIRI';
        }  

        $url = "https://cekduit.net/api/status.php";
        $kode = 'technobooks-wWnG3LjcXJhCPiX';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kode=".$kode."&jumlah=".$input_post['amount']."&bank=".$bank_name."&tanggal=".$input_post['created_at']);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $result = curl_exec($curlHandle);
        curl_close($curlHandle);


        $response = json_decode($result, true);
  
        if($response['status'] == 1) {
            $check_data = $model->db_query($db, "id", "users", "id = '".mysqli_real_escape_string($db, $input_post['user_id'])."'");
            $update = $model->db_update($db, "users", array('balance' => $check_data['rows']['balance'] + $input_post['amount']), "id = '".$input_post['user_id']."'");
            $update = $model->db_update($db, "deposits", array('status' => $input_post['status']), "id = '".$input_post['id']."'");
            if($update == TRUE) {
                echo "ID Deposit: ".$input_post['id']." => Mutasi ditemukan, deposit sukses.<br />";
            } else {
                echo "ID Deposit: ".$input_post['id']." => Mutasi ditemukan, gagal update. <br />";
            }
        } else {
            echo "ID Deposit: ".$input_post['id']." => Mutasi tidak ditemukan<br />";
        }  
    }
} 