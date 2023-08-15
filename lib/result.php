<?php


if (isset($result_msg)) {
?>
<div class="alert alert-<?php echo $result_msg['alert'] ?> alert-dismissable">
	<b>Respon:</b> <?php echo $result_msg['title'] ?><br />
	<b>Pesan:</b> <?php echo $result_msg['msg'] ?>
</div>
<?php
}