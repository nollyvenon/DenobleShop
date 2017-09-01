<?php
require_once("../includes/initialize_admin.php");
$product_id =trim(addslashes($_POST['stock_name']));
global $db_handle;
 
        $query = "SELECT * FROM sma_products WHERE id='$product_id' OR code='$product_id' OR name=\"$product_id\"";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
       // $fetched_data = $fetched_data[0];
		$price = $fetched_data[0]['price'];

        $query = "SELECT * FROM sma_product_datalist WHERE (id='$product_id' OR code='$product_id' OR name=\"$product_id\") AND sale_status='1' ORDER BY id ASC LIMIT 1";
        $result = $db_handle->runQuery($query);
        $fetched_data = $db_handle->fetchAssoc($result);
		$product_code = $fetched_data[0]['product_code'];

//$line1 = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name='".$_POST['stock_name']."' and depot='".$_POST['depot']."'");
//$availstock=$line1->quantity;
//$arr = array ("rate"=>"$price","availstock"=>"10");
$arr = array ("rate"=>"$price","serial_no"=>"$product_code");
echo json_encode($arr);


?>