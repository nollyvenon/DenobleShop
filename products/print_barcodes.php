<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
require '../vendor/autoload.php';
$settings = $zentabooks_operation->get_settings();
$site_name = $settings['site_name'];
$allproducts = $zentabooks_operation->product_list_for_barcode();
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode/Label - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS.'/images/icon.png';?>"/>
    <link href="<?php echo SITE_ASSETS.'/styles/theme.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/css/jquery.dataTables.min.css';?>" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-2.0.3.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-migrate-1.2.1.min.js';?>"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_ASSETS;?>/js/jquery.js"></script>
    <![endif]-->
    <noscript><style type="text/css">#loading { display: none; }</style></noscript>
        <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
		
   function showTerri(str)
	{
	  if (str=="")
		{
		document.getElementById("txtHint1").innerHTML="";
		return;
		}
	  
	  if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
	  else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	  xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		  {
		  document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
		  }
		}
	  xmlhttp.open("GET","<?php echo SITE_URL;?>/includes/barcode_print.php?q="+str,true);
	  xmlhttp.send();
	}
    </script>
</head>

<body>
<noscript>
    <div class="global-site-notice noscript">
        <div class="notice-inner">
            <p><strong>JavaScript seems to be disabled in your browser.</strong><br>You must have JavaScript enabled in
                your browser to utilize the functionality of this website.</p>
        </div>
    </div>
