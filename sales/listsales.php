<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blank Page | Big Ben Admin</title>
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

    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style-default.css">
</head>

<body>
    
    <div class="wrapper has-footer">
        
        <?php include '../includsin/header.php';?>
        
        <?php include '../includsin/sidebar.php';?>
        
        <div class="main-container">    <!-- START: Main Container -->
            
            <div class="page-header">
                <h1>Example page header <small>Subtext for header</small></h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../index.php">Pages</a></li>
                    <li class="active">Blank Page</li>
                </ol>
            </div>
            
            <div class="content-wrap">  <!--START: Content Wrap-->
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">List Sales</h3>
                                <div class="tools">
                                    <a class="btn-link collapses panel-collapse" href="javascript:;"></a>
                                    <a class="btn-link reload" href="javascript:;"><i class="ti-reload"></i></a>
                                    <a class="btn-link expand" href="javascript:;"><i class="ti-fullscreen"></i></a>	                                
                                    <a class="btn-link panel-close" href="javascript:;"><i class="ti-close"></i></a>	                                
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                    <table id="PRData" class="table table-bordered table-condensed table-hover table-striped">
                        <thead>
                        <tr class="primary">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox multi-select" type="checkbox" name="check"/>
                            </th>
                            <th style="min-width:40px; width: 40px; text-align: center;">Image</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Cost</th><th>Price</th>                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Racks</th>
                            <th>Alert Quantity</th>
                            <th style="min-width:65px; text-align:center;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="11" class="dataTables_empty">Loading data from server</td>
                        </tr>
                        </tbody>

                        <tfoot class="dtFilter">
                        <tr class="active">
                            <th style="min-width:30px; width: 30px; text-align: center;">
                                <input class="checkbox checkft" type="checkbox" name="check"/>
                            </th>
                            <th style="min-width:40px; width: 40px; text-align: center;">Image</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th><th></th>                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="width:65px; text-align:center;">Actions</th>
                        </tr>
                        </tfoot>
                    </table>
                   				 </div>
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

    <script type="text/javascript" src="../assets/js/app.base.js"></script>
</body>
</html>