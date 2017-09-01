<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
$id_encrypted = decrypt(str_replace(" ", "+", $id_encrypted));
$hiss = preg_replace("/[^A-Za-z0-9 ]/", '', $id_encrypted);
$product_details = $zentabooks_operation->view_damaged_product_detail($hiss);
extract($product_details);
//print_r($product_details);
$warehouse_qty = $zentabooks_operation->warehouse_qty_for_products();
$list_damaged_products = $zentabooks_operation->damaged_product_list($hiss);

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$name;?> - ZentaBooks</title>
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active"><?=$name;?></li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
    <ul id="myTab" class="nav nav-tabs">
        <li class=""><a href="#details" class="tab-grey">Product Details</a></li>
            </ul>

<div class="tab-content">
    <div id="details" class="tab-pane fade in">
                <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-file-text-o nb"></i><?=$name;?></h2>

                <div class="box-icon">
                    <ul class="btn-tasks">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <i class="icon fa fa-tasks tip" data-placement="left" title="Actions"></i>
                            </a>
                            <ul class="dropdown-menu pull-right tasks-menus" role="menu"
                                aria-labelledby="dLabel">
                                <li>
                                    <a href="<?php echo SITE_URL;?>/products/edit_product?hiss=<?=encrypt($id);?>">
                                        <i class="fa fa-edit"></i> Edit                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SITE_URL;?>/products/print_barcodes/9">
                                        <i class="fa fa-print"></i> Print Barcode/Label                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo SITE_URL;?>/products/pdf/9">
                                        <i class="fa fa-download"></i> PDF                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#" class="bpo" title="<b>Delete Product</b>"
                                        data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='<?php echo SITE_URL;?>/products/delete/9'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>"
                                        data-html="true" data-placement="left">
                                        <i class="fa fa-trash-o"></i> Delete                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="introtext">Product Details</p>

                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?php echo SITE_URL;?>/uploads/products/images/<?=$image;?>"
                                     alt="<?=$name;?>" class="img-responsive img-thumbnail"/>

                                <div id="multiimages" class="padding10">
                                                                        <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped dfTable table-right-left">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" style="background-color:#FFF;"></td>
                                        </tr>
                                       <!-- <tr>
                                            <td style="width:30%;">Barcode &amp; QRcode</td>
                                            <td style="width:70%;">
                                                <img src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9Ijg4IiBoZWlnaHQ9IjY2Ij4KICA8dGl0bGU+QmFyY29kZSBDT0RFMTI4IDIzNDMwMDwvdGl0bGU+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9Ijg3IiBoZWlnaHQ9IjY1IiBmaWxsPSJyZ2IoMjU1LCAyNTUsIDI1NSkiLz4KICA8cG9seWdvbiBwb2ludHM9IjAgMCAwIDY1IDg4IDY1IDg4IDAiIGZpbGw9InJnYigyNTUsIDI1NSwgMjU1KSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTAgMCAxMCA2NiAxMSA2NiAxMSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjExIDAgMTEgNjYgMTIgNjYgMTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMyAwIDEzIDY2IDE0IDY2IDE0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTYgMCAxNiA2NiAxNyA2NiAxNyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE3IDAgMTcgNjYgMTggNjYgMTggMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxOCAwIDE4IDY2IDE5IDY2IDE5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjEgMCAyMSA2NiAyMiA2NiAyMiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIyIDAgMjIgNjYgMjMgNjYgMjMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMyAwIDIzIDY2IDI0IDY2IDI0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjUgMCAyNSA2NiAyNiA2NiAyNiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjI2IDAgMjYgNjYgMjcgNjYgMjcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyOCAwIDI4IDY2IDI5IDY2IDI5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjkgMCAyOSA2NiAzMCA2NiAzMCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjMwIDAgMzAgNjYgMzEgNjYgMzEgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIzMiAwIDMyIDY2IDMzIDY2IDMzIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMzQgMCAzNCA2NiAzNSA2NiAzNSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjM1IDAgMzUgNjYgMzYgNjYgMzYgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIzOSAwIDM5IDY2IDQwIDY2IDQwIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNDAgMCA0MCA2NiA0MSA2NiA0MSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjQxIDAgNDEgNjYgNDIgNjYgNDIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI0MyAwIDQzIDY2IDQ0IDY2IDQ0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNDQgMCA0NCA2NiA0NSA2NiA0NSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjQ2IDAgNDYgNjYgNDcgNjYgNDcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI0NyAwIDQ3IDY2IDQ4IDY2IDQ4IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNTAgMCA1MCA2NiA1MSA2NiA1MSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjUxIDAgNTEgNjYgNTIgNjYgNTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI1NCAwIDU0IDY2IDU1IDY2IDU1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNTggMCA1OCA2NiA1OSA2NiA1OSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjU5IDAgNTkgNjYgNjAgNjYgNjAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI2MiAwIDYyIDY2IDYzIDY2IDYzIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNjUgMCA2NSA2NiA2NiA2NiA2NiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjY2IDAgNjYgNjYgNjcgNjYgNjcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI3MCAwIDcwIDY2IDcxIDY2IDcxIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNzEgMCA3MSA2NiA3MiA2NiA3MiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjcyIDAgNzIgNjYgNzMgNjYgNzMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI3NCAwIDc0IDY2IDc1IDY2IDc1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNzYgMCA3NiA2NiA3NyA2NiA3NyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9Ijc3IDAgNzcgNjYgNzggNjYgNzggMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+Cjwvc3ZnPgo=' alt='234300' class='bcimg' />                                                <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFIAAABSAQMAAAD94hHYAAAABlBMVEUAAAD///+l2Z/dAAABQ0lEQVQokWXSMYpFMQgFUCFtwK0ItoJbF2wD2UrANuD4Zop5/p80pwjG3AgwxDGNCWq9rMHqAcHZTYyUewuPT2cCU8SX9wmdiz+sIZlOGNkNg3/XXz//zlQHwatpzaeK5bzbDjTn9D3BiaIbgX0F5M5uQc17JGV2w0C5GXObNS+FNLcQhObBy3me6WrNFdNCWRcUms9YdIhgHmveOSjqGn/Ov+2imbiDrXsO4XB4sn07TaY9+YI1j2tqHgcuNIuNTVVA3ZoZA4fGtehWPxXfWrmgWZbXJCEhdie4HiOn5x9fHulR6RI8Gb5Mfs0RL1UPb9ffyw3iNbqZNsQOJ/tw1viJjqiazTUak3RDZfJ2Ju2FW/Tp+WUYxluBeVizxpkzUVShuS5a7ifgyyh7HZn19g+zspFJt0ZN2ZKq2g1jRe11tPkHUlSf5A0BxwYAAAAASUVORK5CYII=' alt='<?php echo SITE_URL;?>/products/view/9' class='qrimg' style='float:right;' />                                            </td>
                                        </tr>-->
                                        <tr>
                                            <td>Type</td>
                                            <td>Standard</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?= $name;?></td>
                                        </tr>
                                        <tr>
                                            <td>Code</td>
                                            <td><?= $code;?></td>
                                        </tr>
                                        <tr>
                                            <td>Brand</td>
                                            <td><?= $brand;?></td>
                                        </tr>
                                        <tr>
                                            <td>Category</td>
                                            <td><?= $category;?></td>
                                        </tr>
                                                                                <tr>
                                            <td>Unit</td>
                                            <td><?= $piece;?></td>
                                        </tr>                                                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            

                            <div class="col-sm-12">

                                                                
                            </div>
                        </div>

                                                <div class="buttons">
                            <div class="btn-group btn-group-justified">
                                <div class="btn-group">
                                    <a href="<?php echo SITE_URL;?>/products/print_barcode?hissdel=<?=encrypt($code);?>" class="tip btn btn-primary" title="Print Barcode/Label">
                                        <i class="fa fa-print"></i>
                                        <span class="hidden-sm hidden-xs">Print Barcode/Label</span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="<?php echo SITE_URL;?>/products/pdf/9" class="tip btn btn-primary" title="PDF">
                                        <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs">PDF</span>
                                    </a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="tip btn btn-danger bpo" title="<b>Delete Product</b>"
                                        data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='<?php echo SITE_URL;?>/products/delete_damaged_prod?hissdel=<?=encrypt($hiss);?>'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>"
                                        data-html="true" data-placement="top">
                                        <i class="fa fa-trash-o"></i> <span class="hidden-sm hidden-xs">Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.tip').tooltip();
            });
        </script>
    
            </div>
    
    
    
    
    

</div>

    <script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/html2canvas.min.js"></script>
<div class="clearfix"></div>
</div></div></div></td></tr></table></div></div><div class="clearfix"></div>
<footer>
<a href="#" id="toTop" class="blue" style="position: fixed; bottom: 30px; right: 30px; font-size: 30px; display: none;">
    <i class="fa fa-chevron-circle-up"></i>
</a>

    <p style="text-align:center;">&copy; 2017 DeNobelAS 
      - Page rendered in <strong>2.9342</strong> seconds</p>
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
        $('#products_view').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
$(document).ready(function() {
    $('#hidden-table-info').DataTable( {
        order: [[ 0, 'desc' ], [ 1, 'desc' ]]
    } );
} );	
</script>
</body>
</html>
