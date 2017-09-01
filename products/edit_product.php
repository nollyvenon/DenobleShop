<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    //redirect_to("../log-in");
}
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$product_details = $zentabooks_operation->view_product_detail($hiss);
extract($product_details);
$allbrands = $zentabooks_operation->get_all_brands();
$allcategories = $zentabooks_operation->get_all_categories();
$allunits = $zentabooks_operation->get_all_units();

if (isset($_POST['update_product']) ) {
    $product_id = $db_handle->sanitizePost($_POST['product_id']);
    foreach($_POST as $key => $value) {
        $_POST[$key] = $db_handle->sanitizePost(trim($value));
    }
    extract($_POST);
    
	if ($name != "" || $code != "" || $category != "" || $price != "" ){
        $upd_emp = $zentabooks_operation->edit_product($product_id, $type, $name, $code, $barcode_symbology, $brand, $category, $subcat_data, $unit, $default_sale_unit, $default_purchase_unit, $cost, $price, 
		$promotion, $promo_price, $start_date, $end_date, $tax_rate, $tax_method, $alert_quantity, $product_image, $product_details, $details);
        if($upd_emp) {
            $message_success = "You have successfully updated the product";
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
    <title>Edit Product - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS;?>/images/icon.png"/>
    <link href="<?php echo SITE_ASSETS;?>/styles/theme.css" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS;?>/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-migrate-1.2.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_ASSETS;?>/js/jquery.js"></script>
    <![endif]-->
    <noscript><style type="text/css">#loading { display: none; }</style></noscript>
        <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
		 $('.promo').show(); 
		 	$(document).ready(function(){
    $('#promotion').change(function(){
        var checked = $(this).attr('checked');
        if (checked) { 
           $('.promo').show();             
        } else {
            $('.promo').hide();
        }
    });        
});​
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active">Edit Product</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select category to load").select2({
            placeholder: "Please select category to load", data: [
                {id: '', text: 'Please select category to load'}
            ]
        });
        $('#category').change(function () {
            var v = $(this).val();
            $('#modal-loading').show();
            if (v) {
                $.ajax({
                    type: "get",
                    async: false,
                    url: "<?php echo SITE_URL;?>/products/getSubCategories/" + v,
                    dataType: "json",
                    success: function (scdata) {
                        if (scdata != null) {
                            $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select sub category").select2({
                                placeholder: "Please select category to load",
                                data: scdata
                            });
                        }
                    },
                    error: function () {
                        bootbox.alert('Ajax error occurred, Please tray again.');
                        $('#modal-loading').hide();
                    }
                });
            } else {
                $("#subcategory").select2("destroy").empty().attr("placeholder", "Please select category to load").select2({
                    placeholder: "Please select category to load",
                    data: [{id: '', text: 'Please select category to load'}]
                });
            }
            $('#modal-loading').hide();
        });
        $('#code').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-edit"></i>Edit Product</h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Please update the information below. The field labels marked with * are required input fields.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                                                                                                                <input type="hidden" name="token" value="6b555b24fcd174aa1d4924ac51102b99" />
<input type="hidden" name="product_id" value="<?= $id; ?>">                                                                                                                                
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="type">Product Type</label>                        <select name="type" class="form-control" id="type" required>
<option value="standard" selected="selected">Standard</option>
<option value="combo">Combo</option>
<option value="digital">Digital</option>
<option value="service">Service</option>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="name">Product Name</label>                        <input type="text" name="name" value="<?=$name;?>"  class="form-control" id="name" required="required" />
                    </div>
                    <div class="form-group all">
                        <label for="code">Product Code</label>                        <input type="text" name="code" value="<?=$code;?>"  class="form-control" id="code"  required="required" />
                        <span class="help-block">You can scan your barcode  and select the correct symbology below</span>
                    </div>
                    <div class="form-group all">
                        <label for="barcode_symbology">Barcode Symbology</label>                        <select name="barcode_symbology" class="form-control select" id="barcode_symbology" required style="width:100%;">
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
                        <label for="brand">Brand</label>                        <select name="brand" class="form-control select" id="brand" placeholder="Select Brand" style="width:100%">
