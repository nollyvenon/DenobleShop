<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$hiss = $_GET['hiss'];
$mywarehouse = $zentabooks_operation->get_warehouse_name_by_id($hiss);
if (isset($_POST['import']) ) {	  

		$date=date('Y-m-d H:i:s', strtotime($_POST['date']));
		$biller=$db_handle->sanitizePost(trim($_POST['biller']));
		$salespoint=$db_handle->sanitizePost(trim($_POST['salespoint']));
		$customer=$db_handle->sanitizePost(trim($_POST['customer']));
		$product=$db_handle->sanitizePost(trim($_POST['product']));
		$serialnumber=$db_handle->sanitizePost(trim($_POST['serialnumber']));
		$quantity=$db_handle->sanitizePost(trim($_POST['quantity']));
		$netunitprice=$db_handle->sanitizePost(trim($_POST['netunitprice']));
		$discount=$db_handle->sanitizePost(trim($_POST['discount']));
		$producttax=$db_handle->sanitizePost(trim($_POST['producttax']));
		$subtotal=$db_handle->sanitizePost(trim($_POST['subtotal']));
		$payment_status=$db_handle->sanitizePost(trim($_POST['payment_status']));
		$payment_reference_no=$db_handle->sanitizePost(trim($_POST['payment_reference_no']));
		$amountpaid=$db_handle->sanitizePost(trim($_POST['amountpaid']));
		$paid_by=$db_handle->sanitizePost(trim($_POST['paid_by']));
		$pcc_no=$db_handle->sanitizePost(trim($_POST['pcc_no']));
		$pcc_holder=$db_handle->sanitizePost(trim($_POST['pcc_holder']));
		$pcc_type=$db_handle->sanitizePost(trim($_POST['pcc_type']));
		$pcc_month=$db_handle->sanitizePost(trim($_POST['pcc_month']));
		$pcc_year=$db_handle->sanitizePost(trim($_POST['pcc_year']));
		$pcc_ccv=$db_handle->sanitizePost(trim($_POST['pcc_ccv']));
		$cheque_no=$db_handle->sanitizePost(trim($_POST['cheque_no']));
		$order_tax=$db_handle->sanitizePost(trim($_POST['order_tax']));
		$order_discount=$db_handle->sanitizePost(trim($_POST['order_discount']));
		$shipping=$db_handle->sanitizePost(trim($_POST['shipping']));
		$sale_status=$db_handle->sanitizePost(trim($_POST['sale_status']));
		$payment_term=$db_handle->sanitizePost(trim($_POST['payment_term']));
		$payment_status=$db_handle->sanitizePost(trim($_POST['payment_status']));
		$payment_reference_no=$db_handle->sanitizePost(trim($_POST['payment_reference_no']));
		$payment_note=$db_handle->sanitizePost(trim($_POST['payment_note']));
		$note=$db_handle->sanitizePost(trim($_POST['note']));
		$staff_note=$db_handle->sanitizePost(trim($_POST['staff_note']));



	   $document  = time().$_FILES['document']['name'];
	
		$uploaddir = "../uploads/sales/documents/";
	
		if (!is_dir('../uploads/sales/documents/')) {
			mkdir('../uploads/sales/documents/', 0777, TRUE);
		}
	
		$document1 = $uploaddir.$document;
		$tmp_file = $_FILES['document']['tmp_name'];
		print_r($product);
		move_uploaded_file($tmp_file, $document1); 		
		$sale_id = $zentabooks_operation->add_sale($date, $reference_no, $customer, $biller, $salespoint, $note, $staff_note, $total, $product_discount, $order_discount_id, $total_discount, $order_discount,  $order_tax_id, $order_tax, $total_tax, $shipping, $grand_total, $sale_status, $payment_status, $payment_term, $due_date, $created_by, $total_items, $pos, $paid, $attachment, $salescomm);
		if ($payment_status=='partial' ||$payment_status=='paid'){
			$zentabooks_operation->add_sale_payments($date, $reference_no, $sale_id, $salespoint, $paid_by, $cheque_no, $pcc_no, $pcc_holder, $pcc_type, $pcc_year, $pcc_ccv, $amountpaid, $currency, $user_code, $attachment, $sale_status, $note);
		}
		
	    //get the csv file
    $file = $_FILES[userfile][tmp_name];
    $handle = fopen($file,"r");
    
    //loop through the csv file and insert into database
	$totamount = 0; $noofitems = 0;
    do {
        if ($data[0]) {
		$prod_det = $this->view_product_detail($data[0]);
		$unit_det = $this->unit_detail($prod_det['sale_unit']);
		$tax_det = $this->tax_detail($producttax);
		$product_unit_id = $unit_det['id'];
		$product_unit_code = $unit_det['code'];
		$tax_rate = $tax_det['rate'];
		$tax_rate_id = $tax_det['id'];
		$item_tax = $tax_rate*$netunitprice;
		if (is_numeric($discount)){
			$discount_amt = $discount;
		}else{
			$discount_amt = $discount*$product_price;
		}
		$netunitprice = ($netunitprice + $item_tax);
		$real_unit_price = ($netunitprice + $item_tax)*$quantity;
		$subtotal = $real_unit_price - $discount_amt;
		$totamount += $subtotal;
		$noofitems += $data[2];
		

            mysqli_query("INSERT INTO sma_sale_items (sale_id, product_id, product_code, product_name, product_type, option_id, net_unit_price, unit_price, quantity, salespoint_id, item_tax, tax_rate_id, tax, discount, item_discount, subtotal, real_unit_price, product_unit_id, product_unit_code, unit_quantity,serial_no) VALUES
                (
                    '".$sale_id."',
                    '".$prod_det['id']."',
                    '".addslashes($data[0])."',
                    '".$prod_det['product_name']."',
                    '".$prod_det['type']."',
                    '".($option_id)."',
                    '".($netunitprice)."',
                    '".$prod_det['unit_price']."',
                    '".addslashes($data[2])."',
                    '".$salespoint."',
                    '".$item_tax."',
                    '".$tax_rate_id."',
                    '".$producttax."',
                    '".addslashes($data[5])."',
                    '".addslashes($data[5])."',
                    '".$subtotal."',
                    '".$real_unit_price."',
                    '".$product_unit_id."',
                    '".$product_unit_code."',
                    '".$prod_det['sale_unit']."',
                    ''
              )
            ");
        }
    } while ($data = fgetcsv($handle,1000,",","'"));
		$query = "UPDATE sma_sales SET total_items='$noofitems', grand_total='$totamount' WHERE id='$sale_id'";
		$db_handle->runQuery($query);

	//calculate Sales commission

	$message_success = "You have successfully import the sales transaction(s)";
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale by CSV - ZentaBooks</title>
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

function check_dd() {
    if(document.getElementById('slpayment_status').value == "partial" || document.getElementById('slpayment_status').value == "paid") {
        document.getElementById('payments').style.display = 'block';
    } else {
        document.getElementById('payments').style.display = 'none';
    }

}

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
                            <li><a href="<?php echo SITE_URL;?>/">Home</a></li><li><a href="<?php echo SITE_URL;?>/sales">Sales</a></li><li class="active">Add Sale by CSV</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <p>You are successfully logged in.</p>                            </div>
                                                                                                                        <div class="alerts-con"></div>
<script type="text/javascript">
    var count = 1, an = 1, product_variant = 0, DT = 1,
        product_tax = 0, invoice_tax = 0, total_discount = 0, total = 0,
        tax_rates = [{"id":"1","name":"No Tax","code":"NT","rate":"0.0000","type":"2"},{"id":"2","name":"VAT @10%","code":"VAT10","rate":"10.0000","type":"1"},{"id":"3","name":"GST @6%","code":"GST","rate":"6.0000","type":"1"},{"id":"4","name":"VAT @20%","code":"VT20","rate":"20.0000","type":"1"}];
    //var audio_success = new Audio('<?php echo SITE_ASSETS;?>/sounds/sound2.mp3');
    //var audio_error = new Audio('<?php echo SITE_ASSETS;?>/sounds/sound3.mp3');
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
        $(document).on('change', '#sldate', function (e) {
            localStorage.setItem('sldate', $(this).val());
        });
        if (sldate = localStorage.getItem('sldate')) {
            $('#sldate').val(sldate);
        }
        $(document).on('change', '#slbiller', function (e) {
            localStorage.setItem('slbiller', $(this).val());
        });
        if (slbiller = localStorage.getItem('slbiller')) {
            $('#slbiller').val(slbiller);
        }
                if (!localStorage.getItem('slref')) {
            localStorage.setItem('slref', 'SALE/2017/05/0001');
        }

    });
