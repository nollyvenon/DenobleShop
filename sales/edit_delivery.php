<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$sales_details = $zentabooks_operation->view_sales_delivery_detail($hiss);
extract($sales_details);
$cust_details = $zentabooks_operation->get_company_user_details($customer_id);

if ($_POST['edit_delivery']){
	$hissto = $_POST['hissto'];
	$date = $_POST['date'];
	$do_reference_no = $_POST['do_reference_no'];
	$sale_reference_no = $_POST['sale_reference_no'];
	$customer = $_POST['customer'];
	$address = $_POST['address'];
	$status = $_POST['status'];
	$delivered_by = $_POST['delivered_by'];
	$received_by = $_POST['received_by'];
	$document = $_POST['document'];
	$note = $_POST['note'];
	
	$delivery_details = $zentabooks_operation->edit_delivery($hissto, $date, $do_reference_no, $sale_reference_no, $status, $delivered_by, $received_by, $document, $note);

}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales - ZentaBooks</title>
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/sales">Sales</a></li>                           <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-heart"></i>Sales Delivery <?php if($hiss == ""){?> (All Warehouses) <?php }else{ echo '('.$mywarehouse.')';}?>       </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="Actions"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/add_delivery">
                                <i class="fa fa-plus-circle"></i> Add Sale                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> Export to Excel file                            </a>
                        </li>
                        <li>
                            <a href="#" id="pdf" data-action="export_pdf">
                                <i class="fa fa-file-pdf-o"></i> Export to PDF file                            </a>
                        </li>
                        <li>
                            <a href="#" id="combine" data-action="combine">
                                <i class="fa fa-file-pdf-o"></i> Combine to pdf                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo"
                            title="<b>Delete Sales</b>"
                            data-content="<p>Are you sure?</p><button type='button' class='btn btn-danger' id='delete' data-action='delete'>Yes I'm sure</a> <button class='btn bpo-close'>No</button>"
                            data-html="true" data-placement="left">
                            <i class="fa fa-trash-o"></i> Delete Sales                        </a>
                    </li>
                    </ul>
                </li>
                                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="Warehouses"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="<?php echo SITE_URL;?>/sales"><i class="fa fa-building-o"></i> All Warehouses</a></li>
                            <li class="divider"></li>
                            <?php  foreach ($allwarehouses as $row) {   ?>
                            <li><a href="<?php echo SITE_URL;?>/sales?hiss=<?=$row['id'];?>"><i class="fa fa-building"></i><?=$row['name'];?></a></li>    
                          <?php } ?>
                        </ul>
                    </li>
                            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

<div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-2x">×</i>
            </button>
            <h4 class="modal-title" id="myModalLabel">Edit Sales Delivery</h4>
        </div>
        <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate class="bv-form"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
