<table id="bcTable"
                               class="table items table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="col-xs-7">Product Name (Product Code)</th>
                                <th class="col-xs-2">Colour</th>
                                <th class="col-xs-2 text-center">Quantity</th>
                                <th class="text-center" style="width:30px;">
                                    <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
							<?php

include_once('initialize_admin.php');
$product_id=addslashes($_GET["q"]);
$details = $zentabooks_operation->product_list_for_barcode($product_id);

//print_r($details);

?>

                                        <?php if(isset($details) && !empty($details)) {  
                                            for($i = 0; $i < count($details); $i++) { 
                                        ?> 
                                        <tr align="center">
                                            <td><?php echo $details[$i]['name'].'('.$details[$i]['code'].')'; ?></td>
                                            <td><?php echo $details[$i]['colour_name']; ?></td>
                                            <td><input name="qty[]"  class=" col-md-2 form-control text-center" type="text" size="35" /></td>
                                            <input value="<?php echo $details[$i]['id'];?>" name="product_id[]" type="hidden">
                                            <input value="<?php echo $details[$i]['name'];?>" name="product_name_col[]" type="hidden">
                                            <input value="<?php echo $details[$i]['price'];?>" name="product_price[]" type="hidden">
                                            <input value="<?php echo $details[$i]['code'];?>" name="product_code[]" type="hidden">
                                        </tr>
                                        <?php } } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
</tbody>
</table>										