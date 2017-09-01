<?php

include_once('../includes/initialize_admin.php');
$dispmessage = '';
 $q=addslashes($_GET["q"]);
if ($_GET["r"] != ""){
$myDateTime = DateTime::createFromFormat('d/m/Y H:i', $_GET["r"]);
$start = $myDateTime->format('Y-m-d');
}
if ($_GET["s"] != ""){
$myDateTime1 = DateTime::createFromFormat('d/m/Y H:i', $_GET["s"]);
$end = $myDateTime1->format('Y-m-d');
}
 // echo date('d, M Y',strtotime($s));
if ($q <> "" and $start==""  and $end==""){
	 $query = "SELECT * FROM sma_payments WHERE salespoint_id = '$q' order by id desc ";
	 $query1 = "SELECT SUM(grand_total) as grand_total FROM sma_sales WHERE salespoint_id = ' $q' order by id desc ";
	 $topdisp = "Report for Salespoint $q";
}elseif ($q <> "" and $start<>""  and $end==""){
	 $query = "SELECT * FROM sma_payments WHERE salespoint_id = '$q' AND DATE(date)='$start' order by id desc ";
	 $query1 = "SELECT SUM(grand_total) as grand_total,paid FROM sma_sales WHERE salespoint_id = ' $q' AND DATE(date)='$start' order by id desc ";
	 //$query2 = "SELECT SUM(amount) AS totamount FROM sma_payments WHERE salespoint_id = '$q' AND DATE(date)='$start'";
	 $query2 = "SELECT SUM(sma_payments.amount) AS totamount FROM sma_payments,sma_sales WHERE sma_sales.id=sma_payments.sale_id AND DATE(sma_payments.date)='$start' AND sma_payments.salespoint_id = ' $q'";
	 $topdisp = "Report for Salespoint $q on the ". date('D d F, Y', strtotime($start));

	  $result1 = $db_handle->runQuery($query1);
	  $fetched_data = $db_handle->fetchAssoc($result1);
	  $daytotalsales = $fetched_data[0]['grand_total'];
	  
	  $result2 = $db_handle->runQuery($query2);
	  $fetched_data = $db_handle->fetchAssoc($result2);
	  $daytotalpay = $fetched_data[0]['totamount'];
	  
	  if ($daytotalsales > $daytotalpay){
			$dispmessage = "Total Sales amount greater than Total payment from this Salespoint. Kindly check";
	  }elseif($daytotalsales < $daytotalpay){
			$dispmessage = "Total Sales amount less than Total payment from this Salespoint. Kindly check";
	  }else{
		  	$dispmessage = "Total Sales amount is equal to Total payment from this Salespoint.";
	  }
	  
	  ?>
	   <input type="hidden" name="daytotalsales" value="<?=$daytotalsales;?>">
	   <input type="hidden" name="daytotalpay" value="<?=$daytotalpay;?>">
	   <input type="hidden" name="daydate" value="<?=$start;?>">
	  
<?php  $if_cleared = $client_operation->check_cleared_daily_trans($start,$q);

}elseif ($q <> "" and $start<>""  and $end<>""){
	 $query = "SELECT * FROM sma_payments WHERE salespoint_id = '$q' AND date BETWEEN '$start' and '$end' order by date desc";
	 $query1 = "SELECT SUM(grand_total) as grand_total FROM sma_sales WHERE salespoint_id = '$q' AND date BETWEEN '$start' and '$end' order by date desc";
	// $query2 = "SELECT SUM(amount) AS totamount FROM sma_payments WHERE salespoint_id = '$q' AND date BETWEEN '$start' and '$end'";
	 $topdisp = "Report for Salespoint $q between ". date('D d F, Y', strtotime($start)) ." and ". date('D W F, Y', strtotime($end));
}
$result = $db_handle->runQuery($query);
$details = $db_handle->fetchAssoc($result);

$result1 = $db_handle->runQuery($query1);
$fetched_data = $db_handle->fetchAssoc($result1);
$grand_total = $fetched_data[0]['grand_total'];

$result2 = $db_handle->runQuery($query2);
$fetched_data = $db_handle->fetchAssoc($result2);
$totamount = $fetched_data[0]['totamount'];

/*if (isset($_POST['marksolved'])){
	$start = $_POST['start'];
	$salespoint = $_POST['qsalesp'];
	$daytotalsales = $_POST['daytotalsales'];
	$daytotalpay = $_POST['daytotalpay'];
	
	//$client_operation->mark_as_cleared_daily_trans($date,$salespoint,$daytotalsales,$daytotalpay);
	//$this->session->set_flashdata('message', lang("Day transaction marked as completed"));
	$this->db->insert('cleareddaytransactions', $data);
		$this->session->set_flashdata('flash_message', "Day transaction marked as completed");
		redirect('reports/paymentdetailsbysalespoint');
}*/

//print_r($details);
echo '<span style="color:#22f;font-size:18px;"><b>'.$topdisp.'</b></span>';

if ($daytotalpay<>"" && $daytotalsales<>""){
echo "<p><button class='btn btn-warning'>$dispmessage</button></p>";
}
if ( $if_cleared == '4'){
	echo "<p><button class='btn btn-success'>Check for variance</button> &emsp; <input name='marksolved' class='btn btn-danger' type='submit' value='Mark as Solved'>";
	echo "<p><a href='reports/unclearedbalances/$q/$start' class='btn btn-danger'>View UnBalanced/Uncleared Transactions</a>";
}elseif( $if_cleared == '5'){
	echo "<p><button class='btn btn-success disabled'>Check variance</button> &emsp; <input name='marksolved' class='btn btn-danger disabled' type='submit' value='Marked as Solved'>";
}
?>
<input type="hidden" name="qsalesp" value="<?php echo $q;?>">
<table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                          <th> ID </th>
                                          <th>Trans Date </th>
                                          <th>Reference No </th>
                                          <th>Payment Type </th>
                                          <th>Amount(₦) </th>
                                          <th>Note </th>
                                          <th width="10%">View Details</th>
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
                                            <td><?php echo ucfirst($details[$i]['paid_by']); ?></td>
                                            <td><?php echo number_format($details[$i]['amount'],2); ?></td>
                                            <td><?php echo $details[$i]['note']; ?></td>
                                             <?php if ($details[$i]['type'] == 'received'){ ?>
                                            <td width="5%"><a href="sales/view/<?php echo $details[$i]['sale_id'];?>"   class="btn btn-success">View</a> </td>
                                            <?php }elseif($details[$i]['type'] == 'sent'){ ?>
                                            <td width="5%"><a href="purchases/view/<?php echo $details[$i]['purchase_id'];?>"   class="btn btn-warning">View</a> </td>
                                            <?php } ?>
                                        </tr>
                                        <?php $totsold += $details[$i]['amount'];
										} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                                    </tbody>
                                </table>
                                <b>Total Amount Paid: ₦<?= number_format($totsold,2);?></b><br>
                                <b>Total Amount Sold: ₦<?= number_format($grand_total,2);?></b>                                
                                
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example2').DataTable();
} );
</script>