<input name="token" value="63ddb3ae64d908cabd20bb532d411910" type="hidden">   
<input type="hidden" name="hissto" value="<?= $hiss; ?>">                                                                                                                             
        <div class="modal-body">
            <p>Please fill in the information below. The field labels marked with * are required input fields.</p>

            <div class="row">
                <div class="col-md-6">
                                            <div class="form-group has-feedback">
                            <label for="date">Date *</label>                            <input name="date" value="" class="form-control datetime" id="date" required="required" data-bv-field="date" type="text"><i style="display: none;" class="form-control-feedback" data-bv-icon-for="date"></i>
                        <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="date" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>
                                        <div class="form-group">
                        <label for="do_reference_no">Delivery Reference No</label>                        <input name="do_reference_no" value="<?= $do_reference_no;?>" class="form-control tip" id="do_reference_no" type="text">
                    </div>

                    <div class="form-group has-feedback">
                        <label for="sale_reference_no">Sale Reference No *</label>                        <input name="sale_reference_no" value="<?= $reference_no;?>" class="form-control tip" id="sale_reference_no" required="required" data-bv-field="sale_reference_no" type="text"><i style="display: none;" class="form-control-feedback" data-bv-icon-for="sale_reference_no"></i>
                    <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="sale_reference_no" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>
                    <input value="109" name="sale_id" type="hidden">

                    <div class="form-group has-feedback">
                        <label for="customer">Customer *</label>                        <input name="customer" value="<?= $cust_details['name'];?>" class="form-control" id="customer" required="required" data-bv-field="customer" type="text"><i style="display: none;" class="form-control-feedback" data-bv-icon-for="customer"></i>
                    <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="customer" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>

                    <div class="form-group has-feedback">
                        <label for="address">Address *</label>                        <div class="redactor_box"><ul class="redactor_toolbar" id="redactor_toolbar_0"><div class="redactor_dropdown redactor_dropdown_box_formatting" style="display: none;"><a href="#" class=" redactor_dropdown_p" tabindex="-1">Normal text</a><a href="#" class="redactor_format_pre redactor_dropdown_pre" tabindex="-1">Code</a><a href="#" class="redactor_format_h3 redactor_dropdown_h3" tabindex="-1">Header 3</a><a href="#" class="redactor_format_h4 redactor_dropdown_h4" tabindex="-1">Header 4</a></div><li><a href="javascript:;" title="Formatting" tabindex="-1" class="redactor_btn redactor_btn_formatting"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="Align text to the left" tabindex="-1" class="redactor_btn redactor_btn_alignleft"></a></li><li><a href="javascript:;" title="Center text" tabindex="-1" class="redactor_btn redactor_btn_aligncenter"></a></li><li><a href="javascript:;" title="Align text to the right" tabindex="-1" class="redactor_btn redactor_btn_alignright"></a></li><li><a href="javascript:;" title="Justify text" tabindex="-1" class="redactor_btn redactor_btn_justify"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="Bold" tabindex="-1" class="redactor_btn redactor_btn_bold"></a></li><li><a href="javascript:;" title="Italic" tabindex="-1" class="redactor_btn redactor_btn_italic"></a></li><li><a href="javascript:;" title="Underline" tabindex="-1" class="redactor_btn redactor_btn_underline"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="• Unordered List" tabindex="-1" class="redactor_btn redactor_btn_unorderedlist"></a></li><li><a href="javascript:;" title="1. Ordered List" tabindex="-1" class="redactor_btn redactor_btn_orderedlist"></a></li><li class="redactor_separator"></li><div class="redactor_dropdown redactor_dropdown_box_link" style="display: none;"><a href="#" class=" redactor_dropdown_link" tabindex="-1">Insert link</a><a href="#" class=" redactor_dropdown_unlink" tabindex="-1">Unlink</a></div><li><a href="javascript:;" title="Link" tabindex="-1" class="redactor_btn redactor_btn_link"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="HTML" tabindex="-1" class="redactor_btn redactor_btn_html"></a></li></ul><div class="redactor_form-control redactor_editor" dir="ltr" style="min-height: 100px;" contenteditable="true"><p><?= $cust_details['address'];?><br>Tel: <?= $cust_details['phone'];?> Email: <?= $cust_details['email'];?></p></div><textarea name="address" cols="40" rows="10" class="form-control" id="address" required data-bv-field="address" dir="ltr" style="display: none;"><?= $cust_details['address'];?>   &lt;br&gt;Tel: <?= $cust_details['phone'];?> Email: <?= $cust_details['email'];?></textarea></div><i style="display: none;" class="form-control-feedback" data-bv-icon-for="address"></i>
                    <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="address" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>
                </div>

                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="status">Status *</label>                                                <div class="select2-container form-control" id="s2id_status" style="width:100%;"><a href="javascript:void(0)" class="select2-choice" tabindex="-1">   <span class="select2-chosen" id="select2-chosen-8">Packing</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow" role="presentation"><b role="presentation"></b></span></a><label for="s2id_autogen8" class="select2-offscreen">Status *</label><input class="select2-focusser select2-offscreen" aria-haspopup="true" role="button" aria-labelledby="select2-chosen-8" id="s2id_autogen8" type="text"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <label for="s2id_autogen8_search" class="select2-offscreen">Status *</label>       <input autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input" role="combobox" aria-expanded="true" aria-autocomplete="list" aria-owns="select2-results-8" id="s2id_autogen8_search" placeholder="" type="text">   </div>   <ul class="select2-results" role="listbox" id="select2-results-8">   </ul></div></div><select name="status" class="form-control" id="status" required style="width: 100%; display: none;" data-bv-field="status" tabindex="-1" title="Status *">
