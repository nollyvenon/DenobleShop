<?php
require_once("../includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    //redirect_to("../log-in");
}
if(isset($_POST['search_text']) && strlen($_POST['search_text']) > 3) {
    $search_text = $_POST['search_text'];
	$query = "SELECT us.*, b.name as brand_name, c.name as category_name
                FROM sma_products AS us
                LEFT JOIN sma_brands AS b ON us.brand = b.id
				LEFT JOIN sma_categories AS c ON us.category_id = c.id WHERE us.email LIKE '%$search_text%' OR us.phone LIKE '%$search_text%' OR us.first_name LIKE '%$search_text%' OR us.last_name LIKE '%$search_text%') ORDER BY us.id DESC ";
} else {
	$query = "SELECT us.*, b.name as brand_name, c.name as category_name
                FROM sma_products AS us
                LEFT JOIN sma_brands AS b ON us.brand = b.id
				LEFT JOIN sma_categories AS c ON us.category_id = c.id ORDER BY us.id DESC ";
}
$numrows = $db_handle->numRows($query);

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
$query .= 'LIMIT ' . $offset . ',' . $rowsperpage;
$result = $db_handle->runQuery($query);
$list_products = $db_handle->fetchAssoc($result);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>List Products | ZentaBooks</title>
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
                <h1>List Products <small><?php if($hiss == ""){?> (All Warehouses) <?php }else{ echo '('.$mywarehouse.')';}?></small></h1>
                <ol class="breadcrumb">
                    <li><a href="../index">Home</a></li>
                    <li class="active">List Products</li>
                </ol>
            </div>
            
            <div class="content-wrap">  <!--START: Content Wrap-->
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">List Products</h3>
                                <div class="tools">
                                    <a class="btn-link collapses panel-collapse" href="javascript:;"></a>
                                    <a class="btn-link reload" href="javascript:;"><i class="ti-reload"></i></a>
                                    <a class="btn-link expand" href="javascript:;"><i class="ti-fullscreen"></i></a>	                                
                                    <a class="btn-link panel-close" href="javascript:;"><i class="ti-close"></i></a>	                                
                                </div>
                            </div>
                            <div class="panel-body">
                            
                            
<table class="table table-bordered table-dataTable">
                        <thead>
                        <tr class="primary">
                            <th>
                                <input class="checkbox multi-select" type="checkbox" name="check"/>
                            </th>
                            <th>Image</th>
                            <!--<th>Code</th>-->
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Cost</th>
                            <th>Price</th>                            
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Alert Quantity</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php if(isset($list_products) && !empty($list_products)) { foreach ($list_products as $row) { ?>
                            <tr>
                                <td><input class="checkbox multi-select" type="checkbox" name="check"/></td>
                                <td><img src="<?php echo SITE_ROOT.'/uploads/products/images/no_image.png'; ?>" alt=""/></td>
                              <!--<td><?php echo $row['code']; ?></td>-->
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['brand_name']; ?></td>
                                <td><?php echo $row['category_name']; ?></td>
                                <td><?php echo number_format($row['cost'],2); ?></td>
                                <td><?php echo number_format($row['price'],2); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['unit']; ?></td>
                                <td><?php echo $row['alert_quantity']; ?></td>
                                <td><div class="dropdown">
  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Actions
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="#">HTML</a></li>
    <li><a href="#">CSS</a></li>
    <li><a href="#">JavaScript</a></li>
  </ul>
</div></td>
                            </tr>
                            <?php } } else { echo "<tr><td colspan='5' class='text-danger'><em>No results to display</em></td></tr>"; } ?>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th>Image</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>                           
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                    </table>

                   				 </div>
                        </div>
                    </div>
                    
                </div>
                    
                
            </div>  <!--END: Content Wrap-->
            
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