</script>


<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Add Sale</h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext">Please fill in the information below. The field labels marked with * are required input fields.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="token" value="75be92cf56cbd41bf54e0a905618d99b" /> 
                <div class="row">
                    <div class="col-lg-12">
                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sldate">Date</label>                                    <input type="text" name="date" value=""  class="form-control input-tip datetime" id="sldate" required="required" />
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slref">Reference No</label>                                <input type="text" name="reference_no" value="SALE/2017/05/0001"  class="form-control input-tip" id="slref" />
                            </div>
                        </div>
                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="slbiller">Biller</label>
                                    <select name="biller" id="biller" data-placeholder="Select Biller" required class="form-control input-tip select" style="width:100%;">
                                    <option value=""></option>
									<?php foreach($billers as $row2): ?>
                                          <option value="<?php echo $row2['id'];?>"><?php echo $row2['company'];?> </option>
                                     <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        

                                                                            <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="slwarehouse">Salespoint</label> 
                                                <select name="salespoint" id="salespoint" class="form-control col-sm-5" >
                                                    <option value="" >Select Salespoint...</option>
                                                    <?php 
                                                                foreach($salespoints as $row2):
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
                                                                        <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="slcustomer">Customer</label>                                            <div class="input-group">
                                                <input type="text" name="customer" value=""  id="slcustomer" data-placeholder="Select Customer" required="required" class="form-control input-tip" style="width:100%;" />
                                                <div class="input-group-addon no-print" style="padding: 2px 5px;"><a
                                                        href="<?php echo SITE_URL;?>/accounts/add_customer" ><i
                                                            class="fa fa-2x fa-plus-circle" id="addIcon"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                

                        <div class="col-md-12">
                            <div class="clearfix"></div>
                            <div class="well well-sm">
                                <a href="<a href="<?php echo SITE_URL;?>/uploads/sales/sample/sample_products.csv""
                                   class="btn btn-primary pull-right"><i class="fa fa-download"></i> Download Sample
                                    File</a>
                                <span class="text-warning">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span><br>
                                The correct column order is <span
                                    class="text-info">( Product Code, Net Unit Price, Quantity, Product Variant, Tax Rate Name, Discount, Serial No )</span> &amp; you must follow this.<br>Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).<br>
                                <strong>First 3 columns are required and other all are optional.</strong>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="csv_file">CSV File</label>                                <input id="csv_file" type="file" data-browse-label="Browse ..." name="userfile" required="required"
                                       data-show-upload="false" data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document">Attach Document</label>                                <input id="document" type="file" data-browse-label="Browse ..." name="document" data-show-upload="false"
                                       data-show-preview="false" class="form-control file">
                            </div>
                        </div>
                        <div class="clearfix"></div>

                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sltax2">Order Tax</label>                                    <select name="order_tax" id="sltax2" data-placeholder="Select Order Tax" class="form-control input-tip select" style="width:100%;">
