<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$allstores = $zentabooks_operation->get_all_stores();
$id_encrypted = $db_handle->sanitizePost($_GET['hissdel']);
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hissdel = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
	$del_product = $zentabooks_operation->del_product($hissdel);
	if ($del_product){
		 $message_success = "You have successfully deleted the product's data";
	} else {
		$message_error = "Something went wrong. Please try again.";
	}
	header("Location:index");

?>