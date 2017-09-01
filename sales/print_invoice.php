<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
$hiss = decrypt(str_replace(" ", "+", $id_encrypted));
$sal_details = $zentabooks_operation->view_sales_info_by_id($hiss);
extract($sal_details);
?>	
<html>
	<head>
    	<title>Sale invoice</title>
        <link rel="stylesheet" type="text/css" media="all" href="reports.css" />
    	<style type="text/css">
        	.pos_report_container { 
				width:300px;
				margin:auto;	
			}
			h3 { 
				text-align:center;
				font-size:15px;	
			}
			p.phone, .invoicetable { 
				  font-family: Arial, Helvetica, sans-serif;
  				  font-size: 12px;	
				  text-align:center;
			}
			.invoicetable {margin-top:15px;}
			.lefttd {text-align:left;width:140px;} 
			.righttd {text-align:right;width:140px;}
			table { font-size:12px;}
			table .header th {border-bottom:1px solid #000;}
			table .header th, table td {padding:3.5px;}
			.item_detail .total, .item_detail .tax, .item_detail .qty, .item_detail .price {text-align:right;}
        </style>
    </head>
    
    <body>
    
    	<div class="pos_report_container">
        	<?php 
				$store_logo = $mysettings['logo2'];
				if($store_logo != '') {
					echo "<center><img src='../uploads/logos/".$store_logo."' width='180px' /></center>";	
				} ?>
			<!--	<h3><?php //echo $zentabooks_operation->get_company_user_details($_SESSION['biller_id'])[0]['company']; ?></h3>-->
            <?php $biller_det = $zentabooks_operation->get_company_user_details($biller_id)[0];
							//echo $biller_det['company'];?>
				<p class="phone"><?php echo $biller_det['address']; ?>, 
				<?php echo $biller_det['city']; ?>, <?php echo $biller_det['state']; ?>, <?php echo $biller_det['country']; ?> <br>
                Call: <?php echo $biller_det['phone']; ?><br> Email: <?php echo $biller_det['email']; ?></p>
        <?php $mysqldate = strtotime($sal_details['date']); ?>
        <?php //$agent_id = $sale->get_sale_info($_GET['sale_id'], 'agent_id'); ?>
        <?php $cust_det = $zentabooks_operation->get_company_user_details($sal_details['customer_id'])[0]; ?>
        	  <table class="invoicetable">
              		<tr>
                    	<td class="lefttd">Date: <?php echo date('d M, Y', $mysqldate); ?></td>
                        <td class="righttd">S.INV # : <?php echo $sal_details['reference_no']; ?></td>
                    </tr>
                    
                    <tr>
                    	<td class="lefttd"><!--Agent: <?php //echo $user->get_user_info($agent_id, 'first_name').' '.$user->get_user_info($agent_id, 'last_name'); ?>--></td>
                        <td class="righttd">Payment: <?php echo ucfirst($payment_status); ?></td>
                    </tr>
                    <tr>
                    	<td class="lefttd">Customer: <?php echo $cust_det['name']; ?></td>
                        <td class="righttd">Balance: ₦<?php echo formatMoney($sal_details['grand_total'] - $sal_details['paid'],2);?></td>
                    </tr>
              </table>
              <!--work here.-->
              	<table class="item_detail" width="100%" align="center" cellpadding="0" cellspacing="0">
                	<tr class="header">
                    	<th style="width:10px !important;">#</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Tax</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
               <?php $query = "SELECT * FROM sma_sale_items WHERE sale_id ='$hiss'";  
						$result = $db_handle->runQuery($query);
						  $sales_view = $db_handle->fetchAssoc($result);
						  $i = 1;
						  if(isset($sales_view) && !empty($sales_view)) { foreach ($sales_view as $row) { 
						  ?>
                  <tr>
                                <td style="text-align:center; width:40px; vertical-align:middle;"><?php echo $i; ?></td>
                                <td style="vertical-align:middle;"> <?php echo $row['product_code'].' - '. $row['product_name']; ?></td>
                                <td style="width: 100px; text-align:center; vertical-align:middle;"><?php echo $row['quantity'].' '.$row['product_unit_code']; ?></td>
                                <td></td>                                
                                <td style="text-align:right; width:120px; padding-right:10px;">  ₦<?php echo formatMoney($row['net_unit_price'],2); ?></td>
                                                                <td style="text-align:right; width:120px; padding-right:10px;">  ₦<?php echo formatMoney($row['net_unit_price']*$row['quantity'],2); ?></td>
                            </tr>
                            <?php 
							$i++;
							} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                </table>
              <!--work here.-->
    
<table width="95%" align="right" cellspacing="0" style="margin-top:5px; text-align:right;margin-bottom:5px;" cellpadding="5" border="0px">
        		<tr>
                	<td><strong>Total:</strong> ₦<?php echo formatMoney($sal_details['grand_total'],2); ?></td></tr>
                    <tr>
                    <td><strong>Received:</strong> ₦<?php echo formatMoney($sal_details['paid'],2);?> </td></tr>
                    <tr><td><strong>Balance:</strong> ₦<?php echo formatMoney($sal_details['grand_total'] - $sal_details['paid'],2);?></td>
                </tr>
                </table>

      <p style="text-align:center;font-size:12px; margin-top:20px;">This is computer generated Invoice does not need Signature.</p>      
        </div><!--reportContainer Ends here.-->
    </body>
</html>