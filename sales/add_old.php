<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("../log-in");
}
$allwarehouses = $zentabooks_operation->get_all_warehouses();
$mywarehouse = $zentabooks_operation->get_warehouse_name_by_id($hiss);
$salespoints = $zentabooks_operation->get_all_salespoints();
$customers = $zentabooks_operation->get_users_by_groups(3);
$allproducts = $zentabooks_operation->product_with_colour_list();
$billers = $zentabooks_operation->get_users_by_groups('biller');
$trans_count = $zentabooks_operation->get_no_of_monthly_transactions('sma_sales',date('m'))+1;
$refno = "SALE/".date('Y').'/'.date('m').'/'.sprintf("%04s", $trans_count);

	 if ($_POST['add_sale']){
	 	$entrydate = date ('d-m-Y');		
		$date=date('Y-m-d H:i:s', strtotime($_POST['date']));
		$biller=$_POST['biller'];
		$salespoint=$_POST['salespoint'];
		$customer=$_POST['customer'];
		$reference_no = $_POST['reference_no'];
		$product=$_POST['product'];
		$serialnumber=$_POST['serialnumber'];
		$quantity=$_POST['quantity'];
		$netunitprice=$_POST['netunitprice'];
		$discount=$_POST['discount'];
		$producttax=$_POST['producttax'];
		$subtotal=$_POST['subtotal'];
		$amountpaid=$_POST['amountpaid'];
		$paid_by=$_POST['paid_by'];
		$pcc_no=$_POST['pcc_no'];
		$pcc_holder=$_POST['pcc_holder'];
		$pcc_type=$_POST['pcc_type'];
		$pcc_month=$_POST['pcc_month'];
		$pcc_year=$_POST['pcc_year'];
		$pcc_ccv=$_POST['pcc_ccv'];
		$cheque_no=$_POST['cheque_no'];
		$order_tax=$_POST['order_tax'];
		$order_discount=$_POST['order_discount'];
		$shipping=$_POST['shipping'];
		$sale_status=$_POST['sale_status'];
		$payment_term=$_POST['payment_term'];
		$payment_status=$_POST['payment_status'];
		$payment_reference_no=$_POST['payment_reference_no'];
		$payment_note=$_POST['payment_note'];
		$note=$_POST['note'];
		$staff_note=$_POST['staff_note'];



	   $document  = time().$_FILES['document']['name'];
	
		$uploaddir = "../uploads/sales/documents/";
	
		if (!is_dir('../uploads/sales/documents/')) {
			mkdir('../uploads/sales/documents/', 0777, TRUE);
		}
	
		$document1 = $uploaddir.$document;
		$tmp_file = $_FILES['document']['tmp_name'];
		//print_r($product);
		move_uploaded_file($tmp_file, $document1); 		
		$sale_id = $zentabooks_operation->add_sale($date, $reference_no, $customer, $biller, $salespoint, $note, $staff_note, $total, $product_discount, $order_discount_id, $total_discount, $order_discount,  $order_tax_id, $order_tax, $total_tax, $shipping, $grand_total, $sale_status, $payment_status, $payment_term, $due_date, $created_by, $total_items, $pos, $paid, $attachment, $paid_by, $salescomm);
		if ($payment_status=='partial' ||$payment_status=='paid'){
			$zentabooks_operation->add_sale_payments($date, $reference_no, $sale_id, $salespoint, $paid_by, $cheque_no, $pcc_no, $pcc_holder, $pcc_type, $pcc_year, $pcc_ccv, $amountpaid, $currency, $user_code, $attachment, $sale_status, $note);
		}
		$totamount = 0; $noofitems = 0;
		foreach($product as $a => $b){
			$zentabooks_operation->add_sale_items($sale_id, $salespoint, $product[$a],  $serialnumber[$a], intval($quantity[$a]), $netunitprice[$a], $discount[$a], $producttax[$a], $subtotal[$a]);
			$totamount += $subtotal[$a];
			$noofitems += $quantity[$a];
			
			$prod_det = $zentabooks_operation->view_product_detail($product[$a]);
			$profit = $prod_det['price'] -$prod_det['cost'];
			$totprofit += $profit;
		}
		$settings  = $zentabooks_operation->get_settings();
		$salescomm = $settings['salescommission']*$totprofit;
		$salemonth = date('m',strtotime($date));
		$saleyear = date('Y',strtotime($date));
		$created_by = $this->view_sales_detail($sale_id)['created_by'];//get the salespoint person in the sales invoice
		
		$this->add_sales_commission($created_by, $salespoint, $salescomm, $salemonth, $saleyear) ;
		
		$query = "UPDATE sma_sales SET total_items='$noofitems', grand_total='$totamount', salescomm='$salescomm' WHERE id='$sale_id'";
		$db_handle->runQuery($query);

			$message_success = "Sales added successfully";
		
	 }
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="<?php echo SITE_URL;?>/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sales - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_URL;?>/themes/default/assets/images/icon.png"/>
    <link href="<?php echo SITE_URL;?>/themes/default/assets/styles/theme.css" rel="stylesheet"/>
    <link href="<?php echo SITE_URL;?>/themes/default/assets/styles/style.css" rel="stylesheet"/>
     <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
   <script type="text/javascript" src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo SITE_URL;?>/themes/default/assets/js/jquery.js"></script>
    <![endif]-->
    <noscript><style type="text/css">#loading { display: none; }</style></noscript>
        <script type="text/javascript">
        $(window).load(function () {
            $("#loading").fadeOut("slow");

	
        });

  
			$(document).ready(function(){	
				$("#duplicate").dynamicForm("#plus", "#minus", {limit:50, createColor: 'yellow',removeColor: 'red'});
				
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



    </script>
    		<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/jquery-dynamic-form.js"></script>
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
<script type="text/javascript">

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
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Add Sale</h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext">Please fill in the information below. The field labels marked with * are required input fields.</p>
                <form action="" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="token" value="d6bcbbcd69eb572072063744c9bb3bc3" />     
                                <?php require_once '../layouts/feedback_message.php'; ?>
                                     
                <div class="row">
                    <div class="col-lg-12">
                                                    <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">Date</label>                                    
                                    <input type="text" name="date" value=""  class="form-control input-tip datetime" id="sldate" required="required" />
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slref">Reference No</label>                                
                                <input type="text" name="reference_no" value="<?php echo $refno;?>"  class="form-control input-tip" id="slref" />
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
                        
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="panel panel-warning">
                                <div
                                    class="panel-heading">Please select these before adding any product</div>
                                <div class="panel-body" style="padding: 5px;">
                                                                            <div class="col-md-4">
                                            <div class="form-group">
                                            
                                                <label for="slsalespoint">Salespoint</label>                                    
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
                                                <select name="customer" id="customer"  class=" col-md-12 form-control" data-live-search="true"  >
                                                    <option value="" >Select Customer...</option>
                                                    <?php 
                                                                foreach($customers as $row2):
                                                                ?>
                                                                    <option value="<?php echo $row2['id'];?>">
                                                                            <?php echo $row2['name'];?>
                                                                                </option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                </select>
                                                <div class="input-group-addon no-print" style="padding: 2px 8px; border-left: 0;">
                                                    <a href="#" id="toogle-customer-read-attr" class="external">
                                                        <i class="fa fa-pencil" id="addIcon" style="font-size: 1.2em;"></i>
                                                    </a>
                                                </div>
                                                <div class="input-group-addon no-print" style="padding: 2px 7px; border-left: 0;">
                                                    <a href="#" id="view-customer" class="external" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-eye" id="addIcon" style="font-size: 1.2em;"></i>
                                                    </a>
                                                </div>
                                                                                                <div class="input-group-addon no-print" style="padding: 2px 8px;">
                                                    <a href="<?php echo SITE_URL;?>/customers/add" id="add-customer"class="external" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-plus-circle" id="addIcon"  style="font-size: 1.2em;"></i>
                                                    </a>
                                                </div>
                                                                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="col-md-12">
                            <div class="control-group table-group">
                                <label class="table-label">Order Items *</label>

                                <div class="controls table-controls">

                                        <div class="form-group">
				<label class="col-md-4">Product (Code - Name)<span class="required">*</span></label>
              <label class="col-md-2">Serial No</label>
              <label class="col-md-1"><font size="">Price</font></label>
              <label class="col-md-1">Quantity</label>
              <label class="col-md-1">Discount</label>
              <label class="col-md-1">Product Tax</label>
              <label class="col-md-1">Subtotal    (<span class="currency">NGN</span>)</label>
              <label class="col-md-1"><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></label>
              <div class="clearfix"></div>
              <div id="duplicate" class="row form-group">
                  <div class="col-md-4 col-xs-11"><select name="product[]" id="0"  onBlur="callAutoAsignValue(this.id)" onChange="callAutoAsignValue(this.id)"  class=" col-md-12 form-control" data-live-search="true" >
                  			<option>Select A Product</option>
                           <?php  foreach ($allproducts as $row) {   ?>
                                    <option  value="<?=$row['id'];?>"><?=$row['name'];?></option>
                                    <?php } ?>
            </select> </div>
                          <div class="col-md-2 col-xs-11"><input name="serialnumber[]" id="00"   class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-1 col-xs-11"><input name="netunitprice[]" id="000"  required class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-1 col-xs-11"><input name="quantity[]" id="0000" required class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-1 col-xs-11"><input name="discount[]" id="00000"  required class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-1 col-xs-11"><input name="producttax[]" id="000000"  required class=" col-md-12 form-control" type="text" size="35" /> </div>
                          <div class="col-md-1 col-xs-11"><input name="subtotal[]" id="0000000"  required class=" col-md-12 form-control" type="text" size="35" /> </div>
                    <div class="col-md-1 col-xs-11"><span><a id="minus" href=""  ><i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i></a> <a id="plus" href="">[+]</a></span></div>
                    <div class="clearfix"></div>
              </div>
           </div>
                                </div>
                            </div>
                            </div>
                   

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
                                    <label for="sldiscount">Order Discount</label>                                    <input type="text" name="order_discount" value=""  class="form-control input-tip" id="sldiscount" />
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slshipping">Shipping</label>                                <input type="text" name="shipping" value=""  class="form-control input-tip" id="slshipping" />

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="document">Attach Document</label>                                <input id="document" type="file" data-browse-label="Browse ..." name="document" data-show-upload="false"
                                       data-show-preview="false" class="form-control file">
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
                                <label for="slpayment_status">Payment Status</label>                                
                                <select name="payment_status" class="form-control input-tip" required id="slpayment_status" onchange="check_dd();">
<option value="pending">Pending</option>
<option value="due">Due</option>
<option value="partial">Partial</option>
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
                                                    <label for="payment_reference_no">Payment Reference No</label>
                                                    <input type="text" name="payment_reference_no" value=""  class="form-control tip" id="payment_reference_no" />
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
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
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="paid_by_1">Paying by</label>                                                    
                                                    <select name="paid_by" id="paid_by_1" class="form-control paid_by" onchange="check_dd1();" >
                                                        
        <option value="cash">Cash</option>
        <option value="pos">POS</option>
        <option value="cash_pos">Cash & POS</option>
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
                                            <div class="form-group"><label for="cheque_no_1">Cheque No</label>                                                
                                            <input name="cheque_no" type="text" id="cheque_no_1"
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
                <div id="bottom-total" class="well well-sm" style="margin-bottom: 0;">
                    <table class="table table-bordered table-condensed totals" style="margin-bottom:0;">
                        <tr class="warning">
                            <td>Items <span class="totals_val pull-right" id="titems">0</span></td>
                            <td>Total <span class="totals_val pull-right" id="total">0.00</span></td>
                                                        <td>Order Discount <span class="totals_val pull-right" id="tds">0.00</span></td>
                                                                                        <td>Order Tax <span class="totals_val pull-right" id="ttax2">0.00</span></td>
                                                        <td>Shipping <span class="totals_val pull-right" id="tship">0.00</span></td>
                            <td>Grand Total <span class="totals_val pull-right" id="gtotal">0.00</span></td>
                        </tr>
                    </table>
                </div>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="prModal" tabindex="-1" role="dialog" aria-labelledby="prModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="prModalLabel"></h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                                            <div class="form-group">
                            <label class="col-sm-4 control-label">Product Tax</label>
                            <div class="col-sm-8">
                                <select name="ptax" id="ptax" class="form-control pos-input-tip" style="width:100%;">
<option value="" selected="selected"></option>
<option value="1">No Tax</option>
<option value="2">VAT @10%</option>
<option value="3">GST @6%</option>
<option value="4">VAT @20%</option>
</select>
                            </div>
                        </div>
                                                                <div class="form-group">
                            <label for="pserial" class="col-sm-4 control-label">Serial No</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pserial">
                            </div>
                        </div>
                                        <div class="form-group">
                        <label for="pquantity" class="col-sm-4 control-label">Quantity</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pquantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="punit" class="col-sm-4 control-label">Product Unit</label>
                        <div class="col-sm-8">
                            <div id="punits-div"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="poption" class="col-sm-4 control-label">Product Option</label>
                        <div class="col-sm-8">
                            <div id="poptions-div"></div>
                        </div>
                    </div>
                                            <div class="form-group">
                            <label for="pdiscount"
                                   class="col-sm-4 control-label">Product Discount</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pdiscount">
                            </div>
                        </div>
                                        <div class="form-group">
                        <label for="pprice" class="col-sm-4 control-label">Unit Price</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pprice" >
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:25%;">Net Unit Price</th>
                            <th style="width:25%;"><span id="net_price"></span></th>
                            <th style="width:25%;">Product Tax</th>
                            <th style="width:25%;"><span id="pro_tax"></span></th>
                        </tr>
                    </table>
                    <input type="hidden" id="punit_price" value=""/>
                    <input type="hidden" id="old_tax" value=""/>
                    <input type="hidden" id="old_qty" value=""/>
                    <input type="hidden" id="old_price" value=""/>
                    <input type="hidden" id="row_id" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="editItem">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="mModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i
                            class="fa fa-2x">&times;</i></span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="mModalLabel">Add Product Manually</h4>
            </div>
            <div class="modal-body" id="pr_popover_content">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="mcode" class="col-sm-4 control-label">Product Code *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mcode">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mname" class="col-sm-4 control-label">Product Name *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mname">
                        </div>
                    </div>
                                            <div class="form-group">
                            <label for="mtax" class="col-sm-4 control-label">Product Tax *</label>

                            <div class="col-sm-8">
                                <select name="mtax" id="mtax" class="form-control input-tip select" style="width:100%;">
<option value="" selected="selected"></option>
<option value="1">No Tax</option>
<option value="2">VAT @10%</option>
<option value="3">GST @6%</option>
<option value="4">VAT @20%</option>
</select>
                            </div>
                        </div>
                                        <div class="form-group">
                        <label for="mquantity" class="col-sm-4 control-label">Quantity *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mquantity">
                        </div>
                    </div>
                                            <div class="form-group">
                            <label for="mdiscount"
                                   class="col-sm-4 control-label">Product Discount</label>

                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mdiscount">
                            </div>
                        </div>
                                        <div class="form-group">
                        <label for="mprice" class="col-sm-4 control-label">Unit Price *</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="mprice">
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width:25%;">Net Unit Price</th>
                            <th style="width:25%;"><span id="mnet_price"></span></th>
                            <th style="width:25%;">Product Tax</th>
                            <th style="width:25%;"><span id="mpro_tax"></span></th>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addItemManually">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="gcModal" tabindex="-1" role="dialog" aria-labelledby="mModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                        class="fa fa-2x">&times;</i></button>
                <h4 class="modal-title" id="myModalLabel">Sell Gift Card</h4>
            </div>
            <div class="modal-body">
                <p>Please fill in the information below. The field labels marked with * are required input fields.</p>

                <div class="alert alert-danger gcerror-con" style="display: none;">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <span id="gcerror"></span>
                </div>
                <div class="form-group">
                    <label for="gccard_no">Card No</label> *
                    <div class="input-group">
                        <input type="text" name="gccard_no" value=""  class="form-control" id="gccard_no" />
                        <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;"><a href="#"
                                                                                                           id="genNo"><i
                                    class="fa fa-cogs"></i></a></div>
                    </div>
                </div>
                <input type="hidden" name="gcname" value="Gift Card" id="gcname"/>

                <div class="form-group">
                    <label for="gcvalue">Value</label> *
                    <input type="text" name="gcvalue" value=""  class="form-control" id="gcvalue" />
                </div>
                <div class="form-group">
                    <label for="gcprice">Price</label> *
                    <input type="text" name="gcprice" value=""  class="form-control" id="gcprice" />
                </div>
                <div class="form-group">
                    <label for="gccustomer">Customer</label>                    <input type="text" name="gccustomer" value=""  class="form-control" id="gccustomer" />
                </div>
                <div class="form-group">
                    <label for="gcexpiry">Expiry Date</label>                    <input type="text" name="gcexpiry" value="09/05/2019"  class="form-control date" id="gcexpiry" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="addGiftCard" class="btn btn-primary">Sell Gift Card</button>
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
<script type="text/javascript" src="<?php echo SITE_ASSETS;?>/js/sales.js"></script>
<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
    $(window).load(function () {
        $('.mm_sales').addClass('active');
        $('.mm_sales').find("ul").first().slideToggle();
        $('#sales_add').addClass('active');
        $('.mm_sales a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
