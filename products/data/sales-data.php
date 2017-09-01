<?php
require_once("../../includes/initialize_admin.php");
// storing  request (ie, get/post) global array to a variable  
//$requestData= $_REQUEST;
$hiss = $_GET['hiss'];

$columns = array( 
// datatable column index  => database column name
	0 =>'date', 
	1 => 'reference_no',
	2 => 'biller',
	3 => 'customer',
	4 => 'product',
	5 => 'grand_total',
	6 => 'paid',
	7 => 'balance',
	8 => 'payment_status'
);


// getting total number records without any search
$sql = "SELECT us.*, sale_item.quantity AS quantity, us.date AS date
                FROM sma_sales AS us
				LEFT JOIN sma_sale_items AS sale_item ON us.id = sale_item.sale_id 
				WHERE 1 = 1 AND sale_item.product_id ='2'
				ORDER BY us.id DESC ";
//To show the count we dont need all the field
$sql_count .= " SELECT count(*) as id FROM sma_sales AS us
				LEFT JOIN sma_sale_items AS sale_item ON us.id = sale_item.sale_id WHERE 1 = 1 AND sale_item.product_id ='2'";

$query = mysqli_query($conn, $sql) or die("users-data.php: get users");

//Count of the query
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_array($result_count);
$totalFiltered = $row_count['id'];

$query = mysqli_query($conn, $sql) or die("users-data.php: get users");




$data = array();
$slno = 1;
while ($row = mysqli_fetch_array($query)) {  // preparing an array
	$id  = $row["id"];
    $actions = "";
//checks whether the transaction is checked or not
    $checked = "";
    
    //if whole transaction is selected then set as checked
    if ($requestData['columns'][3]['search']['value']) {
        $checked = "checked";
    }
    
    $check_box = '<input type="checkbox" ' . $checked . ' class="bulk_checkbox" value="' . $row['id'] . '">';


    $nestedData = array();

    $nestedData[] = $row["date"];
    $nestedData[] = $row["reference_no"];
    $nestedData[] = $row["biller"];
    $nestedData[] = $row["customer"];
    $nestedData[] = $row["product"].'('.$row["quantity"].')';
    $nestedData[] = $row["grand_total"];
    $nestedData[] = $row["paid"];
    $nestedData[] = $row["grand_total"] - $row["paid"];
    $nestedData[] = "<a class='btn btn-success btn-xs'>". user_account_status($row["payment_status"])."</a>";

    $data[] = $nestedData;
    $slno++;
}



$json_data = array(
    "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    "recordsTotal" => intval($totalData), // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
?>
