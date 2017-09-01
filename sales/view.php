<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
if (!contains( '10',$allowed_pages)) {
	 $message_error .= "You do not have right to that page or feature. Regards.";
	redirect_to("../dashboard?msg=10");
 }
$storereq_operation = new storerequestOperation();
$id_encrypted = $db_handle->sanitizePost($_GET['hiss']);
$hiss = decrypt(str_replace(" ", "+", $id_encrypted));
$req_details = $zentabooks_operation->view_sales_info_by_id($hiss);
extract($req_details);
$settings = $zentabooks_operation->get_settings();
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sale Details - ZentaBooks</title>
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/sales">Sales</a></li><li class="active">View</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.sledit', function (e) {
            if (localStorage.getItem('slitems')) {
                e.preventDefault();
                var href = $(this).attr('href');
                bootbox.confirm("You will loss current sale data. Do you want to proceed?", function (result) {
                    if (result) {
                        window.location.href = href;
                    }
                });
            }
        });
    });
</script>
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-file"></i>Sale Number 14</h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="Actions">
                        </i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                                                <li>
                            <a href="<?php echo SITE_URL;?>/sales/edit?hissdel=<?=encrypt($hiss);?>" class="sledit">
                                <i class="fa fa-edit"></i> Edit Sale                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/payments?hissdel=<?=encrypt($hiss);?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-money"></i> View Payments                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/add_payment?hissdel=<?=encrypt($hiss);?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-dollar"></i> Add Payment                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/email?hissdel=<?=encrypt($hiss);?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-envelope-o"></i> Send Email                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/pdf?hissdel=<?=encrypt($hiss);?>">
                                <i class="fa fa-file-pdf-o"></i> Export to PDF file                            </a>
                        </li>
                                                <li>
                            <a href="<?php echo SITE_URL;?>/sales/add_delivery?hissdel=<?=encrypt($hiss);?>" data-target="#myModal" data-toggle="modal">
                                <i class="fa fa-truck"></i> Add Delivery                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_URL;?>/sales/return_sale?hissdel=<?=encrypt($hiss);?>">
                                <i class="fa fa-angle-double-left"></i> Return Sale                            </a>
                        </li>
                                            </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                                <div class="print-only col-xs-12">
                    <img src="<?php echo SITE_URL;?>/assets/uploads/logos/logo41.png" alt="DeNoble Awka">
                </div>
                <div class="well well-sm">

                    <div class="col-xs-4 border-right">

                        <div class="col-xs-2"><i class="fa fa-3x fa-user padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class=""><?php
							 $cust_det = $zentabooks_operation->get_company_user_details($customer_id)[0];
							echo $cust_det['company'];?></h2>
                            
                            <?php echo $cust_det['address'];?><br><?php echo $cust_det['city'];?>  <?php echo $cust_det['state'];?><br><br><p><!--VAT Number: 3333333</p>-->Tel: <?php echo $cust_det['phone'];?><br>Email: <?php echo $cust_det['email'];?>                       </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-xs-4 border-right">

                        <div class="col-xs-2"><i class="fa fa-3x fa-building padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class="">DeNoble Awka</h2>
                            <h2 class=""><?php
							 $biller_det = $zentabooks_operation->get_company_user_details($biller_id)[0];
							echo $biller_det['company'];?></h2>
                            
                            <?php echo $biller_det['address'];?><br><?php echo $biller_det['city'];?>  <?php echo $biller_det['state'];?><br><br><p><!--VAT Number: 3333333</p>-->Tel: <?php echo $biller_det['phone'];?><br>Email: <?php echo $biller_det['email'];?>                       </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="col-xs-4">
                        <div class="col-xs-2"><i class="fa fa-3x fa-building-o padding010 text-muted"></i></div>
                        <div class="col-xs-10">
                            <h2 class="">ZentaBooks</h2>
                            
                            <br>                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                                <div class="clearfix"></div>
                <div class="col-xs-7 pull-right">
                    <div class="col-xs-12 text-right order_barcodes">
                        <img src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgd2lkdGg9IjIzMSIgaGVpZ2h0PSI2NiI+CiAgPHRpdGxlPkJhcmNvZGUgQ09ERTEyOCBTQUxFLzIwMTcvMDYvMDAwMTwvdGl0bGU+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjIzMCIgaGVpZ2h0PSI2NSIgZmlsbD0icmdiKDI1NSwgMjU1LCAyNTUpIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIwIDAgMCA2NSAyMzEgNjUgMjMxIDAiIGZpbGw9InJnYigyNTUsIDI1NSwgMjU1KSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTAgMCAxMCA2NiAxMSA2NiAxMSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjExIDAgMTEgNjYgMTIgNjYgMTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMyAwIDEzIDY2IDE0IDY2IDE0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTYgMCAxNiA2NiAxNyA2NiAxNyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIxIDAgMjEgNjYgMjIgNjYgMjIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMiAwIDIyIDY2IDIzIDY2IDIzIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjQgMCAyNCA2NiAyNSA2NiAyNSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjI1IDAgMjUgNjYgMjYgNjYgMjYgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyNiAwIDI2IDY2IDI3IDY2IDI3IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjggMCAyOCA2NiAyOSA2NiAyOSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjMyIDAgMzIgNjYgMzMgNjYgMzMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIzNCAwIDM0IDY2IDM1IDY2IDM1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMzggMCAzOCA2NiAzOSA2NiAzOSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjM5IDAgMzkgNjYgNDAgNjYgNDAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI0MyAwIDQzIDY2IDQ0IDY2IDQ0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNDcgMCA0NyA2NiA0OCA2NiA0OCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjQ4IDAgNDggNjYgNDkgNjYgNDkgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI1MCAwIDUwIDY2IDUxIDY2IDUxIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNTEgMCA1MSA2NiA1MiA2NiA1MiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjUyIDAgNTIgNjYgNTMgNjYgNTMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI1NCAwIDU0IDY2IDU1IDY2IDU1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNTggMCA1OCA2NiA1OSA2NiA1OSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjU5IDAgNTkgNjYgNjAgNjYgNjAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI2MSAwIDYxIDY2IDYyIDY2IDYyIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNjUgMCA2NSA2NiA2NiA2NiA2NiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjY3IDAgNjcgNjYgNjggNjYgNjggMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI2OCAwIDY4IDY2IDY5IDY2IDY5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNjkgMCA2OSA2NiA3MCA2NiA3MCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjcyIDAgNzIgNjYgNzMgNjYgNzMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI3MyAwIDczIDY2IDc0IDY2IDc0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iNzYgMCA3NiA2NiA3NyA2NiA3NyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9Ijc4IDAgNzggNjYgNzkgNjYgNzkgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI3OSAwIDc5IDY2IDgwIDY2IDgwIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iODAgMCA4MCA2NiA4MSA2NiA4MSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjgyIDAgODIgNjYgODMgNjYgODMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI4MyAwIDgzIDY2IDg0IDY2IDg0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iODQgMCA4NCA2NiA4NSA2NiA4NSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9Ijg1IDAgODUgNjYgODYgNjYgODYgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI4NyAwIDg3IDY2IDg4IDY2IDg4IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iODggMCA4OCA2NiA4OSA2NiA4OSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjkxIDAgOTEgNjYgOTIgNjYgOTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI5NCAwIDk0IDY2IDk1IDY2IDk1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iOTUgMCA5NSA2NiA5NiA2NiA5NiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9Ijk2IDAgOTYgNjYgOTcgNjYgOTcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSI5OCAwIDk4IDY2IDk5IDY2IDk5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTAxIDAgMTAxIDY2IDEwMiA2NiAxMDIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMDIgMCAxMDIgNjYgMTAzIDY2IDEwMyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEwMyAwIDEwMyA2NiAxMDQgNjYgMTA0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTA2IDAgMTA2IDY2IDEwNyA2NiAxMDcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMDcgMCAxMDcgNjYgMTA4IDY2IDEwOCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEwOSAwIDEwOSA2NiAxMTAgNjYgMTEwIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTExIDAgMTExIDY2IDExMiA2NiAxMTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMTIgMCAxMTIgNjYgMTEzIDY2IDExMyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjExMyAwIDExMyA2NiAxMTQgNjYgMTE0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTE0IDAgMTE0IDY2IDExNSA2NiAxMTUgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMTYgMCAxMTYgNjYgMTE3IDY2IDExNyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjExNyAwIDExNyA2NiAxMTggNjYgMTE4IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTE4IDAgMTE4IDY2IDExOSA2NiAxMTkgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMjAgMCAxMjAgNjYgMTIxIDY2IDEyMSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEyMiAwIDEyMiA2NiAxMjMgNjYgMTIzIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTIzIDAgMTIzIDY2IDEyNCA2NiAxMjQgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMjQgMCAxMjQgNjYgMTI1IDY2IDEyNSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEyNyAwIDEyNyA2NiAxMjggNjYgMTI4IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTI4IDAgMTI4IDY2IDEyOSA2NiAxMjkgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMzEgMCAxMzEgNjYgMTMyIDY2IDEzMiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEzNCAwIDEzNCA2NiAxMzUgNjYgMTM1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTM1IDAgMTM1IDY2IDEzNiA2NiAxMzYgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxMzYgMCAxMzYgNjYgMTM3IDY2IDEzNyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjEzOCAwIDEzOCA2NiAxMzkgNjYgMTM5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTM5IDAgMTM5IDY2IDE0MCA2NiAxNDAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNDIgMCAxNDIgNjYgMTQzIDY2IDE0MyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE0MyAwIDE0MyA2NiAxNDQgNjYgMTQ0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTQ2IDAgMTQ2IDY2IDE0NyA2NiAxNDcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNDcgMCAxNDcgNjYgMTQ4IDY2IDE0OCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE0OCAwIDE0OCA2NiAxNDkgNjYgMTQ5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTUwIDAgMTUwIDY2IDE1MSA2NiAxNTEgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNTMgMCAxNTMgNjYgMTU0IDY2IDE1NCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE1NSAwIDE1NSA2NiAxNTYgNjYgMTU2IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTU2IDAgMTU2IDY2IDE1NyA2NiAxNTcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNTcgMCAxNTcgNjYgMTU4IDY2IDE1OCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE2MCAwIDE2MCA2NiAxNjEgNjYgMTYxIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTYxIDAgMTYxIDY2IDE2MiA2NiAxNjIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNjQgMCAxNjQgNjYgMTY1IDY2IDE2NSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE2NiAwIDE2NiA2NiAxNjcgNjYgMTY3IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTY3IDAgMTY3IDY2IDE2OCA2NiAxNjggMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNjggMCAxNjggNjYgMTY5IDY2IDE2OSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE3MCAwIDE3MCA2NiAxNzEgNjYgMTcxIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTcxIDAgMTcxIDY2IDE3MiA2NiAxNzIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNzIgMCAxNzIgNjYgMTczIDY2IDE3MyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE3MyAwIDE3MyA2NiAxNzQgNjYgMTc0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTc1IDAgMTc1IDY2IDE3NiA2NiAxNzYgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxNzYgMCAxNzYgNjYgMTc3IDY2IDE3NyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE3OCAwIDE3OCA2NiAxNzkgNjYgMTc5IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTc5IDAgMTc5IDY2IDE4MCA2NiAxODAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxODIgMCAxODIgNjYgMTgzIDY2IDE4MyAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE4MyAwIDE4MyA2NiAxODQgNjYgMTg0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTg2IDAgMTg2IDY2IDE4NyA2NiAxODcgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxODcgMCAxODcgNjYgMTg4IDY2IDE4OCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE5MCAwIDE5MCA2NiAxOTEgNjYgMTkxIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTkxIDAgMTkxIDY2IDE5MiA2NiAxOTIgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxOTMgMCAxOTMgNjYgMTk0IDY2IDE5NCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjE5NCAwIDE5NCA2NiAxOTUgNjYgMTk1IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMTk3IDAgMTk3IDY2IDE5OCA2NiAxOTggMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIxOTggMCAxOTggNjYgMTk5IDY2IDE5OSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIwMSAwIDIwMSA2NiAyMDIgNjYgMjAyIDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjAyIDAgMjAyIDY2IDIwMyA2NiAyMDMgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMDQgMCAyMDQgNjYgMjA1IDY2IDIwNSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIwNSAwIDIwNSA2NiAyMDYgNjYgMjA2IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjA4IDAgMjA4IDY2IDIwOSA2NiAyMDkgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMDkgMCAyMDkgNjYgMjEwIDY2IDIxMCAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIxMyAwIDIxMyA2NiAyMTQgNjYgMjE0IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjE0IDAgMjE0IDY2IDIxNSA2NiAyMTUgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMTUgMCAyMTUgNjYgMjE2IDY2IDIxNiAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KICA8cG9seWdvbiBwb2ludHM9IjIxNyAwIDIxNyA2NiAyMTggNjYgMjE4IDAiIGZpbGw9InJnYigwLCAwLCAwKSIvPgogIDxwb2x5Z29uIHBvaW50cz0iMjE5IDAgMjE5IDY2IDIyMCA2NiAyMjAgMCIgZmlsbD0icmdiKDAsIDAsIDApIi8+CiAgPHBvbHlnb24gcG9pbnRzPSIyMjAgMCAyMjAgNjYgMjIxIDY2IDIyMSAwIiBmaWxsPSJyZ2IoMCwgMCwgMCkiLz4KPC9zdmc+Cg==' alt='SALE/2017/06/0001' class='bcimg' />                        <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEoAAABKAQMAAAAmHlAyAAAABlBMVEUAAAD///+l2Z/dAAABFUlEQVQokWXSwQoEIQgGYMFr0KsIXgNfXfAq9CpB18B1WNi13ZjDB9P8TiYACh5kglxfyhbv7hwXKd8F740/1BNn/HFO0803ZQ9vU9+5HwLys97/8GHE2JJPaOXioXsYLKjszdRBm+hFtBaddoYVakO3Fbz04iKBzJsX7awDcdwuHnM8StygUjwMTOa52LJ9BAp8sTdxF2lbK/ee3GejDCv07LOtDeNifkiKuFArWfKkyicLF3bMOHG0i9GFaPf29PdLNRz8XCBUDifKtMgNhbxOZ7GsUEmNcCiPo5VM0Z87EaiM6Gd7E9FKwEBhe5paKNtm6JKhlTmI85kLhpuo1IXhh0CBfuZF2ZpBDeIiYNYQzckofAGwmUNESQwCVgAAAABJRU5ErkJggg==' alt='<?php echo SITE_URL;?>/sales/view/14' class='qrimg' style='float:right;' />                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="col-xs-5">
                    <div class="col-xs-2"><i class="fa fa-3x fa-file-text-o padding010 text-muted"></i></div>
                    <div class="col-xs-10">
                        <h2 class="">Reference: <?= $reference_no;?></h2>
                        
                        <p style="font-weight:bold;">Date: <?= date('d/m/Y H:i',strtotime($date));?></p>

                        <p style="font-weight:bold;">Sale Status:  <?= $reference_no;?></p>

                        <p style="font-weight:bold;">Payment Status                            : <?= ucfirst($payment_status);?></p>

                        <p>&nbsp;</p>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="clearfix"></div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped print-table order-table">

                        <thead>

                        <tr>
                            <th>No</th>
                            <th>Description (Code)</th>
                            <th>Quantity</th>
                            <th style="text-align:center; vertical-align:middle;">Serial No</th>                            
                            <th style="padding-right:20px;">Unit Price</th>
                                                        <th style="padding-right:20px;">Subtotal</th>
                        </tr>

                        </thead>

                        <tbody>
                        <?php $query = "SELECT * FROM sma_sale_items WHERE sale_id ='$hiss'";  
						$result = $db_handle->runQuery($query);
						  $purchase_view = $db_handle->fetchAssoc($result);
						  $i = 1;
						  if(isset($purchase_view) && !empty($purchase_view)) { foreach ($purchase_view as $row) { 
						  ?>
                             <tr>
                                <td style="text-align:center; width:40px; vertical-align:middle;"><?php echo $i; ?></td>
                                <td style="vertical-align:middle;"> <?php echo $row['product_code'].' - '. $row['product_name']; ?></td>
                                <td style="width: 100px; text-align:center; vertical-align:middle;"><?php echo $row['quantity'].' '.$row['product_unit_code']; ?></td>
                                <td></td>                                
                                <td style="text-align:right; width:120px; padding-right:10px;">  ₦<?php echo formatMoney($row['net_unit_price'],2); ?></td>
                                                                <td style="text-align:right; width:120px; padding-right:10px;">  ₦<?php echo formatMoney($row['net_unit_price']*$row['quantity'],2); ?></td>
                            </tr>
                            <?php 
							$i++;
							} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>

                                                    </tbody>
						<?php  $sale_details = $zentabooks_operation->view_sales_info_by_id($id); ?>                                                    
                        <tfoot>
                                                                                                                                                                        <tr>
                            <td colspan="5"
                                style="text-align:right; font-weight:bold;">Total Amount                                (NGN)
                            </td>
                            <td style="text-align:right; padding-right:10px; font-weight:bold;"> ₦<?php echo formatMoney($sale_details['grand_total'],2); ?></td>
                        </tr>
                        <tr>
                            <td colspan="5"
                                style="text-align:right; font-weight:bold;">Paid                                (NGN)
                            </td>
                            <td style="text-align:right; font-weight:bold;"> ₦<?php echo formatMoney($sale_details['paid'],2);?></td>
                        </tr>
                        <tr>
                            <td colspan="5"
                                style="text-align:right; font-weight:bold;">Balance                                (NGN)
                            </td>
                            <td style="text-align:right; font-weight:bold;"> ₦<?php echo formatMoney($sale_details['grand_total'] - $sale_details['paid'],2);?></td>
                        </tr>

                        </tfoot>
                    </table>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        
                                            </div>

                    <div class="col-xs-6">
                                                <div class="well well-sm">
                            <p>Created by                                : <?php
							
							$user_det = $zentabooks_operation->get_user_details($created_by);
							echo $user_det[0]['first_name'],' '. $user_det[0]['last_name'];?></p>

                            <p>Date: <?= date('d/m/Y H:i', strtotime($date));?></p>
                                                    </div>
                    </div>
                </div>

                                                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="hidden-table-info" class="table table-bordered table-striped table-condensed print-table">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Payment Reference</th>
                                        <th>Paid by</th>
                                        <th>Amount</th>
                                        <th>Created by</th>
                                        <th>Type</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   <?php $query = "SELECT * FROM sma_payments WHERE sale_id ='$hiss'";  
						$result = $db_handle->runQuery($query);
						  $pay_view = $db_handle->fetchAssoc($result);
						  $i = 1;
						  if(isset($pay_view) && !empty($pay_view)) { foreach ($pay_view as $row1) { 
						  ?>
                          		     <tr >
                                            <td><?php echo date('d/m/Y H:i',strtotime($row1['date']));?></td>
                                            <td> <?= $row1['reference_no'];?></td>
                                            <td> <?= ucfirst($row1['paid_by']);?></td>
                                            <td align="right"> ₦<?= formatMoney($row1['amount'],2);?></td>
                                            <td><?php
							
							$user_det = $zentabooks_operation->get_user_details($row1['created_by']);
							echo $user_det[0]['first_name'],' '. $user_det[0]['last_name'];?></td>
                                            <td align="center"><a href="" class="btn btn-warning btn-xs"><?= ucfirst($row1['type']);?></a></td>
                                        </tr>
                           <?php 
							$i++;
							} } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                                                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                            </div>
        </div>
                    <div class="buttons">
                <div class="btn-group btn-group-justified">
                     <?php if (contains( '17',$allowed_pages)) { ?><div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/payments?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-primary tip" title="View Payments">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs">View Payments</span>
                        </a>
                    </div>
                    <?php if ($amount > $paid){ ?>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/add_payment?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-primary tip" title="Add Payment">
                            <i class="fa fa-money"></i> <span class="hidden-sm hidden-xs">Add Payment</span>
                        </a>
                    </div>
                    <?php } } ?>
                    <?php if (contains( '14',$allowed_pages)) { ?><div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/email?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-primary tip" title="Email">
                            <i class="fa fa-envelope-o"></i> <span class="hidden-sm hidden-xs">Email</span>
                        </a>
                    </div> <?php } ?>
                   <?php if (contains( '15',$allowed_pages)) { ?><div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/pdf?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-primary" title="Download as PDF">
                            <i class="fa fa-download"></i> <span class="hidden-sm hidden-xs">PDF</span>
                        </a>
                    </div><?php } ?>
                    <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/add_delivery?hissdel=<?=encrypt($hiss);?>" data-toggle="modal" data-target="#myModal" class="tip btn btn-primary tip" title="Add Delivery">
                            <i class="fa fa-truck"></i> <span class="hidden-sm hidden-xs">Add Delivery</span>
                        </a>
                    </div>
                     <?php if (contains( '12',$allowed_pages)) { ?>
                   <div class="btn-group">
                        <a href="<?php echo SITE_URL;?>/sales/edit?hissdel=<?=encrypt($hiss);?>" class="tip btn btn-warning tip sledit" title="Edit">
                            <i class="fa fa-edit"></i> <span class="hidden-sm hidden-xs">Edit</span>
                        </a>
                    </div> <?php } ?>
                    <?php if (contains( '13',$allowed_pages)) { ?><div class="btn-group">
                        <a href="#" class="tip btn btn-danger bpo"
                            title="<b>Delete Sale</b>"
                            data-content="<div style='width:150px;'><p>Are you sure?</p><a class='btn btn-danger' href='<?php echo SITE_URL;?>/sales/delete/14'>Yes I'm sure</a> <button class='btn bpo-close'>No</button></div>"
                            data-html="true" data-placement="top"><i class="fa fa-trash-o"></i> 
                            <span class="hidden-sm hidden-xs">Delete</span>
                        </a>
                    </div>
                    <?php } ?>
                                        <!--<div class="btn-group"><a href="<?php echo SITE_URL;?>/sales/excel/14" class="tip btn btn-primary"  title="Download as Excel"><i class="fa fa-download"></i> Excel</a></div>-->
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
      - Page rendered in <strong>2.8492</strong> seconds</p>
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
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery.dataTables.dtFilter.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/custom.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery.calculator.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/core.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/perfect-scrollbar.min.js"></script>

<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
    $(window).load(function () {
        $('.mm_sales').addClass('active');
        $('.mm_sales').find("ul").first().slideToggle();
        $('#sales_view').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
$(document).ready(function() {
    $('#hidden-table-info').DataTable( {
        order: [[ 0, 'desc' ], [ 1, 'desc' ]]
    } );
} );	
</script></body>
</html>
