<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
	//print_r($zentabooks_operation->get_warehouse_qty_by_productid(4,1));
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$allproducts = $zentabooks_operation->product_list();

	 if ($_POST['add_adjustment']){
	 	$entrydate = date ('d-m-Y');		
		$product=$_POST['product'];
		$adjust_type=$_POST['adjust_type'];
		$quantity=$_POST['quantity'];
		$serialnumber=$_POST['serialnumber'];
		$note=$_POST['note'];
		//$date=date('Y-m-d H:i:s', strtotime($_POST['date']));
		$myDateTime = DateTime::createFromFormat('d/m/Y H:i', $_POST['date']);
		$date = $myDateTime->format('Y-m-d');
		$reference_no=$_POST['reference_no'];
		$warehouse=$_POST['warehouse'];
  /*  foreach($_POST as $key => $value) {
        $_POST[$key] = $db_handle->sanitizePost(trim($value));
    }
    extract($_POST);*/

   $document  = time().$_FILES['document']['name'];

    $uploaddir = "../uploads/adjustments/documents/";

    if (!is_dir('../uploads/adjustments/documents/')) {
        mkdir('../uploads/adjustments/documents/', 0777, TRUE);
    }

	$document1 = $uploaddir.$document;
	$tmp_file = $_FILES['document']['tmp_name'];
	print_r($product);
	move_uploaded_file($tmp_file, $document1); 		
	$insert_id = $zentabooks_operation->add_adjustment($date, $reference_no, $warehouse, $note, $document, $user_code);
			foreach($product as $a => $b){
				$zentabooks_operation->add_adjustment_items($insert_id, $warehouse, $product[$a], $adjust_type[$a], intval($quantity[$a]), $serialnumber[$a]);
			}
			$message_success = "Quantity Adjustment entered successfully";
		
	 }
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Adjustment - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS.'/images/icon.png';?>"/>
    <link href="<?php echo SITE_ASSETS.'/styles/theme.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-2.0.3.min.js';?>"></script>
    <script type="text/javascript" src="<?php echo SITE_ASSETS.'/js/jquery-migrate-1.2.1.min.js';?>"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_ASSETS;?>/js/jquery.js"></script>
    <![endif]-->
    <noscript><style type="text/css">#loading { display: none; }</style>
</noscript>
		<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-dynamic-form.js"></script>
        <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
		    $(document).ready(function () {

                                if (!localStorage.getItem('sldate')) {
            $("#sldate").datetimepicker({
                format: site.dateFormats.js_ldate,
                fontAwesome: true,
                language: 'sma',
                weekStart: 1,
                todayBtn: 1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0
            }).datetimepicker('update', new Date());
        }

    });
    </script>
    <script>
$(function() {
    $( "#add_item" ).autocomplete({
        source: 'http://localhost/stockfeb2017/products/data/adjustment_suggestion.php'
    });
});
			$(document).ready(function(){	
				$("#duplicate").dynamicForm("#plus", "#minus", {limit:50, createColor: 'yellow',removeColor: 'red'});
				
			});
		</script></head>

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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active">Quantity Adjustments</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>

<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Add Adjustment</h2>
    </div>
    <div class="box-content">
                <div class="row">
            <div class="col-lg-12">

                <p class="introtext">Please fill in the information below. The field labels marked with * are required input fields.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="token" value="ad58ad3f5903dcd160f9dd3b4e469db8" />                               
                <div class="row">
                    <div class="col-lg-12">
                                <?php require_once '../layouts/feedback_message.php'; ?>
                    
                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="qadate">Date</label>                                    
                                    <input type="text" name="date" value=""  class="form-control input-tip datetime" id="sldate" required="required" />
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qaref">Reference No</label>                                <input type="text" name="reference_no" value=""  class="form-control input-tip" id="qaref" />
                            </div>
                        </div>
                        
<input type="hidden" name="count_id" value="" />

                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="warehouse">Warehouse</label>                                    <select name="warehouse" id="warehouse" class="form-control input-tip select" data-placeholder="Select Warehouse" required  style="width:100%;">
<?php  foreach ($allwarehouses as $row) {   ?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
</select>
                                </div>
                            </div>
                                                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="document">Attach Document</label>                                <input id="document" type="file" data-browse-label="Browse ..." name="document" data-show-upload="false"
                                       data-show-preview="false" class="form-control file">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="control-group table-group">
                                <label class="table-label">Products *</label>

                                <div class="controls table-controls">

                                        <div class="form-group">
				<label class="col-md-5">Product Name (Product Code)<span class="required">*</span></label>
              <label class="col-md-2">Type<span class="required">*</span></label>
              <label class="col-md-1">Quantity<span class="required">*</span></label>
              <label class="col-md-3">Serial Number<span class="required">*</span></label>
              <label class="col-md-1"><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></label>
              <div id="duplicate" class="row form-group">
                  <div class="col-md-5 col-xs-11"><select name="product" id="product"  class=" col-md-12 form-control" data-live-search="true" >
                  			<option>Select A Product</option>
                           <?php  foreach ($allproducts as $row) {   ?>
                                    <option  value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
            </select> </div>
            
                          <div class="col-md-2 col-xs-11">
                          <select name="adjust_type" id="adjust_type" class="form-control input-tip select" data-placeholder="Select Warehouse" required  style="width:100%;">
                          <option value="addition">Addition</option>
                          <option value="subtraction">Subtraction</option>
                          </select> </div>
                          <div class="col-md-1 col-xs-11"><input name="quantity" required class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-3 col-xs-11"><input name="serialnumber"  class=" col-md-12 form-control" type="text" size="35" /> </div>
                    <div class="col-md-1 col-xs-11"><span><a id="minus" href=""  >[-]</a> <a id="plus" href="">[+]</a></span></div>
                    <div class="clearfix"></div>
              </div>
           </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="qanote">Note</label>                                    <textarea name="note" cols="40" rows="10"  class="form-control" id="note" style="margin-top: 10px; height: 100px;"></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div
                                class="fprom-group"><input type="submit" name="add_adjustment" value="Submit"  id="add_adjustment" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;" />
                                <button type="button" class="btn btn-danger" id="reset">Reset</div>
                        </div>
                    </div>
                </div>
                </form>
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
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/adjustments.js"></script>
<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
    $(window).load(function () {
        $('.mm_products').addClass('active');
        $('.mm_products').find("ul").first().slideToggle();
        $('#products_add_adjustment').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
