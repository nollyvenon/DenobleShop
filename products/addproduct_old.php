<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    //redirect_to("../log-in");
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add Products | ZentaBooks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Prakasam Mathaiyan">
    <meta name="description" content="">

    <!--[if IE]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="../assets/plugins/lib/modernizr.js"></script>
    <link rel="icon" href="../assets/images/favicon.png" type="image/gif">
    
    <link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/plugins/datatable/dataTables.bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style-default.css">

</head>

<body>
    
    <div class="wrapper has-footer">
        
        <?php include '../includsin/header.php';?>
        
        <?php include '../includsin/sidebar.php';?>
        
        <div class="main-container">    <!-- START: Main Container -->
            
            <div class="page-header">
                <h1>List Products <small>(All Warehouses)</small></h1>
                <ol class="breadcrumb">
                    <li><a href="../index">Home</a></li>
                    <li class="active">List Products</li>
                </ol>
            </div>
            
            <div class="box">
    <div class="box-header">
        <h2 class="blue"><i class="fa-fw fa fa-plus"></i>Add Product</h2>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">

                <p class="introtext">Please fill in the information below. The field labels marked with * are required input fields.</p>

                <form action="http://localhost/stockfeb2017/products/add" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="token" value="d6bcbbcd69eb572072063744c9bb3bc3" />                                                      

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="type">Product Type</label>                        <select name="type" class="form-control" id="type" required="required">
<option value="standard">Standard</option>
<option value="combo">Combo</option>
<option value="digital">Digital</option>
<option value="service">Service</option>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="name">Product Name</label>                        <input type="text" name="name" value=""  class="form-control" id="name" required="required" />
                    </div>
                    <div class="form-group all">
                        <label for="code">Product Code</label>                        <div class="input-group">
                            <input type="text" name="code" value=""  class="form-control" id="code"  required="required" />
                            <span class="input-group-addon pointer" id="random_num" style="padding: 1px 10px;">
                                <i class="fa fa-random"></i>
                            </span>
                        </div>
                        <span class="help-block">You can scan your barcode  and select the correct symbology below</span>
                    </div>
                    <div class="form-group all">
                        <label for="barcode_symbology">Barcode Symbology</label>                        <select name="barcode_symbology" class="form-control select" id="barcode_symbology" required="required" style="width:100%;">
<option value="code25">Code25</option>
<option value="code39">Code39</option>
<option value="code128" selected="selected">Code128</option>
<option value="ean8">EAN8</option>
<option value="ean13">EAN13</option>
<option value="upca">UPC-A</option>
<option value="upce">UPC-E</option>
</select>

                    </div>
                    <div class="form-group all">
                        <label for="brand">Brand</label>                        <select name="brand" class="form-control select" id="brand" placeholder="Select Brand" style="width:100%">
<option value="" selected="selected"></option>
<option value="1">Infinix</option>
<option value="2">Tecno</option>
<option value="3">LG Electronics</option>
<option value="4">Samsung</option>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="category">Category</label>                        <select name="category" class="form-control select" id="category" placeholder="Select Category" required="required" style="width:100%">
<option value="" selected="selected"></option>
<option value="2">Electronics</option>
<option value="1">Phone</option>
<option value="3">Refrigerator</option>
</select>
                    </div>
                    <div class="form-group all">
                        <label for="subcategory">Sub Category</label>                        <div class="controls" id="subcat_data"> <input type="text" name="subcategory" value=""  class="form-control" id="subcategory"  placeholder="Please select category to load" />
                        </div>
                    </div>
                    <div class="form-group standard">
                        <label for="unit">Product Unit</label>                                                <select name="unit" class="form-control tip" id="unit" required="required" style="width:100%;">
<option value="" selected="selected">Select Unit</option>
<option value="1">piece (pie)</option>
</select>
                    </div>
                    <div class="form-group standard">
                        <label for="default_sale_unit">Default Sale Unit</label>                                                <select name="default_sale_unit" class="form-control" id="default_sale_unit" style="width:100%;">
<option value="" selected="selected">Please select unit first</option>
</select>
                    </div>
                    <div class="form-group standard">
                        <label for="default_purchase_unit">Default Purchase Unit</label>                        <select name="default_purchase_unit" class="form-control" id="default_purchase_unit" style="width:100%;">