</noscript>
<div id="loading"></div>
<div id="app_wrapper">
            <?php include '../includsin/header.php';?>


    <div class="container" id="container">
        <div class="row" id="main-con">
        <table class="lt"><tr><td class="sidebar-con">
            <?php include '../includsin/sidebar.php';?>
            </td><td class="content-con">
            <div id="content">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active">Print Barcode/Label</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<div class="box">
    <div class="box-header no-print">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Print Barcode/Label</h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a href="#" onclick="window.print();return false;" id="print-icon" class="tip" title="Print">
                        <i class="icon fa fa-print"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">You can visit <a href="<?php echo SITE_URL;?>/system_settings/categories">Categories</a>, <a href="<?php echo SITE_URL;?>/system_settings/subcategories">Sub Categories</a>, <a href="<?php echo SITE_URL;?>/purchases">Purchases</a> and <a href="<?php echo SITE_URL;?>/transfers">Transfers</a> to add products to this printing list.</p>

                <div class="well well-sm no-print">
                    <div class="form-group">
                        <label for="add_item">Add Product</label>                        
                        <!--<input type="text" name="add_item" value=""  class="form-control" id="add_item" placeholder="Add Item" />-->
                        <input type="text" name="add_item" id="add_item" list="pname"  onfocus="showTerri(this.value,'','');" onchange="showTerri(this.value,'','');" placeholder="Add Item" class=" col-md-12 form-control flexdatalist">
                  			<datalist id="pname"><option>Select A Product</option>
                           <?php  foreach ($allproducts as $row) {   ?>
                                    <option  value="<?=$row['name'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
            </datalist>
                    </div>
                    <form action="" id="barcode-print-form" data-toggle="validator" method="post" accept-charset="utf-8">
                                              <input type="hidden" name="token" value="d6bcbbcd69eb572072063744c9bb3bc3" />
                    <div class="controls table-controls">
                        <table id="txtHint1"
                               class="table items table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="col-xs-4">Product Name (Product Code)</th>
                                <th class="col-xs-1">Colour</th>
                                <th class="col-xs-7">Quantity</th>
                                <th class="text-center" style="width:30px;">
                                    <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                           </tbody>
                        </table>
                    </div>

                        <div class="form-group">
                            <label for="style">Style</label>                                                        
                            <select name="style" class="form-control tip" id="style" required>
<option value="">Select Style</option>
<option value="40">40 per sheet (a4) (1.799" x 1.003")</option>
<option value="30">30 per sheet (2.625" x 1")</option>
<option value="24" selected="selected">24 per sheet (a4) (2.48" x 1.334")</option>
<option value="20">20 per sheet (4" x 1")</option>
<option value="18">18 per sheet (a4) (2.5" x 1.835")</option>
<option value="14">14 per sheet (4" x 1.33")</option>
<option value="12">12 per sheet (a4) (2.5" x 2.834")</option>
<option value="10">10 per sheet (4" x 2")</option>
<option value="50">Continuous feed</option>
</select>
                            <div class="row cf-con" style="margin-top: 10px; display: none;">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="cf_width" value=""  class="form-control" id="cf_width" placeholder="Width" />
                                            <span class="input-group-addon" style="padding-left:10px;padding-right:10px;">Inches</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="cf_height" value=""  class="form-control" id="cf_height" placeholder="Height" />
                                            <span class="input-group-addon" style="padding-left:10px;padding-right:10px;">Inches</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                                                            <select name="cf_orientation" class="form-control" id="cf_orientation" placeholder="Orientation">
<option value="0">Portrait</option>
<option value="1">Landscape</option>
</select>
                                    </div>
                                </div>
                            </div>
                            <span class="help-block">Please don't forget to set correct page size and margin for your printer. You can set right and bottom to 0 while left and top margin can be adjusted according to your need.</span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="form-group">
                            <span style="font-weight: bold; margin-right: 15px;">Print:</span>
                            <input name="site_name" type="checkbox" id="site_name" value="0" style="display:inline-block;" />
                            <label for="site_name" class="padding05">Site Name</label>
                            <input name="product_name" type="checkbox" id="product_name"  checked="checked" value="1" style="display:inline-block;" />
                            <label for="product_name" class="padding05">Product Name</label>
                            <input name="price" type="checkbox" id="price" value="1" checked="checked" style="display:inline-block;" />
                            <label for="price" class="padding05">Price</label>
                            <input name="currencies" type="checkbox" id="currencies" value="1" checked="checked" style="display:inline-block;" />
                            <label for="currencies" class="padding05">Currencies</label>
                            <input name="unit" type="checkbox" id="unit" value="0" style="display:inline-block;" />
                            <label for="unit" class="padding05">Unit</label>
                            <input name="category" type="checkbox" id="category" value="0" style="display:inline-block;" />
                            <label for="category" class="padding05">Category</label>
                          <!--  <input name="variants" type="checkbox" id="variants" value="0" style="display:inline-block;" />
                            <label for="variants" class="padding05">Variants</label>-->
                            <input name="product_image" type="checkbox" id="product_image" value="0" style="display:inline-block;" />
                            <label for="product_image" class="padding05">Product Image</label>
                            <!--<input name="check_promo" type="checkbox" id="check_promo" value="0" style="display:inline-block;" />
                            <label for="check_promo" class="padding05">Check promotional price</label>-->
                        </div>

                    <div class="form-group">
                        <input type="submit" name="print" value="Update"  class="btn btn-primary" />
                        <button type="button" id="reset" class="btn btn-danger">Reset</button>
                    </div>
                    </form>                    <div class="clearfix"></div>
                </div>
                <div id="barcode-con">
                    <button type="button" onclick="window.print();return false;" class="btn btn-primary btn-block tip no-print" title="Print"><i class="icon fa fa-print"></i> Print</button>
                    <div class="barcodea4">
						<?php 
                        if ($_POST['print']){
							$qty = $_POST['qty'];
							$product_id = $_POST['product_id'];
							$product_name_col = $_POST['product_name_col'];
							$product_price = $_POST['product_price'];
							$product_code = $_POST['product_code'];
							$product_name = isset($_POST['product_name']) && $_POST['product_name']  ? "1" : "0";
							$site_name = isset($_POST['site_name']) && $_POST['site_name']  ? "1" : "0";
							$category = isset($_POST['category']) && $_POST['category']  ? "1" : "0";
							$product_image = isset($_POST['product_image']) && $_POST['product_image']  ? "1" : "0";
							$product_code = isset($_POST['product_code']);
							$unit = isset($_POST['unit']) && $_POST['unit']  ? "1" : "0";
							$currencies = isset($_POST['currencies']) && $_POST['currencies']  ? "1" : "0";
							$price = isset($_POST['price']) && $_POST['price']  ? "1" : "0";
							$check_promo = isset($_POST['check_promo']) && $_POST['check_promo']  ? "1" : "0";
						foreach($product_id as $a => $b){
							for ($x = 1; $x <= $qty[$a]; $x++) {
								$product_id[$a];
								$data = $zentabooks_operation->output_current_datalist_to_barcode($product_id[$a], $qty[$a]);
							echo	$product_code = $product_code[$a];
								//print_r($data);
        
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        $barcode_image = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode('$product_code', $generator::TYPE_CODE_128)) . '" alt="$product_code" class="bcimg" >';
                        ?>
    
                        <div class="item style24" ><?php if ($site_name =='1'){ ?><span class="barcode_site"><?=$site_name;?></span><?php } ?>
                           <?php if ($product_name =='1'){ ?><span class="barcode_name"><?=$product_name_col[$a];?></span><?php } ?>
                           <?php if ($price =='1'){ ?><span class="barcode_price">Price  ₦<?=number_format($product_price[$a],2);?></span> <?php } ?>
                           <span class="barcode_image"><?=$barcode_image;?><br><?=$product_code;?></span>
                        	<!--<span class="barcode_name">ScanDisk Memory Card 32GB</span><span class="barcode_price">Price  ₦2,000.00</span> <span class="barcode_image"><img src='<?php echo SITE_URL;?>/products/gen_barcode/234300/code128/20' alt='234300' class='bcimg' /></span>-->
                        </div>
                    	<?php  }
							} 
							
						}?>
                    </div>
                    
                    <button type="button" onclick="window.print();return false;" class="btn btn-primary btn-block tip no-print" title="Print"><i class="icon fa fa-print"></i> Print</button>                </div>
            </div>
        </div>
    </div>