<option value=""></option>
<?php  foreach ($allbrands as $row) {   ?>
                                    <option <?php if ($row['id'] == $brand){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="category">Category</label>                        <select name="category" class="form-control select" id="category" placeholder="Select Category" required style="width:100%">
<option value=""></option>
<?php  foreach ($allcategories as $row) {   ?>
                                    <option <?php if ($row['id'] == $category_id){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="subcategory">Sub Category</label>                        <div class="controls" id="subcat_data"> <input type="text" name="subcategory" value=""  class="form-control" id="subcategory"  placeholder="Please select category to load" />
                        </div>
                    </div>
                    <div class="form-group standard">
                        <label for="unit">Product Unit</label>                                                
                        <select name="unit" class="form-control tip" required id="unit" style="width:100%;">
<option value="">Select Unit</option>
<?php  foreach ($allunits as $row) {   ?>
<option <?php if ($row['id'] == $unit){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?> (<?=$row['code'];?>)</option>
<?php } ?>
</select>
                    </div>
                    <div class="form-group standard">
                        <label for="default_sale_unit">Default Sale Unit</label>                                                <select name="default_sale_unit" class="form-control" id="default_sale_unit" style="width:100%;">
<option value="">Select Unit</option>
<?php  foreach ($allunits as $row) {   ?>
<option <?php if ($row['id'] == $sale_unit){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?> (<?=$row['code'];?>)</option>
<?php } ?>
</select>
                    </div>
                    <div class="form-group standard">
                        <label for="default_purchase_unit">Default Purchase Unit</label>                        <select name="default_purchase_unit" class="form-control" id="default_purchase_unit" style="width:100%;">
<option value="">Select Unit</option>
<?php  foreach ($allunits as $row) {   ?>
<option <?php if ($row['id'] == $purchase_unit){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?> (<?=$row['code'];?>)</option>
<?php } ?>
</select>
                    </div>
                  <!--  <div class="form-group standard">
                        <label for="cost">Product Cost</label>                        
                        <input type="text" name="cost" value="<?=$cost;?>"  class="form-control tip" id="cost" />
                    </div>
                    <div class="form-group all">
                        <label for="price">Product Price</label>                        
                        <input type="text" name="price" value="<?=$price;?>"  class="form-control tip" id="price" />
                    </div>-->

                    <div class="form-group">
                        <input type="checkbox" class="promotion" name="promotion" id="promotion" onchange="check_dd();">
                        <label for="promotion" class="padding05">
                            Promotion                        </label>
                    </div>

                    <div id="promo" style="display:none;">
                        <div class="well well-sm">
                            <div class="form-group">
                                <label for="promo_price">Promotion Price</label>                                
                                <input type="text" name="promo_price" value="<?=$promo_price;?>"  class="form-control tip" id="promo_price" />
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>                                
                                <input type="text" name="start_date" value="<?=$start_date;?>"  class="form-control tip date" id="start_date" />
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>                                
                                <input type="text" name="end_date" value="<?=$end_date;?>"  class="form-control tip date" id="end_date" />
                            </div>
                        </div>
                    </div>


                                            <div class="form-group all">
                            <label for="tax_rate">Product Tax</label>                            <select name="tax_rate" class="form-control select" id="tax_rate" placeholder="Select Product Tax" style="width:100%">
<option value=""></option>
<option value="1" selected="selected">No Tax</option>
<option value="2">VAT @10%</option>
<option value="3">GST @6%</option>
<option value="4">VAT @20%</option>
</select>
                        </div>
                        <div class="form-group all">
                            <label for="tax_method">Tax Method</label>                            <select name="tax_method" class="form-control select" id="tax_method" placeholder="Select Tax Method" style="width:100%">
<option value="0" selected="selected">Inclusive</option>
<option value="1">Exclusive</option>
</select>
                        </div>
                                        <div class="form-group standard">
                        <label for="alert_quantity">Alert Quantity</label>                        <div
                            class="input-group"> <input type="text" name="alert_quantity" value="<?=$alert_quantity;?>"  class="form-control tip" id="alert_quantity" />
                            <span class="input-group-addon">
                            <input type="checkbox" name="track_quantity" id="inlineCheckbox1"
                                   value="1" checked="checked">
                        </span>
                        </div>
                    </div>
                    
                    <div class="form-group all">
                        <label for="product_image">Product Image</label>                        <input id="product_image" type="file" data-browse-label="Browse ..." name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <label for="images">Product Gallery Images</label>                        <input id="images" type="file" data-browse-label="Browse ..." name="userfile[]" multiple data-show-upload="false"
                               data-show-preview="false" class="form-control file" accept="image/*">
                    </div>
                    <div id="img-details"></div>
                </div>

                <div class="col-md-12">

                   <!-- <div class="form-group">
                        <input name="cf" type="checkbox" class="checkbox" id="extras" value="" checked="checked"/><label
                            for="extras" class="padding05">Custom Fields</label>
                    </div>-->
                    


                    <div class="form-group all">
                        <label for="product_details">Product Details</label>                        <textarea name="product_details" cols="40" rows="10"  class="form-control" id="details"><?=$product_details;?></textarea>
                    </div>
                    <div class="form-group all">
                        <label for="details">Product details for invoice</label>                        
                        <textarea name="details" cols="40" rows="10"  class="form-control" id="details"><?=$details;?></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="edit_product" value="Edit Product"  class="btn btn-primary" />
                    </div>

                </div>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="modal" id="aModal" tabindex="-1" role="dialog" aria-labelledby="aModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="aModalLabel">Add product manually</h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="awarehouse" class="col-sm-4 control-label">Warehouse</label>
                        <div class="col-sm-8">
                            <select name="warehouse" id="awarehouse" class="form-control">
<option value="" selected="selected"></option>
<option value="1">Warehouse 1</option>
<option value="2">Warehouse 2</option>
<option value="3">Warehouse 3</option>
</select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aquantity" class="col-sm-4 control-label">Quantity</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="aquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="aprice" class="col-sm-4 control-label">Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="aprice">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" name="update_product" id="update_product">Submit</button>
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
      - Page rendered in <strong>0.6410</strong> seconds</p>
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
        $('#products_edit').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
