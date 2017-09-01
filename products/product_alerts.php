<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$product_alerts = $zentabooks_operation->product_alerts();
//print_r($product_alerts);
?>
    <link href="<?php echo SITE_ASSETS.'/styles/theme.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-2.0.3.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-migrate-1.2.1.min.js';?>"></script>

<div class="table-responsive">
<?php $message_error = "The following are below the alert quantity, kindly re-stock.";
require_once '../layouts/feedback_message.php';
?>
                    <table id="hidden-table-info" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th>
                                <input class="checkbox multi-select" type="checkbox" name="check"/>
                            </th>
                            <th>Image</th>
                            <!--<th>Code</th>-->
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>                            
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Alert Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php if(isset($product_alerts) && !empty($product_alerts)) { foreach ($product_alerts as $row) { ?>
                            <tr>
                                <td><input class="checkbox multi-select" type="checkbox" name="check"/></td>
                                <td><img src="<?php echo SITE_URL.'/uploads/products/images/no_image.png'; ?>" height="40" width="40" alt=""/></td>
                              <!--<td><?php echo $row['code']; ?></td>-->
                                <td><?php echo $row['name']; ?> (<?php echo $row['colour_name']; ?>)</td>
                                <td><?php echo $row['brand_name']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo number_format($row['price'],2); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['alert_quantity']; ?></td>
                            </tr>
                            <?php } } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                        </tbody>
                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th style="min-width:40px; width: 40px; text-align: center;">Image</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="width:65px; text-align:center;">Actions</th>
                        </tr>
                        </tfoot>                        
                    </table>
                    
							                  
                </div>

