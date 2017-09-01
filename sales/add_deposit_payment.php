<?php
//This is a partial deposit for a product to be collected in the future
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
if (!contains( '110',$allowed_pages)) {
	 $message_error .= "You do not have right to that page or feature. Regards.";
	redirect_to("../dashboard?msg=10");
 }
$id_encrypted = $db_handle->sanitizePost($_GET['hissdel']);
$hiss = decrypt(str_replace(" ", "+", $id_encrypted));
//$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$dep_details = $zentabooks_operation->view_deposit_payment_info_by_id($hiss);
extract($dep_details);
$dep_p_details = $zentabooks_operation->view_deposit_payment_details_by_id($hiss);
$customers = $zentabooks_operation->get_users_by_groups(3);
$salespoints = $zentabooks_operation->get_all_salespoints();
$allproducts = $zentabooks_operation->product_list1();
$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_deposits',date('m'))+1;
$refno = "DEPPAY/".date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count);
if ($hiss == ""){
		transcode:
			$transaction_id = rand_string(17);
            if($db_handle->numRows("SELECT transaction_id FROM sma_deposits WHERE transaction_id = '$transaction_id'") > 0) { goto transcode; }
}else{
	$transaction_id = $hiss;
	$refno = $reference_no;
	$comp_name = $zentabooks_operation->get_company_user_details($company_id)[0]['name'];
}
$settings = $zentabooks_operation->get_settings();
if ($_POST['add_payment']){
	$product_code = $_POST['senta'];
	$product = $_POST['product'];
	$reference_no = $_POST['reference_no'];
	$transaction_id = $_POST['transaction_id'];
		$myDateTime1 = DateTime::createFromFormat('d/m/Y H:i', $_POST['date']);
		$date = $myDateTime1->format('Y-m-d H:i:s');
		$customer=$_POST['customer'];
		$amountpaid=remove_comma($_POST['amountpaid']);
		$paid_by=$_POST['paid_by'];
		$salespoint=$_POST['salespoint'];
		$pcc_no=$_POST['pcc_no'];
		$pcc_holder=$_POST['pcc_holder'];
		$pcc_type=$_POST['pcc_type'];
		$pcc_month=$_POST['pcc_month'];
		$pcc_year=$_POST['pcc_year'];
		$pcc_ccv=$_POST['pcc_ccv'];
		$cheque_no=$_POST['cheque_no'];
		$payment_term=$_POST['payment_term'];
		$status=$_POST['status'];
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
		$add_pay = $zentabooks_operation->add_deposit_payments($date, $customer, $product, $transaction_id, $reference_no,$salespoint, $paid_by, $cheque_no, $pcc_no, $pcc_holder, $pcc_type, $pcc_year, $pcc_ccv, $amountpaid, $currency, $admin_fullname, $attachment, $status, $payment_note);
        if($add_pay) {
            $message_success = "You have successfully added the payment";
			//redirect_to("deposit_payments");
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
    <title>Add Deposit Payment - ZentaBooks</title>
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

    if(document.getElementById('paid_by_1').value == "cc") {
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

 $(document).ready(function () {

            $("#date").datetimepicker({
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


    });
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/sales">Sales</a></li><li class="active">Add Deposit Payment</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file"></i>Add Deposit Payment <?php if($hiss!=""){ echo "for Transaction ID: $hiss and Customer $comp_name"; } ?></h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="Actions"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                                                <li>
                            <a href="<?php echo SITE_URL;?>/sales/deposit_payments">
                                <i class="fa fa-money"></i> View Payments                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/add_deposit_payment" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-money"></i> Add Deposit Payment                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                                <div class="clearfix"></div>
                                          <?php require_once '../layouts/feedback_message.php'; ?>
      
        <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
<input name="token" value="aed9a4f409255cf0dbcbf98fa664a814" type="hidden">                                                                  
        <div class="modal-body">
            <p>Please fill in the information below. The field labels marked with * are required input fields.</p>

            <div class="row">
                                    <div class="col-sm-6">
                        <div class="form-group has-feedback">
                            <label for="date">Date *</label>                            
                            <input name="date" value="<?php  if($hiss!=""){ echo date('d/m/Y H:i', strtotime($date)); }?>" class="form-control datetime" id="date" required="required" data-bv-field="date" type="text"><i style="display: none;" class="form-control-feedback" data-bv-icon-for="date"></i>
                        </div>
                    </div>
                                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="reference_no">Reference No</label>                        
                        <input name="reference_no" value="<?=$refno;?>" class="form-control tip" id="reference_no" type="text">
                    </div>
                </div>

                <input value="<?php echo $transaction_id;?>" name="transaction_id" type="hidden">
            </div>
            <div class="clearfix"></div>
            
            <div id="payments">

                <div class="well well-sm well_1">
                    <div class="col-md-12">
                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slsalespoint">Salespoint</label>                                    
                                                <select name="salespoint" id="salespoint" class="form-control col-sm-5" >
                                                    <option value="" >Select Salespoint...</option>
                                                    <?php 
                                                                foreach($salespoints as $row2):
                                                                ?>
                                                                    <option <?php if ($salespoint == $row2['id']){?> selected="selected" <?php } ?> value="<?php echo $row2['id'];?>">
                                                                            <?php echo $row2['name'];?>
                                                                                </option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product">Product Name</label>                                    
                                                <select name="product" required class="form-control" data-live-search="true" >
                                                <option>Select A Product</option>
                                               <?php  foreach ($allproducts as $row) {   ?>
                                                        <option <?php if ($product_id == $row['id']){?> selected="selected" <?php } ?> value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                                        <?php } ?>
                                            </select>
                                            </div>
                                        </div> 
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            
                                                <label for="customer">Customer Name</label>                                    
                                                <select name="customer" id="customer" required class="form-control" data-live-search="true"  >
                                                                    <option value="" >Select Customer...</option>
                                                                    <?php  foreach($customers as $row2): ?>
                                                                                    <option <?php if ($company_id == $row2['id']){?> selected="selected" <?php } ?> value="<?php echo $row2['id'];?>">
                                                                                            <?php echo $row2['name'];?>
                                                                                                </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            
                                                <label for="status">Status</label>                                    
                                                <select name="status" id="status" required class="form-control" data-live-search="true"  >
                                                                    <option value="" >Select Status</option>
                                                                    <option <?php if ($status == 'pending'){?> selected="selected" <?php } ?> value="pending">Pending</option>
                                                                    <option <?php if ($status == 'refunded'){?> selected="selected" <?php } ?>  value="refunded" >Refunded</option>
                                                                    <option <?php if ($status == 'completed'){?> selected="selected" <?php } ?>  value="completed" >Completed</option>
                                                                    
                                                                </select>
                                            </div>
                                        </div> 
                            			<div class="col-sm-6">
                                                <div class="payment">
                                                    <div id="ngc" class="form-group ngc">
                                                        <label for="amount_1">Amount</label>                                                        
                                                        <input name="amountpaid" type="text" id="amount_1"
                                                               class="pa form-control kb-pad amount"/>
                                                    </div>
                                                    <div id="gc" class="form-group gc" style="display: none;">
                                                        <label for="gift_card_no">Gift Card No</label>                                                        <input name="gift_card_no" type="text" id="gift_card_no"
                                                               class="pa form-control kb-pad"/>

                                                        <div id="gc_details"></div>
                                                    </div>
                                                </div>
                                            </div>                                        
                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="paid_by_1">Pay Mode</label>                                                    
                                                    <select name="paid_by" id="paid_by_1" class="form-control paid_by" onchange="check_dd1();" >
                                                        
        <option value="">Select One</option>
        <option <?php if ($status == 'cash'){?> selected="selected" <?php } ?> value="cash">Cash</option>
        <option <?php if ($status == 'gift_card'){?> selected="selected" <?php } ?> value="gift_card">Gift Card</option>
        <option <?php if ($status == 'cc'){?> selected="selected" <?php } ?> value="cc">Credit/Debit Card</option>
        <option <?php if ($status == 'cheque'){?> selected="selected" <?php } ?> value="cheque">Cheque</option>
        <option value="transfer">Transfer</option>                                                    
        <option <?php if ($status == 'other'){?> selected="selected" <?php } ?> value="other">Other</option>
        <option value="deposit">Deposit</option>                                                    
        </select>
                                                </div>
                                            </div>

                        </div>
                        <div class="clearfix"></div>
                        <div class="pcc_1" id="pcc_1" style="display:none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="pcc_no" id="pcc_no_1" class="form-control" placeholder="Credit/Debit Card No" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <input name="pcc_holder" id="pcc_holder_1" class="form-control" placeholder="Holder Name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="select2-container form-control pcc_type" id="s2id_pcc_type_1"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-6">Visa</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen6" class="select2-offscreen"></label><input class="select2-focusser select2-offscreen" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-6" id="s2id_autogen6" type="text"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen6_search" class="select2-offscreen"></label>       <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-6" id="s2id_autogen6_search" placeholder="" type="text">   </div>   <ul class="select2-results" role="listbox" id="select2-results-6">   </ul></div></div><select name="pcc_type" id="pcc_type_1" class="form-control pcc_type" placeholder="Card Type" tabindex="-1" title="" style="display: none;">
                                            <option value="">Select Card Type</option>
                                            <option value="Visa">Visa</option>
                                            <option value="MasterCard">MasterCard</option>
                                            <option value="Amex">Amex</option>
                                            <option value="Discover">Discover</option>
                                        </select>
                                        <!-- <input type="text" id="pcc_type_1" class="form-control" placeholder="Card Type" />-->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input name="pcc_month" id="pcc_month_1" class="form-control" placeholder="Month" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <input name="pcc_year" id="pcc_year_1" class="form-control" placeholder="Year" type="text">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                        <input name="pcc_ccv" id="pcc_cvv2_1" class="form-control" placeholder="CVV2" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="pcheque_1" class="pcheque_1" style="display:none;">
                            <div class="form-group"><label for="cheque_no_1">Cheque No</label>                                
                            <input name="cheque_no" id="cheque_no_1" class="form-control cheque_no" type="text">
                            </div>
                        </div>
                        
                        <div class="form-group">
                                            <label for="payment_note_1">Payment Note</label>                                            
                                            <textarea name="payment_note" id="payment_note_1"
                                                      class="pa form-control kb-text payment_note"></textarea>
                                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>

                            <div class="form-group">
                                <label for="document">Attach Document</label>                                
                                <input id="document" type="file" data-browse-label="Browse ..." name="document" data-show-upload="false"
                                       data-show-preview="false" class="form-control file">
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
<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
 $(window).load(function () {
        $('.mm_sales').addClass('active');
        $('.mm_sales').find("ul").first().slideToggle();
        $('#add_deposit_payment').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
