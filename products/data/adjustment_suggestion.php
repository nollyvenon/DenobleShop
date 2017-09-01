<?php
require_once("../../includes/initialize_admin.php");

    
    //get search term
    $searchTerm = $_GET['add_item'];
	$searchTerm = 'samsung';
    
    //get matched data from skills table
    $sql = "SELECT * FROM sma_products WHERE name LIKE '%".$searchTerm."%' ORDER BY name ASC";
	$query = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($query)) {  // preparing an array
       // $data[] = $row['name'];
		$pr[] = array('id' => str_replace(".", "", microtime(true)), 'item_id' => $row['id'], 'label' => $row['name'] . " (" . $row['code'] . ")",
                    'row' => $row, 'options' => $options);
    }
    
    //return json data
    echo json_encode($pr);
?>