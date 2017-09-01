<?php
require_once("../includes/initialize_admin.php");
$netunitprice =trim(addslashes($_POST['netunitprice']));
$qty =trim(addslashes($_POST['qty']));
global $db_handle;
 
$sub_total = $netunitprice*intval($qty);
$arr = array ("sub_total"=>"$sub_total");
echo json_encode($arr);


?>