<option value=""></option>
<option value="1" selected="selected">No Tax</option>
<option value="2">VAT @10%</option>
<option value="3">GST @6%</option>
<option value="4">VAT @20%</option>
</select>
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sldiscount">Order Discount</label>                                <input type="text" name="order_discount" value=""  class="form-control input-tip" id="sldiscount" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slshipping">Shipping</label>                                <input type="text" name="shipping" value=""  class="form-control input-tip" id="slshipping" />

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="slsale_status">Sale Status</label>                                <select name="sale_status" class="form-control input-tip" required id="slsale_status">
<option value="completed">Completed</option>
<option value="pending">Pending</option>
</select>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="slpayment_term">Payment Term</label>                                <input type="text" name="payment_term" value=""  class="form-control tip" data-trigger="focus" data-placement="top" title="Please type the number of days (integer) only" id="slpayment_term" />

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="slpayment_status">Payment Status</label>                                <select name="payment_status" class="form-control input-tip" required id="slpayment_status" onchange="check_dd();">
<option value="pending">Pending</option>
<option value="due">Due</option>
<option value="paid">Paid</option>
</select>

                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div id="payments" style="display: none;">
                            <div class="col-md-12">
                                <div class="well well-sm well_1">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="payment_reference_no">Payment Reference No</label>                                                    <input type="text" name="payment_reference_no" value=""  class="form-control tip" id="payment_reference_no" required="required" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="payment">
                                                    <div id="ngc" class="form-group ngc">
                                                        <label for="amount_1">Amount</label>                                                        <input name="amountpaid" type="text" id="amount_1"
                                                               class="pa form-control kb-pad amount"/>
                                                    </div>
                                                    <div id="gc" class="form-group gc" style="display: none;">
                                                        <label for="gift_card_no">Gift Card No</label>                                                        
                                                        <input name="gift_card_no" type="text" id="gift_card_no"
                                                               class="pa form-control kb-pad"/>

                                                        <div id="gc_details"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="paid_by_1">Paying by</label>                                                    
                                                    <select name="paid_by" id="paid_by_1" class="form-control paid_by" onchange="check_dd1();">
                                                        
        <option value="cash">Cash</option>
        <option value="gift_card">Gift Card</option>
        <option value="CC">Credit Card</option>
        <option value="Cheque">Cheque</option>
        <option value="other">Other</option><option value="deposit">Deposit</option>                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="pcc_1" class="pcc_1" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input name="pcc_no" type="text" id="pcc_no_1"
                                                               class="form-control" placeholder="Credit Card No"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input name="pcc_holder" type="text" id="pcc_holder_1"
                                                               class="form-control"
                                                               placeholder="Holder Name"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <select name="pcc_type" id="pcc_type_1"
                                                                class="form-control pcc_type"
                                                                placeholder="Card Type">
                                                            <option value="Visa">Visa</option>
                                                            <option
                                                                value="MasterCard">MasterCard</option>
                                                            <option value="Amex">Amex</option>
                                                            <option value="Discover">Discover</option>
                                                        </select>
                                                        <!-- <input type="text" id="pcc_type_1" class="form-control" placeholder="Card Type" />-->
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input name="pcc_month" type="text" id="pcc_month_1"
                                                               class="form-control" placeholder="Month"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <input name="pcc_year" type="text" id="pcc_year_1"
                                                               class="form-control" placeholder="Year"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">

                                                        <input name="pcc_ccv" type="text" id="pcc_cvv2_1"
                                                               class="form-control" placeholder="CVV2"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pcheque_1" class="pcheque_1" style="display:none;">
                                            <div class="form-group"><label for="cheque_no_1">Cheque No</label>                                                <input name="cheque_no" type="text" id="cheque_no_1"
                                                       class="form-control cheque_no"/>
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
                        </div>

                        <input type="hidden" name="total_items" value="" id="total_items" required="required"/>

                        <div class="row" id="bt">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slnote">Sale Note</label>                                        <textarea name="note" cols="40" rows="10"  class="form-control" id="slnote" style="margin-top: 10px; height: 100px;"></textarea>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slinnote">Staff Note</label>                                        <textarea name="staff_note" cols="40" rows="10"  class="form-control" id="slinnote" style="margin-top: 10px; height: 100px;"></textarea>

                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="col-md-12">
                            <div
                                class="fprom-group"><input type="submit" name="add_sale" value="Submit"  id="add_sale" class="btn btn-primary" style="padding: 6px 15px; margin:15px 0;" />
                                <button type="button" class="btn btn-danger" id="reset">Reset</div>
                        </div>
                    </div>
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
      - Page rendered in <strong>1.2381</strong> seconds</p>
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
        $('#sales_sale_by_csv').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
