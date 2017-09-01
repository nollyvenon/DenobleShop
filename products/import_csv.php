<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
if (!contains( '139',$allowed_pages)) {
	 $message_error .= "You do not have right to that page or feature. Regards.";
	redirect_to("../dashboard?msg=10");
 }


if (isset($_POST['import']) ) {	  
	    //get the csv file
    $file = $_FILES[userfile][tmp_name];
    $handle = fopen($file,"r");
    
    //loop through the csv file and insert into database
    do {
        if ($data[0]) {
            mysqli_query("INSERT INTO sma_products (name, code, barcode_symbology, brand, category_id, unit, sale_unit, purchase_unit, cost, price, alert_quantity, tax_rate, tax_method, image, subcategory_id,cf1,cf2,cf3,cf4,cf5,cf6) VALUES
                (
                    '".addslashes($data[0])."',
                    '".addslashes($data[1])."',
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."',
                    '".addslashes($data[4])."',
                    '".addslashes($data[5])."',
                    '".addslashes($data[6])."',
                    '".addslashes($data[7])."',
                    '".addslashes($data[8])."',
                    '".addslashes($data[9])."',
                    '".addslashes($data[10])."',
                    '".addslashes($data[11])."',
                    '".addslashes($data[12])."',
                    '".addslashes($data[13])."',
                    '".addslashes($data[14])."',
                    '".addslashes($data[15])."',
                    '".addslashes($data[16])."',
                    '".addslashes($data[17])."',
                    '".addslashes($data[18])."',
                    '".addslashes($data[19])."',
                    '".addslashes($data[20])."'
                )
            ");
        }
    } while ($data = fgetcsv($handle,1000,",","'"));

	$message_success = "You have successfully uploaded the product";
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS.'/images/icon.png';?>"/>
    <link href="<?php echo SITE_ASSETS.'/styles/theme.css';?>" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/products">Products</a></li><li class="active">Add Product by CSV </li>                            <li class="right_log hidden-xs">
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
                class="fa-fw fa fa-barcode"></i>Add Product by CSV        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                            </ul>
                            
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
            		<?php include '../layouts/feedback_message.php';?>
                		<div class="well well-small">
                            <a href="<?php echo SITE_URL;?>/uploads/products/sample/sample_products.csv"
                               class="btn btn-primary pull-right"><i
                                    class="fa fa-download"></i> Download Sample File</a>
                            <span class="text-warning">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span><br/>The correct column order is <span
                                class="text-info">(Name, Code, Barcode Symbology, Brand, Category Code, Unit Code, Sale Unit Code, Purchase Unit Code, Cost, Price, Alert Quantity, Tax, Tax Method, Image, Sub category Code, Product Variants separated by vertical bar <strong>|</strong> , Product Custom Field 1, Product Custom Field 2, Product Custom Field 3, Product Custom Field 4, Product Custom Field 5, Product Custom Field 6                                )</span> &amp; you must follow this.<br>Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).                                <p>The images should be uploaded in <strong>uploads</strong> folder.</p>

                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="csv_file">Upload File</label>
                                <input type="file" data-browse-label="Browse ..." name="userfile" class="form-control file" data-show-upload="false" data-show-preview="false" id="csv_file" required="required"/>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="import" value="Import"  class="btn btn-primary" />
                            </div>
                        </div>
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
var site = {"base_url":"http:\/\/localhost\/stockfeb2017\/","settings":{"logo":"logo41.png","logo2":"logo42.png"}};
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
<script type="text/javascript" charset="UTF-8">
    $(window).load(function () {
        $('.mm_products').addClass('active');
        $('.mm_products').find("ul").first().slideToggle();
        $('#products_import_csv').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
