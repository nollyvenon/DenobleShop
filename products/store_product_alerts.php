<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$product_alerts = $zentabooks_operation->store_product_alerts();
?>
<div class="table-responsive">
<?php 
if (!empty($product_alerts) and $product_alerts != NULL and contains('59',$allowed_pages)){
$message_error = "The following are below the alert quantity, kindly re-stock.";
require_once '../layouts/feedback_message.php';
?>
                    <table id="hidden-table-info" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <!--<th>Code</th>-->
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>                            
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Alert Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php if(isset($product_alerts) && !empty($product_alerts)) { foreach ($product_alerts as $row) { ?>
                            <tr>
                                <td><img src="<?php echo SITE_URL.'/uploads/products/images/no_image.png'; ?>" height="40" width="40" alt=""/></td>
                              <!--<td><?php echo $row['code']; ?></td>-->
                                <td><?php echo $row['name']; ?> (<?php echo $zentabooks_operation->get_colour_info($row['colour_id'])['name']; ?>)</td>
                                <td><?php echo $zentabooks_operation->brand_detail($row['brand'])['name']; ?></td>
                                <td><?php echo $zentabooks_operation->get_a_product_category($row['category_id']); ?></td>
                                <td><?php echo number_format($row['price'],2); ?></td>
                                <td><?php echo $row['stock_after_trans']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['store_alert_quantity']; ?></td>
                            </tr>
                            <?php } } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:40px; width: 40px; text-align: center;">Image</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>                        
                    </table>
                    
						<?php } ?>	                  
                </div>

