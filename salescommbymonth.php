<?php

include_once('../includes/initialize_admin.php');
$dispmessage = '';
if ($_GET["r"] != ""){
$myDateTime = DateTime::createFromFormat('m', $_GET["r"]);
 $month = $myDateTime->format('m');
}
if ($_GET["s"] != ""){
$myDateTime1 = DateTime::createFromFormat('Y', $_GET["s"]);
 $year = $myDateTime1->format('Y');
}

 // echo date('d, M Y',strtotime($s));
if ($month<>""  and $year<>""){
	$query = "SELECT sma_sales_comm.employee_id as employee_id, sma_companies.name as employee_name, sma_sales_comm.id as id, sma_sales_comm.salespoint as salespoint, sma_sales_comm.amount as amount, sma_sales_comm.transid as transid, sma_sales_comm.transtype as transtype, sma_sales_comm.month as month, sma_sales_comm.year as year
			FROM sma_sales_comm 
			LEFT JOIN sma_companies ON sma_companies.id=sma_sales_comm.employee_id 
			WHERE sma_sales_comm.transid !='NULL' AND sma_sales_comm.employee_id !='NULL' AND sma_sales_comm.month= '$month' AND sma_sales_comm.year= '$year'
			GROUP BY sma_sales_comm.employee_id";
	 $topdisp = "Sales Commission for ". date('F, Y', strtotime($year.'-'.$month));
}
$result = $db_handle->runQuery($query);
$details = $db_handle->fetchAssoc($result);

//print_r($details);
echo '<div class="col-sm-12"><p><span style="color:#22f;font-size:18px;"><b>'.$topdisp.'</b></span></p></div>';

?>
<table id="example2" class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                <th> ID </th>
                                <th>Salespoint </th>
                                <th>Employee</th>
                                <th>Trans/Sales ID</th>
                                <th>Amount(₦) </th>
                                <th>Period </th>
                                <th>Details </th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($details) && !empty($details)) {  
                                            for($i = 0; $i < count($details); $i++) { 
                                        ?> 
                                        <tr align="center">
                                            <td><?php echo $details[$i]['id']; ?></td>
                                            <td><?php echo $details[$i]['salespoint']; ?></td>
                                            <td><?php echo $details[$i]['employee_name']; ?></td>
                                            <td><?php echo "<a target='_blank' href=sales/view/".$details[$i]['transid'].">".ucfirst($details[$i]['transid'])."</a>"; ?></td>
                                            <td><?php echo number_format($details[$i]['amount'],2); ?></td>
                                            <td><?php echo date('M Y',strtotime($details[$i]['year'].'-'.$details[$i]['month'])); ?></td>
                                            <td width="5%"><?php if ($details[$i]['transtype'] == 'credit'){ 
												echo $details[$i]['status'];
													}?></td>
                                        </tr>
                                        <?php $totamt += $details[$i]['amount'];
										} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                                    </tbody>
                                </table>
                                <b>Total Amount: ₦<?= number_format($totamt,2);?></b><br>

                           
<script type="text/javascript" src="jquery.dataTables.min.js"></script>
<script type="text/javascript" src="dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#example2').DataTable();
} );
</script>
