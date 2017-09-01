<?php
require_once("../includes/initialize_admin.php");
//LET'S INITIATE CONNECT TO DB

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
//if (isset($_REQUEST['query'])) {
    //$query = 'apecer';
	$sql = $db_handle->runQuery("SELECT * FROM sma_product_datalist WHERE product_name LIKE '%$query%'");
	$array = array();
    while ($row = mysqli_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['product_id'].', '.$row['product_name'],
            'value' => $row['product_name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
//}

?>
