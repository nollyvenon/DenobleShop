<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
if ($_GET['hissdel'] == ""){
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
}else{
$id_encrypted = $db_handle->sanitizePost($_GET['hissdel']);
}
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$dep_details = $zentabooks_operation->view_deposit_payment_info_by_id($hiss);
extract($dep_details);
$settings = $zentabooks_operation->get_settings();
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales Payments - ZentaBooks</title>
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/sales/deposit_payments">Deposit Payment</a></li><li class="active">View</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file"></i>Deposit Payment Number. <?= $id;?></h2>

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
                            <a href="<?php echo SITE_URL;?>/sales/add_deposit_payment?hissdel=<?=encrypt($id);?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-money"></i> Add Payment                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/edit?hissdel=<?=encrypt($id);?>">
                                <i class="fa fa-edit"></i> Edit Deposit                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/email?hissdel=<?=encrypt($id);?>">
                                <i class="fa fa-envelope-o"></i> Send Email                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/download?hissdel=<?=encrypt($id);?>">
                                <i class="fa fa-file-pdf-o"></i> Export to PDF file                            </a>
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
                <div class="print-only col-xs-12">
                    <img src="<?php echo SITE_URL;?>/assets/uploads/logos/<?= $settings['logo2'];?>"
                         alt="ZentaBooks">
                </div>
                <div class="well well-sm">

                    <div class="col-xs-4 border-right">
                        <div class="col-xs-2"><i class="fa fa-3x fa-truck padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?= $settings['site_name'];?></h2>
                           <?= $zentabooks_operation->get_salespoint_by_id($salespoint)['name'];?>
                            <p><?= $zentabooks_operation->get_salespoint_by_id($salespoint)['address'];?></p><br>                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-xs-4">

                        <div class="col-xs-2"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                           
                            <?php $comp_details = $zentabooks_operation->get_company_user_details($company_id);
							
							?>
                            <h2 class=""><?php echo $comp_details[0]['name'];?></h2>
                            
                            <?php echo $comp_details[0]['address'];?><br /><?php echo $comp_details[0]['state'];?>  <?php echo $comp_details[0]['country'];?><br /><p></p>Tel: <?php echo $comp_details[0]['phone'];?><br />Email: <?php echo $comp_details[0]['email'];?>                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-xs-4 border-left">

                        <div class="col-xs-2"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?php echo $reference_no;?></h2>
                                                        <p style="font-weight:bold;">Date: <?= date('d/m/Y H:i', strtotime($date));?></p>
                            <p style="font-weight:bold;">Status: <?php echo ucfirst($status);?></p>
                        </div>
                        <div class="clearfix"></div>


                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped print-table order-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th width="20%">Date</th>
                            <th>Reference No</th>
                            <th style="padding-right:20px;">Amount</th>
                            <th>Paid By</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $query = "SELECT * FROM sma_deposit_payments WHERE transaction_id ='$hiss'";  
						$result = $db_handle->runQuery($query);
						  $sales_view = $db_handle->fetchAssoc($result);
						  $i = 1;
						  if(isset($sales_view) && !empty($sales_view)) { foreach ($sales_view as $row) { 
						  ?>
                            <tr>
                                <td style="text-align:center; width:40px; vertical-align:middle;"><?php echo $i; ?></td>
                                <td style="vertical-align:middle;"><?php echo $row['date']; ?></td>
                                <td style="width: 120px; text-align:center; vertical-align:middle;"><?php echo $row['reference_no']; ?></td>
                                <td style="text-align:right; width:120px; padding-right:10px;"> ₦<?php echo formatMoney($row['amount'],2); ?></td>
                                <td style="text-align:center; width:120px;"> <?php echo ucfirst($row['paid_by']); ?></td>
                            </tr>
                            <?php 
							$i++;
							$totamount +=$row['amount'];
							} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                       </tbody>
                     <?php  //$purch_details = $zentabooks_operation->view_purchase_info_by_id($id); ?>
                        <tfoot>
                           <tr>
                            <td colspan="4" style="text-align:right; font-weight:bold;">Total Amount Paid (NGN) </td>
                            <td style="text-align:right; padding-right:10px; font-weight:bold;"> ₦<?php echo formatMoney($totamount,2); ?></td>
                        </tr>
                            <tr>
                                <td colspan="4" style="text-align:right; font-weight:bold;">Balance (NGN) </td>
                                <td style="text-align:right; padding-right:10px; font-weight:bold;"> ₦<?php echo formatMoney($product_price - $totamount,2); ?></td>
                            </tr>

                        </tfoot>
                    </table>

                </div>

                <div class="row">
                    <div class="col-xs-7">
                                            </div>

                    <div class="col-xs-4 col-xs-offset-1">
                        <div class="well well-sm">
                            <p>Created by                                : <?php
							
							$user_det = $zentabooks_operation->get_user_details($created_by);
							echo $user_det[0]['first_name'],' '. $user_det[0]['last_name'];?></p>

                            <p>Date: <?= date('d/m/Y H:i', strtotime($date));?></p>
                                                    </div>

                    </div>
                </div>

            </div>
        </div>

        
                    <div class="buttons">
                                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/deposit_payments" class="tip btn btn-danger tip" title="View Payments">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs">View Deposit Payments</span>
                        </a>
                    </div>
                    <?php  if ($product_price > $totamount){ ?>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/add_deposit_payment?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-warning tip" title="Add Payment">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs">Add Deposit Payment</span>
                        </a>
                    </div>
                    <?php  } ?>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/email?hissdel=<?=encrypt($row['id']);?>" data-toggle="modal" data-target="#myModal" class="tip btn btn-default tip" title="Email">
                            <i class="fa fa-envelope-o"></i> <span class="hidden-sm hidden-xs">Email</span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/download?hissdel=<?=encrypt($row['id']);?>" class="tip btn btn-primary" title="Download as PDF">
                            <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs">PDF</span>
                        </a>
                    </div>
                     <?php if ($admin_type == 'super-admin'){ ?>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/edit?hissdel=<?=encrypt($row['id']);?>" class="tip btn btn-warning tip" title="Edit">
                            <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">Edit</span>
                        </a>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="tip btn btn-danger bpo" title="<b>Delete Purchase</b>"
                           data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='<?php echo SITE_URL;?>/sales/del_purchases?hissdel=<?=encrypt($row['id']);?>'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>"
                           data-html="true" data-placement="top">
                            <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs">Delete</span>
                        </a>
                        
                    </div>
                      <?php } ?>
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
        $('#deposit_payments').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