<option value="" selected="selected">Please select unit first</option>
</select>
                    </div>
                                        <div class="form-group standard">
                        <label for="cost">Product Cost</label>                        <input type="text" name="cost" value=""  class="form-control tip" id="cost" />
                    </div>
                    <div class="form-group all">
                        <label for="price">Product Price</label>                        <input type="text" name="price" value=""  class="form-control tip" id="price" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="checkbox" value="1" name="promotion" id="promotion" >
                        <label for="promotion" class="padding05">
                            Promotion                        </label>
                    </div>

                    <div id="promo" style="display:none;">
                        <div class="well well-sm">
                            <div class="form-group">
                                <label for="promo_price">Promotion Price</label>                                <input type="text" name="promo_price" value=""  class="form-control tip" id="promo_price" />
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label>                                <input type="text" name="start_date" value=""  class="form-control tip date" id="start_date" />
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>                                <input type="text" name="end_date" value=""  class="form-control tip date" id="end_date" />
                            </div>
                        </div>
                    </div>

                                            <div class="form-group all">
                            <label for="tax_rate">Product Tax</label>                            <select name="tax_rate" class="form-control select" id="tax_rate" placeholder="Select Product Tax" style="width:100%">
<option value=""></option>
<option value="1" selected="selected">No Tax</option>
<option value="2">VAT @10%</option>
<option value="3">GST @6%</option>
<option value="4">VAT @20%</option>
</select>
                        </div>
                        <div class="form-group all">
                            <label for="tax_method">Tax Method</label>                            <select name="tax_method" class="form-control select" id="tax_method" placeholder="Select Tax Method" style="width:100%">
<option value="0">Inclusive</option>
<option value="1">Exclusive</option>
</select>
                        </div>
                                        <div class="form-group standard">
                        <label for="alert_quantity">Alert Quantity</label>                        <div
                            class="input-group"> <input type="text" name="alert_quantity" value=""  class="form-control tip" id="alert_quantity" />
                            <span class="input-group-addon">
                            <input type="checkbox" name="track_quantity" id="track_quantity"
                                   value="1" checked="checked">
                        </span>
                        </div>
                    </div>
                    
                    <div class="form-group all">
                        <label for="product_image">Product Image</label>                        <input id="product_image" type="file" data-browse-label="Browse ..." name="product_image" data-show-upload="false"
                               data-show-preview="false" accept="image/*" class="form-control file">
                    </div>

                    <div class="form-group all">
                        <label for="images">Product Gallery Images</label>                        <input id="images" type="file" data-browse-label="Browse ..." name="userfile[]" multiple data-show-upload="false"
                               data-show-preview="false" class="form-control file" accept="image/*">
                    </div>
                    <div id="img-details"></div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <div class="standard">

                        <div id="attrs"></div>
                        
                        <div class="form-group">
                            <input type="checkbox" class="checkbox" name="attributes"
                                   id="attributes" ><label
                                for="attributes"
                                class="padding05">This product has multiple variants</label> e.g. Multiple Sizes and/or Colors                        </div>
                        <div class="well well-sm" id="attr-con"
                             style="display:none;">
                            <div class="form-group" id="ui" style="margin-bottom: 0;">
                                <div class="input-group">
                                    <input type="text" name="attributesInput" value=""  class="form-control select-tags" id="attributesInput" placeholder="Enter variants separated by comma" />
                                    <div class="input-group-addon" style="padding: 2px 5px;">
                                        <a href="#" id="addAttributes">
                                            <i class="fa fa-2x fa-plus-circle" id="addIcon"></i>
                                        </a>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                            <div class="table-responsive"><? print_r($product_options); ?>
                                <table id="attrTable" class="table table-bordered table-condensed table-striped"
                                       style="display:none;margin-bottom: 0; margin-top: 10px;">
                                    <thead>
                                    <tr class="active">
                                        <th>Name</th>
                                        <th>Warehouse</th>
                                        <th>Quantity</th>
                                        <th>Price Addition</th>
                                        <th><i class="fa fa-times attr-remove-all"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="">
                            <strong>Warehouse Quantity</strong><br>
                            <div class="row"><div class="col-md-12"><div class="well"><div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom:15px;">Warehouse 1<br><div class="form-group">
