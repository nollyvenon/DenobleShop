<?php

require_once("../includes/initialize_admin.php");
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
	$query = "SELECT sma_loyalty_card.card_id as card_id, sma_loyalty_card.customer_id as customer_id, sma_sales.*, SUM(COALESCE(sma_sales.grand_total)) AS amount, SUM(COALESCE(sma_loyalty_card.points)) AS points, sma_loyalty_card.trans_id AS trans_id, sma_loyalty_card.status AS status, sma_loyalty_card.date AS date
			FROM sma_loyalty_card LEFT JOIN sma_sales ON sma_sales.id=sma_loyalty_card.trans_id
			LEFT JOIN sma_companies ON sma_companies.id=sma_loyalty_card.customer_id
			WHERE sma_loyalty_card.customer_id = '$q' AND sma_loyalty_card.trans_id != 'NULL' AND sma_loyalty_card.customer_id !='NULL' AND sma_loyalty_card.status ='1'
			GROUP BY sma_loyalty_card.customer_id";
	  $result = $db_handle->runQuery($query);
	  $details = $db_handle->fetchAssoc($result);
	  $fullname = $details[0]['customer'];	 
	 $topdisp = "Loyalty Card Points for Customer $fullname";
}elseif ($q <> "" and $start<>""  and $end==""){
	$query = "SELECT sma_loyalty_card.card_id as card_id, sma_loyalty_card.customer_id as customer_id, sma_sales.*, SUM(COALESCE(sma_sales.grand_total)) AS amount, SUM(sma_loyalty_card.points) AS points, sma_loyalty_card.trans_id AS trans_id, sma_loyalty_card.status AS status, sma_loyalty_card.date AS date
			FROM sma_loyalty_card LEFT JOIN sma_sales ON sma_sales.id=sma_loyalty_card.trans_id 
			LEFT JOIN sma_companies ON sma_companies.id=sma_loyalty_card.customer_id 
			WHERE sma_loyalty_card.customer_id = '$q' AND sma_loyalty_card.trans_id !='NULL' AND sma_loyalty_card.customer_id !='NULL' AND sma_loyalty_card.status ='1' AND DATE(sma_loyalty_card.date)='$start'
			GROUP BY sma_loyalty_card.customer_id";
	  $result = $db_handle->runQuery($query);
	  $details = $db_handle->fetchAssoc($result);
	  $fullname = $details[0]['customer'];	 
 	  $topdisp = "Loyalty Card Points for Customer $fullname on the ". date('D d F, Y', strtotime($start));

}elseif ($q <> "" and $start<>""  and $end<>""){
	$query = "SELECT sma_loyalty_card.card_id as card_id, sma_loyalty_card.customer_id as customer_id, sma_sales.*, SUM(COALESCE(sma_sales.grand_total)) AS amount, SUM(sma_loyalty_card.points) AS points, sma_loyalty_card.trans_id AS trans_id, sma_loyalty_card.status AS status
			FROM sma_loyalty_card LEFT JOIN sma_sales ON sma_sales.id=sma_loyalty_card.trans_id
			LEFT JOIN sma_companies ON sma_companies.id=sma_loyalty_card.customer_id
			WHERE sma_loyalty_card.customer_id = '$q' AND sma_loyalty_card.trans_id !='NULL' AND sma_sales.customer_id !='NULL' AND sma_loyalty_card.status ='1' AND sma_loyalty_card.date BETWEEN '$start' and '$end'
			GROUP BY sma_loyalty_card.customer_id";
	  $result = $db_handle->runQuery($query);
	  $details = $db_handle->fetchAssoc($result);
	  $fullname = $details[0]['customer'];	 
	 $topdisp = "Loyalty Card Points for Customer $fullname between ". date('D d F, Y', strtotime($start)) ." and ". date('D W F, Y', strtotime($end));
}
$result = $db_handle->runQuery($query);
$details = $db_handle->fetchAssoc($result);

//print_r($details);
echo '<span style="color:#22f;font-size:18px;"><b>'.$topdisp.'</b></span>';

?>
<input type="hidden" name="qsalesp" value="<?php echo $q;?>">
<table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th> ID </th>
                                            <th>Trans Date </th>
                                            <th>Customer</th>
                                            <th>Trans/Sales ID</th>
                                            <th>Amount(₦) </th>
                                            <th>Points </th>
                                            <th>Status </th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($details) && !empty($details)) {  
                                            for($i = 0; $i < count($details); $i++) { 
                                        ?> 
                                        <tr align="center">
                                            <td><?php echo $details[$i]['card_id']; ?></td>
                                            <td><?php echo date('d, M Y',strtotime($details[$i]['date'])); ?></td>
                                            <td><?php echo $details[$i]['customer']; ?></td>
                                            <td><?php echo "<a target='_blank' href=sales/view/".$details[$i]['trans_id'].">".ucfirst($details[$i]['trans_id'])."</a>"; ?></td>
                                            <td><?php echo number_format($details[$i]['amount'],2); ?></td>
                                            <td><?php echo number_format($details[$i]['points'],2); ?></td>
                                            <td width="5%"><?php echo $details[$i]['status'];?></td>
                                        </tr>
                                        <?php $totamt += $details[$i]['amount'];
											$totpoints += $details[$i]['points'];
										} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                                    </tbody>
                                </table>
                                <b>Total Amount: ₦<?= number_format($totamt,2);?></b><br>
                            	<b>Total Points: <?= number_format($totpoints,2);?>points</b>                               

<script type="text/javascript" src="../themes/default/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../themes/default/assets/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>