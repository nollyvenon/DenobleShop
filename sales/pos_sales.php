<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$hiss = $_GET['hiss'];
$mywarehouse = $zentabooks_operation->get_warehouse_name_by_id($hiss);
if(isset($_POST['search_text']) && strlen($_POST['search_text']) > 3) {
    $search_text = $_POST['search_text'];
	$query = "SELECT us.*, b.name as brand_name, c.name as category_name
                FROM sma_sales AS us
                LEFT JOIN sma_brands AS b ON us.brand = b.id
				LEFT JOIN sma_categories AS c ON us.category_id = c.id WHERE us.name LIKE '%$search_text%' OR us.customer LIKE '%$search_text%' OR us.biller LIKE '%$search_text%' OR us.reference_no LIKE '%$search_text%') ORDER BY us.id DESC ";
} else {
	$query = "SELECT us.*
                FROM sma_sales AS us
				LEFT JOIN sma_companies AS comp ON us.customer_id = comp.id  WHERE us.pos='1'
				ORDER BY us.id DESC ";
}
/*$numrows = $db_handle->numRows($query);

// For search, make rows per page equal total rows found, meaning, no pagination
// for search results
if (isset($_POST['search_text'])) {
    $rowsperpage = $numrows;
} else {
    $rowsperpage = 20;
}

$totalpages = ceil($numrows / $rowsperpage);
// get the current page or set a default
if (isset($_GET['pg']) && is_numeric($_GET['pg'])) {
   $currentpage = (int) $_GET['pg'];
} else {
   $currentpage = 1;
}
if ($currentpage > $totalpages) { $currentpage = $totalpages; }
if ($currentpage < 1) { $currentpage = 1; }

$prespagelow = $currentpage * $rowsperpage - $rowsperpage + 1;
$prespagehigh = $currentpage * $rowsperpage;
if($prespagehigh > $numrows) { $prespagehigh = $numrows; }

$offset = ($currentpage - 1) * $rowsperpage;
$query .= 'LIMIT ' . $offset . ',' . $rowsperpage;*/
$result = $db_handle->runQuery($query);
$sales_list = $db_handle->fetchAssoc($result);

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
                class="fa-fw fa fa-barcode"></i>POS Sales <?php if($hiss == ""){?> (All Warehouses) <?php }else{ echo '('.$mywarehouse.')';}?>        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-tasks tip"  data-placement="left" title="Actions"></i></a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li><a href="http://localhost/stockfeb2017/pos"><i class="fa fa-plus-circle"></i> Add Sale</a></li>
                        <li><a href="#" id="excel" data-action="export_excel"><i class="fa fa-file-excel-o"></i> Export to Excel file</a></li>
                        <li><a href="#" id="pdf" data-action="export_pdf"><i class="fa fa-file-pdf-o"></i> Export to PDF file</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="bpo" title="<b>Delete Sales</b>" data-content="<p>Are you sure?</p><button type='button' class='btn btn-danger' id='delete' data-action='delete'>Yes I'm sure</a> <button class='btn bpo-close'>No</button>" data-html="true" data-placement="left"><i class="fa fa-trash-o"></i> Delete Sales</a></li>
                    </ul>
                </li>
                                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="Warehouses"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="http://localhost/stockfeb2017/pos/sales"><i class="fa fa-building-o"></i> All Warehouses</a></li>
                            <li class="divider"></li>
                            <li><a href="http://localhost/stockfeb2017/pos/sales/1"><i class="fa fa-building"></i>Warehouse 1</a></li><li><a href="http://localhost/stockfeb2017/pos/sales/2"><i class="fa fa-building"></i>Warehouse 2</a></li><li><a href="http://localhost/stockfeb2017/pos/sales/3"><i class="fa fa-building"></i>Warehouse 3</a></li>                        </ul>
                    </li>
                            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Please use the table below to navigate or filter the results. You can download the table as excel and pdf.</p>

                <div class="table-responsive">
                    <table id="POSData" class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th>Date</th>
                            <th>Reference No</th>
                            <th>Biller</th>
                            <th>Customer</th>
                            <th>Grand Total</th>
                            <th>Paid</th>
                            <th>Balance</th>
                            <th>Sale Status</th>
                            <th>Payment Status</th>
                            <th style="width:80px; text-align:center;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="10" class="dataTables_empty">Loading table data from server</td>
                        </tr>
                        </tbody>
                        <<tbody>
							<?php if(isset($sales_list) && !empty($sales_list)) { foreach ($sales_list as $row) { ?>
                            <tr>
                                <td><input class="checkbox multi-select" type="checkbox" name="check"/></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['reference_no']; ?></td>
                                <td><?php echo $row['biller']; ?></td>
                                <td><?php echo $row['customer']; ?></td>
                                <td><?php echo number_format($row['grand_total'],2); ?></td>
                                <td><?php echo number_format($row['paid'],2); ?></td>
                                <td><?php echo number_format($row['grand_total'] - $row['paid'],2); ?></td>
                                <td><?php echo $row['payment_status']; ?></td>
                              	<td></td>
                              <td><div class="dropdown">
  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions  
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="<?php echo SITE_URL;?>/sales/view/<?php echo $row['id']; ?>" ><i class="fa fa-file-excel-o"></i>Sales Details </a> </li>
    <li><a href="sales/add/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> Duplicate Sale</a></li>
    <li><a href="sales/payments/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> View Payments</a></li>
    <li><a href="sales/add_payment/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> View Payments</a></li>
    <li><a href="sales/add_delivery/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> Add Delivery</a></li>
    <li><a href="sales/edit/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> Edit Sale</a></li>
    <li><a href="sales/download/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> Download AS PDF</a></li>
    <li><a href="sales/email/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> EMail Sale</a></li>
    <li><a href="sales/return_sale/<?php echo $row['id']; ?>"><i class="fa fa-plus-square"></i> Return Sale</a></li>
    
    
    <li><a href="#" class="po" title="<b>Delete</b>"
                                           data-content='<div style="width:150px;"><p>Are you sure?</p><a class="btn btn-danger" id="<?= $row['id'] ?>" href="sales/del_sales/<?=$row['id']; ?>">Yes I am Sure</a> <button class="btn po-close">No</button></div>'
                                           data-html="true"  data-placement="top"><i class='fa fa-trash-o'></i> Delete Sales</a>
                                           
                            <a href="#" class="bpo"
                            title="<b>Delete Sales</b>"
                            data-content="<p>Are you sure?</p><button type='button' class='btn btn-danger' id='delete' data-action='delete'>Yes I'm sure</a> <button class='btn bpo-close'>No</button>"
                            data-html="true"  data-placement="top" data-placement="left">
                            <i class="fa fa-trash-o"></i> Delete Sales                        </a>
                    </li>
                    
  </ul>
</div></td>
                            </tr>
                            <?php } } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                        </tbody>
                    </table>
                </div>
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