<div class="clearfix"></div></div>
</div></div></div></td></tr></table></div></div><div class="clearfix"></div>
<footer>
<a href="#" id="toTop" class="blue" style="position: fixed; bottom: 30px; right: 30px; font-size: 30px; display: none;">
    <i class="fa fa-chevron-circle-up"></i>
</a>

    <p style="text-align:center;">&copy; 2017 DeNobelAS 
      - Page rendered in <strong>5.1793</strong> seconds</p>
</footer>
</div><div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true"></div>
<div id="modal-loading" style="display: none;">
    <div class="blackbg"></div>
    <div class="loader"></div>
</div>
<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
<script type="text/javascript">
var dt_lang = {"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}, dp_lang = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]}, site = {"base_url":"http:\/\/localhost\/stockfeb2017\/","settings":{"logo":"logo41.png","logo2":"logo42.png","site_name":"ZentaBooks","language":"english","default_salespoint":"1","default_store":"1","default_warehouse":"1","accounting_method":"0","default_currency":"NGN","default_tax_rate":"1","rows_per_page":"10","version":"3.0.2.23","default_tax_rate2":"1","dateformat":"5","sales_prefix":"SALE","quote_prefix":"QUOTE","purchase_prefix":"PO","transfer_prefix":"TR","delivery_prefix":"DO","payment_prefix":"IPAY","return_prefix":"SR","returnp_prefix":"PR","expense_prefix":"","item_addition":"1","theme":"default","product_serial":"1","default_discount":"1","product_discount":"1","discount_method":"1","tax1":"1","tax2":"1","overselling":"0","salescommission":"0.10","loyaltycardval":"0.00100","iwidth":"800","iheight":"800","twidth":"60","theight":"60","watermark":"1","smtp_host":"pop.gmail.com","bc_fix":"4","auto_detect_barcode":"1","captcha":"0","reference_format":"2","racks":"1","attributes":"1","product_expiry":"1","decimals":"2","qty_decimals":"2","decimals_sep":".","thousands_sep":",","invoice_view":"0","default_biller":"3","rtl":"0","each_spent":null,"ca_point":null,"each_sale":null,"sa_point":null,"sac":"0","display_all_products":"1","display_symbol":"1","symbol":" \u20a6","remove_expired":"0","barcode_separator":"_","set_focus":"0","price_group":"1","barcode_img":"1","ppayment_prefix":"POP","disable_editing":"90","qa_prefix":"","update_cost":"1","user_language":"english","user_rtl":"0"},"dateFormats":{"js_sdate":"dd\/mm\/yyyy","php_sdate":"d\/m\/Y","mysq_sdate":"%d\/%m\/%Y","js_ldate":"dd\/mm\/yyyy hh:ii","php_ldate":"d\/m\/Y H:i","mysql_ldate":"%d\/%m\/%Y %H:%i"}};
var lang = {paid: 'Paid', pending: 'Pending', completed: 'Completed', ordered: 'Ordered', received: 'Received', partial: 'Partial', sent: 'Sent', r_u_sure: 'Are you sure?', due: 'Due', returned: 'Returned', transferring: 'Transferring', active: 'Active', inactive: 'Inactive', unexpected_value: 'Unexpected value provided!', select_above: 'Please select above first', download: 'Download'};
</script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery.dataTables1.10.15.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery.dataTables.dtFilter.min.js"></script>
<?php if (contains( '200',$allowed_pages)) { ?>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jszip.min.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/custom.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery.calculator.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/core.js"></script>
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/perfect-scrollbar.min.js"></script>
</body>
</html>