<input type="hidden" name="wh_1" value="1" />
<input type="text" name="wh_qty_1" value=""  class="form-control" id="wh_qty_1" placeholder="Quantity" />
</div><div class="form-group"><input type="text" name="rack_1" value=""  class="form-control" id="rack_1" placeholder="Racks" />
</div></div><div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom:15px;">Warehouse 2<br><div class="form-group">
<input type="hidden" name="wh_2" value="2" />
<input type="text" name="wh_qty_2" value=""  class="form-control" id="wh_qty_2" placeholder="Quantity" />
</div><div class="form-group"><input type="text" name="rack_2" value=""  class="form-control" id="rack_2" placeholder="Racks" />
</div></div><div class="col-md-6 col-sm-6 col-xs-6" style="padding-bottom:15px;">Warehouse 3<br><div class="form-group">
<input type="hidden" name="wh_3" value="3" />
<input type="text" name="wh_qty_3" value=""  class="form-control" id="wh_qty_3" placeholder="Quantity" />
</div><div class="form-group"><input type="text" name="rack_3" value=""  class="form-control" id="rack_3" placeholder="Racks" />
</div></div><div class="clearfix"></div></div></div></div>                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="combo" style="display:none;">

                        <div class="form-group">
                            <label for="add_item">Add Product</label> (Product without variants only)                            <input type="text" name="add_item" value=""  class="form-control ttip" id="add_item" data-placement="top" data-trigger="focus" data-bv-notEmpty-message="Please add items below" placeholder="Add Item" />
                        </div>
                        <div class="control-group table-group">
                            <label class="table-label" for="combo">Combo Products</label>

                            <div class="controls table-controls">
                                <table id="prTable"
                                       class="table items table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th class="col-md-5 col-sm-5 col-xs-5">Product (Code - Name)</th>
                                        <th class="col-md-2 col-sm-2 col-xs-2">Quantity</th>
                                        <th class="col-md-3 col-sm-3 col-xs-3">Unit Price</th>
                                        <th class="col-md-1 col-sm-1 col-xs-1 text-center">
                                            <i class="fa fa-trash-o" style="opacity:0.5; filter:alpha(opacity=50);"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="digital" style="display:none;">
                        <div class="form-group digital">
                            <label for="digital_file">Digital File</label>                            <input id="digital_file" type="file" data-browse-label="Browse ..." name="digital_file" data-show-upload="false"
                                   data-show-preview="false" class="form-control file">
                        </div>
                        <div class="form-group">
                            <label for="file_link">File Link/URL</label>                            <input type="text" name="file_link" value=""  class="form-control" id="file_link" />
                        </div>
                    </div>

                <div class="form-group standard">
                    <div class="form-group">
                        <label for="supplier">Supplier</label>                        <button type="button" class="btn btn-primary btn-xs" id="addSupplier"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="row" id="supplier-con">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input type="text" name="supplier" value=""  class="form-control suppliers" id="supplier" placeholder="Select Supplier" style="width:100%;" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input type="text" name="supplier_part_no" value=""  class="form-control tip" id="supplier_part_no" placeholder="Supplier Part Number" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                            <input type="text" name="supplier_price" value=""  class="form-control tip" id="supplier_price" placeholder="Supplier Price" />
                            </div>
                        </div>
                    </div>
                    <div id="ex-suppliers"></div>
                </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <input name="cf" type="checkbox" class="checkbox" id="extras" value="" />
                        <label for="extras" class="padding05">Custom Fields</label>
                    </div>
                    <div class="row" id="extras-con" style="display: none;">

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf1">Product Custom Field 1</label>                                <input type="text" name="cf1" value=""  class="form-control tip" id="cf1" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf2">Product Custom Field 2</label>                                <input type="text" name="cf2" value=""  class="form-control tip" id="cf2" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf3">Product Custom Field 3</label>                                <input type="text" name="cf3" value=""  class="form-control tip" id="cf3" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf4">Product Custom Field 4</label>                                <input type="text" name="cf4" value=""  class="form-control tip" id="cf4" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf5">Product Custom Field 5</label>                                <input type="text" name="cf5" value=""  class="form-control tip" id="cf5" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group all">
                                <label for="cf6">Product Custom Field 6</label>                                <input type="text" name="cf6" value=""  class="form-control tip" id="cf6" />
                            </div>
                        </div>

                    </div>

                    <div class="form-group all">
                        <label for="product_details">Product Details</label>                        <textarea name="product_details" cols="40" rows="10"  class="form-control" id="details"></textarea>
                    </div>
                    <div class="form-group all">
                        <label for="details">Product details for invoice</label>                        <textarea name="details" cols="40" rows="10"  class="form-control" id="details"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" name="add_product" value="Add Product"  class="btn btn-primary" />
                    </div>

                </div>
                </form>
            </div>
            </div>
            </div>
         </div>
            
        </div>  <!-- END: Main Container -->
        
        <?php include '../includsin/footer.php';?>
    </div>  <!-- END: wrapper -->
    <script type="text/javascript" src="../assets/plugins/lib/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/lib/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/lib/plugins.js"></script>
    
    <script type="text/javascript" src="../assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatable/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.base.js"></script>
    <script type="text/javascript" src="../assets/js/page-table.js"></script>

    <script>
        jQuery(document).ready(function () {
            DataTableBasic.init();
        });
    </script>

</body>
</html>