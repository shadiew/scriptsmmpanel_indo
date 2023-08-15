<?php
require("../mainconfig.php");
require("function_bca.php");
$check_target = mysqli_query($db, "SELECT * FROM deposits WHERE status = 'Pending' AND type = 'manual' AND method_name = 'Bank BCA'");
if(mysqli_num_rows($check_target) == 0) {
	die("Tidak ada deposit pending");
} else {
    while ($data_target = mysqli_fetch_assoc($check_target)) {
        $input_post = array(
            'id' => $data_target['id'],
            'user_id' => $data_target['user_id'],
            'method_name' => $data_target['method_name'],
            'amount' => $data_target['amount'],
            'status' => 'Success',
            'created_at' => $data_target['created_at']

        );
        $check_deposit = check_bca($deposit_tf);
        if ($check_deposit == "sukses") {    
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