<?php
//$this->load->model('products_model');
include_once('../includes/initialize_admin.php');
$dispmessage = '';
  $supplier_id=addslashes($_GET["suppl"]);
  $product_code=addslashes($_GET["prod"]);
 $start=addslashes($_GET["date1"]);
 $end=addslashes($_GET["date2"]);
//if ($_GET["date2"] == 'undefined'){ $end = "";$_GET["date2"] == '';}
			//$supplier_det = $this->companies_model->getCompanyByID($supplier_id);
			//$prod_det = $this->products_model->getProductByCode($product_code);
$supplname = $supplier_det->name;
$prodname = $prod_det->name;
if ($_GET["date1"] != "" and $_GET["date1"] != 'undefined'){
$myDateTime = DateTime::createFromFormat('d/m/Y H:i', $_GET["date1"]);
$start = $myDateTime->format('Y-m-d');
}
if ($_GET["date2"] != "" and $_GET["date2"] != 'undefined'){
$myDateTime1 = DateTime::createFromFormat('d/m/Y H:i', $_GET["date2"]);
$end = $myDateTime1->format('Y-m-d');
}
 // echo date('d, M Y',strtotime($s));
if ($start==""  and $end==""){
	 $query = "SELECT sma_purchases.*,sma_purchase_items.date AS purchase_date,sma_purchase_items.quantity AS qty_bought,sma_purchase_items.unit_cost AS unit_cost,sma_purchase_items.shipping_cost AS shipping_cost1,sma_purchase_items.expenses AS expenses,sma_purchase_items.real_unit_cost AS real_unit_cost,sma_purchase_items.sale_price AS sale_price,sma_purchase_items.real_supplier_id AS real_supplier_id
	  FROM sma_purchase_items LEFT JOIN sma_purchases ON sma_purchase_items.purchase_id=sma_purchases.id 
	  WHERE sma_purchase_items.real_supplier_id = '$supplier_id' AND 
	   sma_purchase_items.product_code = '$product_code' AND 
	   sma_purchase_items.purchase_id != 'NULL'
	  ORDER BY sma_purchase_items.id desc";
//	 $query1 = "SELECT SUM(grand_total) as grand_total FROM sma_sales WHERE salespoint_id = ' $q' order by id desc ";
	 $topdisp = "Report for Product $prodname";
}elseif ($start<>""  and $end==""){
	 $query = "SELECT sma_purchases.*,sma_purchase_items.date AS purchase_date,sma_purchase_items.quantity AS qty_bought,sma_purchase_items.unit_cost AS unit_cost,sma_purchase_items.shipping_cost AS shipping_cost1,sma_purchase_items.expenses AS expenses,sma_purchase_items.real_unit_cost AS real_unit_cost,sma_purchase_items.sale_price AS sale_price,sma_purchase_items.real_supplier_id AS real_supplier_id
	  FROM sma_purchase_items LEFT JOIN sma_purchases ON sma_purchase_items.purchase_id=sma_purchases.id 
	  WHERE sma_purchase_items.real_supplier_id = '$supplier_id' AND 
	   DATE(sma_purchases.date) = '$start' AND
	   sma_purchase_items.product_code = '$product_code' AND 
	   sma_purchase_items.purchase_id != 'NULL'
	  ORDER BY sma_purchase_items.id desc";
//	 $query1 = "SELECT SUM(grand_total) as grand_total,paid FROM sma_sales WHERE salespoint_id = ' $q' AND DATE(date)='$start' order by id desc ";
	 $topdisp = "Report for Product $prodname on the ". date('D d F, Y', strtotime($start));

}elseif ($start<>""  and $end<>""){
	 $query = "SELECT sma_purchases.*,sma_purchase_items.date AS purchase_date,sma_purchase_items.quantity AS qty_bought,sma_purchase_items.unit_cost AS unit_cost,sma_purchase_items.shipping_cost AS shipping_cost1,sma_purchase_items.expenses AS expenses,sma_purchase_items.real_unit_cost AS real_unit_cost,sma_purchase_items.sale_price AS sale_price,sma_purchase_items.real_supplier_id AS real_supplier_id
	  FROM sma_purchase_items LEFT JOIN sma_purchases ON sma_purchase_items.purchase_id=sma_purchases.id 
	  WHERE sma_purchase_items.real_supplier_id = '$supplier_id' AND
	   (DATE(sma_purchases.date) BETWEEN '$start' and '$end') AND
	   sma_purchase_items.product_code = '$product_code' AND 
	   sma_purchase_items.purchase_id != 'NULL'
	  ORDER BY sma_purchase_items.id desc";

	 $query1 = "SELECT SUM(grand_total) as grand_total FROM sma_sales WHERE salespoint_id = '$q' AND date BETWEEN '$start' and '$end' order by date desc";
	 $topdisp = "Report for Product $prodname between ". date('D d F, Y', strtotime($start)) ." and ". date('D W F, Y', strtotime($end));
}
$result = $db_handle->runQuery($query);
$details = $db_handle->fetchAssoc($result);

$result1 = $db_handle->runQuery($query1);
$fetched_data = $db_handle->fetchAssoc($result1);
$grand_total = $fetched_data[0]['grand_total'];

$result2 = $db_handle->runQuery($query2);
$fetched_data = $db_handle->fetchAssoc($result2);
$totamount = $fetched_data[0]['totamount'];

//print_r($details);
echo '<span style="color:#22f;font-size:18px;"><b>'.$topdisp.'</b></span>';

if ($daytotalpay<>"" && $daytotalsales<>""){
echo "<p><button class='btn btn-warning'>$dispmessage</button></p>";
}

?>
<input type="hidden" name="qsalesp" value="<?php echo $q;?>">
<table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>Pur ID </th>
                                            <th>Trans Date </th>
                                            <th>Reference No </th>
                                            <th>Unit Cost(₦) </th>
                                            <th>Real Cost(₦) </th>
                                            <th>Sale Price(₦) </th>
                                            <th>Qty </th>
                                            <th>Pay Status </th>
                                            <th>Note </th>
                                            <th>Status</th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($details) && !empty($details)) {  
                                            for($i = 0; $i < count($details); $i++) { 
                                        ?> 
                                        <tr align="center">
                                            <td><?php echo $details[$i]['id']; ?></td>
                                            <td><?php echo date('d, M Y',strtotime($details[$i]['date'])); ?></td>
                                            <td><?php echo $details[$i]['reference_no']; ?></td>
                                            <td><?php echo number_format($details[$i]['unit_cost'],2); ?></td>
                                            <td><?php echo number_format($details[$i]['real_unit_cost'],2); ?></td>
                                            <td><?php echo number_format($details[$i]['sale_price'],2); ?></td>
                                            <td><?php echo $details[$i]['qty_bought']; ?></td>
                                            <td><?php echo ucfirst($details[$i]['payment_status']); ?></td>
                                            <td><?php echo $details[$i]['note']; ?></td>
                                            <td><?php echo ucfirst($details[$i]['status']); ?></td>
                                        </tr>
                                        <?php $totpurch += $details[$i]['unit_cost']*$details[$i]['qty_bought'];
										$totspent += $details[$i]['real_unit_cost']*$details[$i]['qty_bought'];
										} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                                    </tbody>
                                </table>
                                <b>Total Amount Purchased: ₦<?= number_format($totpurch,2);?></b><br>
                            <b>Total Amount Spent on Purchases: ₦<?= number_format($totspent,2);?></b>                             
                                
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example2').DataTable();
} );
</script>