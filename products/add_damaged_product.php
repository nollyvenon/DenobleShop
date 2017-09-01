<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    //redirect_to("../log-in");
}
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$allbrands = $zentabooks_operation->get_all_brands();
$allcategories = $zentabooks_operation->get_all_categories();
$allsuppliers = $zentabooks_operation->suppliers_list();
$allcolours = $zentabooks_operation->get_all_colours();
$allunits = $zentabooks_operation->get_all_units();
$alltax = $zentabooks_operation->get_all_tax_rates();

if (isset($_POST['add_damaged_product']) ) {
    foreach($_POST as $key => $value) {
        $_POST[$key] = $db_handle->sanitizePost(trim($value));
    }
    extract($_POST);

	   $product_image  = time().$_FILES['product_image']['name'];
	
		$uploaddir = "../uploads/damaged_products/images/";
		if (!is_dir('../uploads/damaged_products/images/')) {
			mkdir('../uploads/damaged_products/images/', 0777, TRUE);
		}
	
		$product_image1 = $uploaddir.$product_image;
		$tmp_file = $_FILES['document']['tmp_name'];
		//print_r($product);
		move_uploaded_file($tmp_file, $product_image1); 		
    
	if ($name != "" || $code != "" || $category != "" || $price != "" ){
        $upd_emp = $zentabooks_operation->add_damaged_product($type, $name, $code, $quantity, $colour, $barcode_symbology, $brand, $category, $subcategory, $unit, $cost, $price, $product_image, $product_details, $warehouse);
        if($upd_emp) {
            $message_success = "You have successfully added the damaged product";
        } else {
            $message_error = "Something went wrong. Please try again.";
        }
	}else{
		$message_error = "Either of the compulsory details is empty";
	}
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Damaged Product - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS.'/images/icon.png';?>"/>
    <link href="<?php echo SITE_ASSETS.'/styles/theme.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
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

function showSubCat(str)
{
	if (str=="") {
	  document.getElementById("txtHint1").innerHTML="";
	  return;
	}
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
		}
	  }
	//xmlhttp.open("GET","http://localhost/optisys/getitemprice.php?q="+str,true);
	xmlhttp.open("GET","<?php echo SITE_URL;?>/includes/getCategory.php?qr="+str,true);
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active">Add Damaged Product</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<script type="text/javascript">

</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Add Damaged Product</h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext">Please fill in the information below. The field labels marked with * are required input fields.</p>
                                <?php require_once '../layouts/feedback_message.php'; ?>

                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="token" value="d6bcbbcd69eb572072063744c9bb3bc3" />                                                      

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="type">Product Type</label>                        <select name="type" class="form-control" id="type" required>
<option value="standard">Standard</option>
<option value="combo">Combo</option>
<option value="digital">Digital</option>
<option value="service">Service</option>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="name">Product Name</label>                        
                        <input type="text" name="name" value=""  class="form-control" id="name" required="required" />
                    </div>
                    <div class="form-group all">
                        <label for="brand">Colour</label>                        
                        <select name="colour" class="form-control select" id="brand" placeholder="Select Colour" style="width:100%">
                            <option value="" selected="selected"></option>
                            <?php  foreach ($allcolours as $row) {   ?>
                            <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                            <?php } ?>
						</select>
                    </div>
                    <div class="form-group all">
                        <label for="code">Product Code</label>                        <div class="input-group">
                            <input type="text" name="code" value=""  class="form-control" id="code"  required="required" />
                            
                        </div>
                        <span class="help-block">You can scan your barcode  and select the correct symbology below</span>
                    </div>
                    <div class="form-group all">
                        <label for="barcode_symbology">Barcode Symbology</label>                        
                        <select name="barcode_symbology" class="form-control select" id="barcode_symbology" required style="width:100%;">
<option value="code25">Code25</option>
<option value="code39">Code39</option>
<option value="code128" selected="selected">Code128</option>
<option value="ean8">EAN8</option>
<option value="ean13">EAN13</option>
<option value="upca">UPC-A</option>
<option value="upce">UPC-E</option>
</select>

                    </div>
                    <div class="form-group all">
                        <label for="brand">Brand</label>                        
                        <select name="brand" class="form-control select" id="brand" placeholder="Select Brand" style="width:100%">
<option value="" selected="selected"></option>
<?php  foreach ($allbrands as $row) {   ?>
                                    <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="name">Unit</label>                        
                        <input type="text" name="unit" value=""  class="form-control" id="unit" required="required" />
                    </div>
                    <div class="form-group all">
                        <label for="name">Quantity</label>                        
                        <input type="text" name="quantity" value=""  class="form-control" id="quantity" required="required" />
                    </div>
                    <div class="form-group all">
                        <label for="category">Category</label>                        
                        <select name="category"  onfocus="showSubCat(this.value)" onChange="showSubCat(this.value)" class="form-control select" id="category" placeholder="Select Category" required style="width:100%">
<option value="" selected="selected"></option>
<?php  foreach ($allcategories as $row) {   ?>
                                    <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="subcategory">Sub Category</label>                        
                        <div class="controls"> 
                        <div id="txtHint1"><input type="text" name="subcategory" value=""  class="form-control" id="subcategory"  placeholder="Please select category to load" /></div>
                        </div>
                    </div>
                    
                    <div class="form-group all">
                        <label for="product_image">Product Image</label>                        
                        <input id="product_image" type="file" data-browse-label="Browse ..." name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <label for="images">Product Gallery Images</label>                        
                        <input id="images" type="file" data-browse-label="Browse ..." name="userfile[]" multiple data-show-upload="false"
                               data-show-preview="false" class="form-control file" accept="image/*">
                    </div>
                    <div id="img-details"></div>
                </div>
                

                <div class="col-md-12">
                    <div class="form-group all">
                        <label for="product_details">Product Details</label>                        
                        <textarea name="product_details" cols="40" rows="10"  class="form-control" id="details"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="add_damaged_product" value="Add Product"  class="btn btn-primary" />
                    </div>

                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="clearfix"></div>
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

<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
    $(window).load(function () {
        $('.mm_products').addClass('active');
        $('.mm_products').find("ul").first().slideToggle();
        $('#products_add').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