<option <?php if ($status == 'packing'){?> selected="selected" <?php } ?> value="packing">Packing</option>
<option <?php if ($status == 'delivering'){?> selected="selected" <?php } ?> value="delivering">Delivering</option>
<option <?php if ($status == 'delivered'){?> selected="selected" <?php } ?> value="delivered">Delivered</option>
</select><i style="display: none;" class="form-control-feedback" data-bv-icon-for="status"></i>
                    <small style="display: none;" class="help-block" data-bv-validator="notEmpty" data-bv-for="status" data-bv-result="NOT_VALIDATED">Please enter/select a value</small></div>

                    <div class="form-group">
                        <label for="delivered_by">Delivered by</label>                        <input name="delivered_by" value="<?=$delivered_by;?>" class="form-control" id="delivered_by" type="text">
                    </div>

                    <div class="form-group">
                        <label for="received_by">Received by</label>                        <input name="received_by" value="<?=$received_by;?>" class="form-control" id="received_by" type="text">
                    </div>

                    <div class="form-group">
                        <label for="attachment">Attachment</label>                        <span class="file-input file-input-new">
<div class="input-group ">
   <div tabindex="-1" class="form-control file-caption  kv-fileinput-caption">
   <div class="file-caption-name"></div>
</div>
   <div class="input-group-btn">
       <button type="button" class="btn btn-default btn-danger fileinput-remove fileinput-remove-button"><i class="fa fa-ban-circle"></i> Remove</button>
       
       <div class="btn btn-primary btn-file"> <i class="fa fa-folder-open"></i> &nbsp;Browse ... <input id="attachment" data-browse-label="Browse ..." name="document" data-show-upload="false" data-show-preview="false" class="form-control file" type="file"></div>
   </div>
</div></span>
                    </div>

                    <div class="form-group">
                        <label for="note">Note</label>                        <div class="redactor_box"><ul class="redactor_toolbar" id="redactor_toolbar_1"><div class="redactor_dropdown redactor_dropdown_box_formatting" style="display: none;"><a href="#" class=" redactor_dropdown_p" tabindex="-1">Normal text</a><a href="#" class="redactor_format_pre redactor_dropdown_pre" tabindex="-1">Code</a><a href="#" class="redactor_format_h3 redactor_dropdown_h3" tabindex="-1">Header 3</a><a href="#" class="redactor_format_h4 redactor_dropdown_h4" tabindex="-1">Header 4</a></div><li><a href="javascript:;" title="Formatting" tabindex="-1" class="redactor_btn redactor_btn_formatting"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="Align text to the left" tabindex="-1" class="redactor_btn redactor_btn_alignleft"></a></li><li><a href="javascript:;" title="Center text" tabindex="-1" class="redactor_btn redactor_btn_aligncenter"></a></li><li><a href="javascript:;" title="Align text to the right" tabindex="-1" class="redactor_btn redactor_btn_alignright"></a></li><li><a href="javascript:;" title="Justify text" tabindex="-1" class="redactor_btn redactor_btn_justify"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="Bold" tabindex="-1" class="redactor_btn redactor_btn_bold"></a></li><li><a href="javascript:;" title="Italic" tabindex="-1" class="redactor_btn redactor_btn_italic"></a></li><li><a href="javascript:;" title="Underline" tabindex="-1" class="redactor_btn redactor_btn_underline"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="• Unordered List" tabindex="-1" class="redactor_btn redactor_btn_unorderedlist"></a></li><li><a href="javascript:;" title="1. Ordered List" tabindex="-1" class="redactor_btn redactor_btn_orderedlist"></a></li><li class="redactor_separator"></li><div class="redactor_dropdown redactor_dropdown_box_link" style="display: none;"><a href="#" class=" redactor_dropdown_link" tabindex="-1">Insert link</a><a href="#" class=" redactor_dropdown_unlink" tabindex="-1">Unlink</a></div><li><a href="javascript:;" title="Link" tabindex="-1" class="redactor_btn redactor_btn_link"></a></li><li class="redactor_separator"></li><li><a href="javascript:;" title="HTML" tabindex="-1" class="redactor_btn redactor_btn_html"></a></li></ul><div class="redactor_form-control redactor_editor" dir="ltr" style="min-height: 100px;" contenteditable="true"><p>​</p></div><textarea name="note" cols="40" rows="10" class="form-control" id="note" dir="ltr" style="display: none;"><?=$note;?></textarea></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input name="edit_delivery" value="Edit Delivery" class="btn btn-primary" type="submit">
        </div>
    </form></div>
                

                
            </div>
        </div>
    </div>
</div>                                                                                                                        
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
        $('.mm_sales').addClass('active');
        $('.mm_sales').find("ul").first().slideToggle();
        $('#sales_index').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
