<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$id_encrypted = $db_handle->sanitizePost($_GET['hissdel']);
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$sales_details = $zentabooks_operation->view_sales_info_by_id($hiss);
extract($sales_details);
$salesman_list = $zentabooks_operation->salesman_list();
$settings = $zentabooks_operation->get_settings();
if ($_POST['add_payment']){
	$product_code = $_POST['senta'];
	$product_price = $_POST['product_price'];
		$amountpaid=$_POST['amountpaid'];
		$paid_by=$_POST['paid_by'];
		$pcc_no=$_POST['pcc_no'];
		$pcc_holder=$_POST['pcc_holder'];
		$pcc_type=$_POST['pcc_type'];
		$pcc_month=$_POST['pcc_month'];
		$pcc_year=$_POST['pcc_year'];
		$pcc_ccv=$_POST['pcc_ccv'];
		$cheque_no=$_POST['cheque_no'];
		$payment_term=$_POST['payment_term'];
		$payment_status=$_POST['payment_status'];
		$payment_reference_no=$_POST['payment_reference_no'];
		$payment_note=$_POST['payment_note'];
		
	   $document  = time().$_FILES['document']['name'];
	
		$uploaddir = "../uploads/sales/documents/";
	
		if (!is_dir('../uploads/sales/documents/')) {
			mkdir('../uploads/sales/documents/', 0777, TRUE);
		}
	
		$document1 = $uploaddir.$document;
		$tmp_file = $_FILES['document']['tmp_name'];
		//print_r($product);
		move_uploaded_file($tmp_file, $document1); 		
			
	if ($reference_no != ""){
		$add_pay = $zentabooks_operation->pay_sale_commission($date, $salesman, $reference_no, $amountpaid, $details, $admin_code);
        if($add_pay) {
            $message_success = "You have successfully added the payment";
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
    <title>Pay Sales Commission - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_URL;?>/themes/default/assets/images/icon.png"/>
    <link href="<?php echo SITE_URL;?>/themes/default/assets/styles/theme.css" rel="stylesheet"/>
    <link href="<?php echo SITE_URL;?>/themes/default/assets/styles/style.css" rel="stylesheet"/>
    <script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery.js"></script>
    <![endif]-->
    <noscript><style type="text/css">#loading { display: none; }</style></noscript>
        <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");
        });
		function check_dd1() {
    if(document.getElementById('paid_by_1').value == "Cheque") {
        document.getElementById('pcheque_1').style.display = 'block';
    } else {
        document.getElementById('pcheque_1').style.display = 'none';
    }

    if(document.getElementById('paid_by_1').value == "CC") {
        document.getElementById('pcc_1').style.display = 'block';
    } else {
        document.getElementById('pcc_1').style.display = 'none';
    }
	if(document.getElementById('paid_by_1').value == "gift_card") {
        document.getElementById('gc').style.display = 'block';
        document.getElementById('ngc').style.display = 'none';
    } else {
        document.getElementById('gc').style.display = 'none';
        document.getElementById('ngc').style.display = 'block';
    }
	
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/purchases">Purchases</a></li><li class="active">View</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file"></i>Add Sales Commission</h2>

     
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                                <div class="clearfix"></div>
                
        <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
<input name="token" value="aed9a4f409255cf0dbcbf98fa664a814" type="hidden">                                                                  
        <div class="modal-body">
            <p>Please fill in the information below. The field labels marked with * are required input fields.</p>

            <div class="row">
                                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="date">Date *</label>                            
                            <input name="date" value="" class="form-control datetime" id="date" required="required" data-bv-field="date" type="text"><i style="display: none;" class="form-control-feedback" data-bv-icon-for="date"></i>
                        <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="date" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>
                    </div>
                                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reference_no">Reference No</label>                        
                        <input name="reference_no" value="" class="form-control tip" id="reference_no" type="text">
                    </div>
                    </div>
                    
                    <div class="col-sm-6">
                    	<div class="form-group">
                                            
                                                <label for="salesman">Salesman</label>                                    
                                                <select name="salesman" id="salesman" class="form-control col-sm-5" >
                                                    <option value="" >Select Salesman...</option>
                                                    <?php 
                                                                foreach($salesman_list as $row2):
                                                                ?>
                                                                    <option value="<?php echo $row2['id'];?>">
                                                                            <?php echo $row2['name'];?>
                                                                                </option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                </select>
                                            </div>
                     </div>
                     <div class="col-sm-6">
                          <div class="form-group">
                              <label for="amount_1">Amount(NGN)</label>                                                        
                              <input name="amountpaid" type="text" id="amount_1"
                                     class="pa form-control kb-pad amount"/>
                          </div>
                	</div>

            </div>
            <div class="clearfix"></div>

            <div class="form-group">
                <label for="note">Note</label>                
                <textarea name="details" cols="40" rows="10"  class="form-control" id="details"></textarea>
            </div>

        </div>
        <div class="modal-footer">
            <input name="add_payment" value="Add Payment" class="btn btn-primary" type="submit">
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
      - Page rendered in <strong>2.3741</strong> seconds</p>
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
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/sales.js"></script>
<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
 $(window).load(function () {
        $('.mm_purchases').addClass('active');
        $('.mm_purchases').find("ul").first().slideToggle();
        $('#purchases_add').addClass('active');
        $('.mm_purchases a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
