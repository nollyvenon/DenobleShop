<?php
require_once("../includes/initialize_admin.php");
//LET'S INITIATE CONNECT TO DB
$connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die("Can't connect to server. Please check credentials and try again");
$result = mysql_select_db(DB_NAME) or die("Can't select database. Please check DB name and try again");

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
//if (isset($_REQUEST['query'])) {
    $query = 'apecer';
    $sql = mysql_query ("SELECT id, name FROM sma_products WHERE name LIKE '%$query%'");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['id'].', '.$row['name'],
            'value' => $row['name'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
//}

?>
