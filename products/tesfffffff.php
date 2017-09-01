<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="http://localhost/stockfeb2017/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - ZentaBooks</title>
    <link rel="shortcut icon" href="http://localhost/stockfeb2017/themes/default/assets/images/icon.png"/>
    <link href="http://localhost/stockfeb2017/themes/default/assets/styles/theme.css" rel="stylesheet"/>
    <link href="http://localhost/stockfeb2017/themes/default/assets/styles/style.css" rel="stylesheet"/>
    <script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://localhost/stockfeb2017/themes/default/assets/js/jquery.js"></script>
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
    <header id="header" class="navbar">
        <div class="container">
            <a class="navbar-brand" href="http://localhost/stockfeb2017/"><span class="logo">ZentaBooks</span></a>

            <div class="btn-group visible-xs pull-right btn-visible-sm">
                <button class="navbar-toggle btn" type="button" data-toggle="collapse" data-target="#sidebar_menu">
                    <span class="fa fa-bars"></span>
                </button>
                <a href="http://localhost/stockfeb2017/users/profile/2" class="btn">
                    <span class="fa fa-user"></span>
                </a>
                <a href="http://localhost/stockfeb2017/logout" class="btn">
                    <span class="fa fa-sign-out"></span>
                </a>
            </div>
            <div class="header-nav">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a class="btn account dropdown-toggle" data-toggle="dropdown" href="#">
                            <img alt="" src="http://localhost/stockfeb2017/assets/images/male.png" class="mini_avatar img-rounded">

                            <div class="user">
                                <span>Welcome admin</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="http://localhost/stockfeb2017/users/profile/2">
                                    <i class="fa fa-user"></i> Profile                                </a>
                            </li>
                            <li>
                                <a href="http://localhost/stockfeb2017/users/profile/2/#cpassword"><i class="fa fa-key"></i> Change Password                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="http://localhost/stockfeb2017/logout">
                                    <i class="fa fa-sign-out"></i> Logout                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown hidden-xs"><a class="btn tip" title="Dashboard" data-placement="bottom" href="http://localhost/stockfeb2017/welcome"><i class="fa fa-dashboard"></i></a></li>
                                        <li class="dropdown hidden-sm">
                        <a class="btn tip" title="Settings" data-placement="bottom" href="http://localhost/stockfeb2017/system_settings">
                            <i class="fa fa-cogs"></i>
                        </a>
                    </li>
                                        <li class="dropdown hidden-xs">
                        <a class="btn tip" title="Calculator" data-placement="bottom" href="#" data-toggle="dropdown">
                            <i class="fa fa-calculator"></i>
                        </a>
                        <ul class="dropdown-menu pull-right calc">
                            <li class="dropdown-content">
                                <span id="inlineCalc"></span>
                            </li>
                        </ul>
                    </li>
                                                            <li class="dropdown hidden-xs">
                        <a class="btn tip" title="Calendar" data-placement="bottom" href="http://localhost/stockfeb2017/calendar">
                            <i class="fa fa-calendar"></i>
                        </a>
                    </li>
                                        <li class="dropdown hidden-sm">
                        <a class="btn tip" title="Styles" data-placement="bottom" data-toggle="dropdown"
                           href="#">
                            <i class="fa fa-css3"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li class="bwhite noPadding">
                                <a href="#" id="fixed" class="">
                                    <i class="fa fa-angle-double-left"></i>
                                    <span id="fixedText">Fixed</span>
                                </a>
                                <a href="#" id="cssLight" class="grey">
                                    <i class="fa fa-stop"></i> Grey
                                </a> 
                                <a href="#" id="cssBlue" class="blue">
                                    <i class="fa fa-stop"></i> Blue
                                </a> 
                                <a href="#" id="cssBlack" class="black">
                                   <i class="fa fa-stop"></i> Black
                               </a>
                           </li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a class="btn tip" title="Language" data-placement="bottom" data-toggle="dropdown"
                           href="#">
                            <img src="http://localhost/stockfeb2017/assets/images/english.png" alt="">
                        </a>
                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/arabic">
                                        <img src="http://localhost/stockfeb2017/assets/images/arabic.png" class="language-img"> 
                                        &nbsp;&nbsp;Arabic                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/english">
                                        <img src="http://localhost/stockfeb2017/assets/images/english.png" class="language-img"> 
                                        &nbsp;&nbsp;English                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/german">
                                        <img src="http://localhost/stockfeb2017/assets/images/german.png" class="language-img"> 
                                        &nbsp;&nbsp;German                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/portuguese-brazilian">
                                        <img src="http://localhost/stockfeb2017/assets/images/portuguese-brazilian.png" class="language-img"> 
                                        &nbsp;&nbsp;Portuguese-brazilian                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/simplified-chinese">
                                        <img src="http://localhost/stockfeb2017/assets/images/simplified-chinese.png" class="language-img"> 
                                        &nbsp;&nbsp;Simplified-chinese                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/spanish">
                                        <img src="http://localhost/stockfeb2017/assets/images/spanish.png" class="language-img"> 
                                        &nbsp;&nbsp;Spanish                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/thai">
                                        <img src="http://localhost/stockfeb2017/assets/images/thai.png" class="language-img"> 
                                        &nbsp;&nbsp;Thai                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/traditional-chinese">
                                        <img src="http://localhost/stockfeb2017/assets/images/traditional-chinese.png" class="language-img"> 
                                        &nbsp;&nbsp;Traditional-chinese                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/turkish">
                                        <img src="http://localhost/stockfeb2017/assets/images/turkish.png" class="language-img"> 
                                        &nbsp;&nbsp;Turkish                                    </a>
                                </li>
                                                            <li>
                                    <a href="http://localhost/stockfeb2017/welcome/language/vietnamese">
                                        <img src="http://localhost/stockfeb2017/assets/images/vietnamese.png" class="language-img"> 
                                        &nbsp;&nbsp;Vietnamese                                    </a>
                                </li>
                                                        <li class="divider"></li>
                            <li>
                                <a href="http://localhost/stockfeb2017/welcome/toggle_rtl">
                                    <i class="fa fa-align-left"></i>
                                    Toggle Alignment                                </a>
                            </li>
                        </ul>
                    </li>
                                      <!--  <li class="dropdown hidden-sm">
                        <a class="btn blightOrange tip" title="New update available, please update now." 
                            data-placement="bottom" data-container="body" href="http://localhost/stockfeb2017/system_settings/updates">
                            <i class="fa fa-download"></i>
                        </a>
                    </li>-->
                                                                    <li class="dropdown hidden-sm">
                            <a class="btn blightOrange tip" title="Alerts" 
                                data-placement="left" data-toggle="dropdown" href="#">
                                <i class="fa fa-exclamation-triangle"></i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="http://localhost/stockfeb2017/reports/quantity_alerts" class="">
                                        <span class="label label-danger pull-right" style="margin-top:3px;">6</span>
                                        <span style="padding-right: 35px;">Quantity Alerts</span>
                                    </a>
                                </li>
                                                                <li>
                                    <a href="http://localhost/stockfeb2017/reports/expiry_alerts" class="">
                                        <span class="label label-danger pull-right" style="margin-top:3px;">0</span>
                                        <span style="padding-right: 35px;">Expiry Alerts</span>
                                    </a>
                                </li>
                                                            </ul>
                        </li>
                                                            <li class="dropdown hidden-xs">
                        <a class="btn bdarkGreen tip" title="POS" data-placement="bottom" href="http://localhost/stockfeb2017/pos">
                            <i class="fa fa-th-large"></i> <span class="padding05">POS</span>
                        </a>
                    </li>
                                                                <li class="dropdown">
                            <a class="btn bdarkGreen tip" id="today_profit" title="<span>Today's Profit</span>" 
                                data-placement="bottom" data-html="true" href="http://localhost/stockfeb2017/reports/profit" 
                                data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-hourglass-2"></i>
                            </a>
                        </li>
                                                                                <li class="dropdown hidden-xs">
                        <a class="btn bblue tip" title="List Open Registers" data-placement="bottom" href="http://localhost/stockfeb2017/pos/registers">
                            <i class="fa fa-list"></i>
                        </a>
                    </li>
                                        <li class="dropdown hidden-xs">
                        <a class="btn bred tip" title="Clear all locally saved data" data-placement="bottom" id="clearLS" href="#">
                            <i class="fa fa-eraser"></i>
                        </a>
                    </li>
                                    </ul>
            </div>
        </div>
    </header>

    <div class="container" id="container">
        <div class="row" id="main-con">
        <table class="lt"><tr><td class="sidebar-con">
            <div id="sidebar-left">
                <div class="sidebar-nav nav-collapse collapse navbar-collapse" id="sidebar_menu">
                    <ul class="nav main-menu">
                        <li class="mm_welcome">
                            <a href="http://localhost/stockfeb2017/">
                                <i class="fa fa-dashboard"></i>
                                <span class="text"> Dashboard</span>
                            </a>
                        </li>

                        
                            <li class="mm_products">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-barcode"></i>
                                    <span class="text"> Products </span>
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="products_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products">
                                            <i class="fa fa-barcode"></i>
                                            <span class="text"> List Products</span>
                                        </a>
                                    </li>
                                    <li id="products_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/add">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Product</span>
                                        </a>
                                    </li>
                                    <li id="products_import_csv">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/import_csv">
                                            <i class="fa fa-file-text"></i>
                                            <span class="text"> Import Products</span>
                                        </a>
                                    </li>
                                    <li id="products_print_barcodes">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/print_barcodes">
                                            <i class="fa fa-tags"></i>
                                            <span class="text"> Print Barcode/Label</span>
                                        </a>
                                    </li>
                                    <li id="products_quantity_adjustments">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/quantity_adjustments">
                                            <i class="fa fa-filter"></i>
                                            <span class="text"> Quantity Adjustments</span>
                                        </a>
                                    </li>
                                    <li id="products_add_adjustment">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/add_adjustment">
                                            <i class="fa fa-filter"></i>
                                            <span class="text"> Add Adjustment</span>
                                        </a>
                                    </li>
                                    <li id="products_stock_counts">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/stock_counts">
                                            <i class="fa fa-list-ol"></i>
                                            <span class="text"> Stock Counts</span>
                                        </a>
                                    </li>
                                    <li id="products_count_stock">
                                        <a class="submenu" href="http://localhost/stockfeb2017/products/count_stock">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Count Stock</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_sales ">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-heart"></i>
                                    <span class="text"> Sales 
                                    </span> <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="sales_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales">
                                            <i class="fa fa-heart"></i>
                                            <span class="text"> List Sales</span>
                                        </a>
                                    </li>
                                                                        <li id="pos_sales">
                                        <a class="submenu" href="http://localhost/stockfeb2017/pos/sales">
                                            <i class="fa fa-heart"></i>
                                            <span class="text"> POS Sales</span>
                                        </a>
                                    </li>
                                                                        <li id="sales_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales/add">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Sale</span>
                                        </a>
                                    </li>
                                    <li id="sales_sale_by_csv">
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales/sale_by_csv">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Sale by CSV</span>
                                        </a>
                                    </li>
                                    <li id="sales_deliveries">
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales/deliveries">
                                            <i class="fa fa-truck"></i>
                                            <span class="text"> Deliveries</span>
                                        </a>
                                    </li>
                                    <li id="sales_gift_cards">
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales/gift_cards">
                                            <i class="fa fa-gift"></i>
                                            <span class="text"> List Gift Cards</span>
                                        </a>
                                    </li>
                                    <!--<li id="sales_reconcile">
                                        
                                        <a class="submenu" href="http://localhost/stockfeb2017/sales/reconcile">
                                            <i class="fa fa-heart"></i> 
                                            <span class="text"> Reconcile Sales</span>
                                            
                                        </a>
                                    </li>-->
                                    
                                </ul>
                            </li>

                            <li class="mm_quotes">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span class="text"> Quotations </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="quotes_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/quotes">
                                            <i class="fa fa-heart-o"></i>
                                            <span class="text"> List Quotation</span>
                                        </a>
                                    </li>
                                    <li id="quotes_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/quotes/add">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Quotation</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_purchases">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star"></i>
                                    <span class="text"> Purchases 
                                    </span> <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="purchases_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/purchases">
                                            <i class="fa fa-star"></i>
                                            <span class="text"> List Purchases</span>
                                        </a>
                                    </li>
                                    <li id="purchases_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/purchases/add">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Purchase</span>
                                        </a>
                                    </li>
                                    <li id="purchases_purchase_by_csv">
                                        <a class="submenu" href="http://localhost/stockfeb2017/purchases/purchase_by_csv">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Purchase by CSV</span>
                                        </a>
                                    </li>
                                    <li id="purchases_expenses">
                                        <a class="submenu" href="http://localhost/stockfeb2017/purchases/expenses">
                                            <i class="fa fa-dollar"></i>
                                            <span class="text"> List Expenses</span>
                                        </a>
                                    </li>
                                    <li id="purchases_add_expense">
                                        <a class="submenu" href="http://localhost/stockfeb2017/purchases/add_expense" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i>
                                            <span class="text"> Add Expense</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_transfers">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star-o"></i>
                                    <span class="text"> Transfers </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="transfers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/transfers">
                                            <i class="fa fa-star-o"></i><span class="text"> List Transfers</span>
                                        </a>
                                    </li>
                                    <li id="transfers_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/transfers/add">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Transfer</span>
                                        </a>
                                    </li>
                                    <li id="transfers_purchase_by_csv">
                                        <a class="submenu" href="http://localhost/stockfeb2017/transfers/transfer_by_csv">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Transfer by CSV</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="mm_store_request">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star-o"></i>
                                    <span class="text"> Store Requests </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="transfers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/store_request">
                                            <i class="fa fa-star-o"></i><span class="text"> List Store Requests</span>
                                        </a>
                                    </li>
                                    <li id="transfers_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/store_request/add">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Store Request</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="mm_warehouse_request">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star-o"></i>
                                    <span class="text"> Warehouse Requests </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="transfers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/warehouse_request">
                                            <i class="fa fa-star-o"></i><span class="text"> List Warehouse Requests</span>
                                        </a>
                                    </li>
                                    <li id="transfers_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/warehouse_request/add">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Warehouse Request</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_salespoint_request">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star-o"></i>
                                    <span class="text"> Salespoint Requests </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="transfers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/salespoint_request">
                                            <i class="fa fa-star-o"></i><span class="text"> List Salespoint Requests</span>
                                        </a>
                                    </li>
                                    <li id="transfers_add">
                                        <a class="submenu" href="http://localhost/stockfeb2017/salespoint_request/add">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Salespoint Request</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_hrmanager">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-star-o"></i>
                                    <span class="text"> HR Manager </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="add_employee">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/add_employee">
                                            <i class="fa fa-star-o"></i><span class="text"> Add Employee</span>
                                        </a>
                                    </li>
                                    <li id="employeeview">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/employeeview">
                                            <i class="fa fa-plus-circle"></i><span class="text"> View Employee</span>
                                        </a>
                                    </li>
                                    <li id="employees_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/employees_index">
                                            <i class="fa fa-plus-circle"></i><span class="text"> List Employees</span>
                                        </a>
                                    </li>
                                    <li id="add_designation">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/add_designation">
                                            <i class="fa fa-plus-circle"></i><span class="text"> add designation</span>
                                        </a>
                                    </li>
                                    <li id="designation_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/designation_index">
                                            <i class="fa fa-plus-circle"></i><span class="text"> designation index</span>
                                        </a>
                                    </li>
                                    <li id="viewloyaltycard">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/viewloyaltycard">
                                            <i class="fa fa-plus-circle"></i><span class="text"> View Loyalty Card</span>
                                        </a>
                                    </li>
                                    <li id="add_paid_loyaltycard">
                                        <a class="submenu" href="http://localhost/stockfeb2017/hrmanager/add_paid_loyaltycard">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Paid Loyalty Card</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="mm_auth mm_customers mm_suppliers mm_billers">
                                <a class="dropmenu" href="#">
                                <i class="fa fa-users"></i>
                                <span class="text"> People </span> 
                                <span class="chevron closed"></span>
                                </a>
                                <ul>
                                                                        <li id="auth_users">
                                        <a class="submenu" href="http://localhost/stockfeb2017/users">
                                            <i class="fa fa-users"></i><span class="text"> List Users</span>
                                        </a>
                                    </li>
                                    <li id="auth_create_user">
                                        <a class="submenu" href="http://localhost/stockfeb2017/users/create_user">
                                            <i class="fa fa-user-plus"></i><span class="text"> Add User</span>
                                        </a>
                                    </li>
                                    <li id="billers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/billers">
                                            <i class="fa fa-users"></i><span class="text"> List Billers</span>
                                        </a>
                                    </li>
                                    <li id="billers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/billers/add" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Biller</span>
                                        </a>
                                    </li>
                                    <li id="billers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/salesman">
                                            <i class="fa fa-users"></i><span class="text"> List Salesman</span>
                                        </a>
                                    </li>
                                    <li id="billers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/salesman/add" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Sales Man</span>
                                        </a>
                                    </li>
                                                                        <li id="customers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/customers">
                                            <i class="fa fa-users"></i><span class="text"> List Customers</span>
                                        </a>
                                    </li>
                                    <li id="customers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/customers/add" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Customer</span>
                                        </a>
                                    </li>
                                    <li id="suppliers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/suppliers">
                                            <i class="fa fa-users"></i><span class="text"> List Suppliers</span>
                                        </a>
                                    </li>
                                    <li id="suppliers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/suppliers/add" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Supplier</span>
                                        </a>
                                    </li>
                                    <li id="suppliers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/main_suppliers">
                                            <i class="fa fa-users"></i><span class="text"> List Main Suppliers</span>
                                        </a>
                                    </li>
                                    <li id="suppliers_index">
                                        <a class="submenu" href="http://localhost/stockfeb2017/main_suppliers/add" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-plus-circle"></i><span class="text"> Add Main Supplier</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="mm_notifications">
                                <a class="submenu" href="http://localhost/stockfeb2017/notifications">
                                    <i class="fa fa-info-circle"></i><span class="text"> Notifications</span>
                                </a>
                            </li>
                                                            <li class="mm_system_settings mm_pos">
                                    <a class="dropmenu" href="#">
                                        <i class="fa fa-cog"></i><span class="text"> Settings </span> 
                                        <span class="chevron closed"></span>
                                    </a>
                                    <ul>
                                        <li id="system_settings_index">
                                            <a href="http://localhost/stockfeb2017/system_settings">
                                                <i class="fa fa-cog"></i><span class="text"> System Settings</span>
                                            </a>
                                        </li>
                                                                                <li id="pos_settings">
                                            <a href="http://localhost/stockfeb2017/pos/settings">
                                                <i class="fa fa-th-large"></i><span class="text"> POS Settings</span>
                                            </a>
                                        </li>
                                        <li id="pos_printers">
                                            <a href="http://localhost/stockfeb2017/pos/printers">
                                                <i class="fa fa-print"></i><span class="text"> List Printers</span>
                                            </a>
                                        </li>
                                        <li id="pos_add_printer">
                                            <a href="http://localhost/stockfeb2017/pos/add_printer">
                                                <i class="fa fa-plus-circle"></i><span class="text"> Add Printer</span>
                                            </a>
                                        </li>
                                                                                <li id="system_settings_change_logo">
                                            <a href="http://localhost/stockfeb2017/system_settings/change_logo" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-upload"></i><span class="text"> Change Logo</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_currencies">
                                            <a href="http://localhost/stockfeb2017/system_settings/currencies">
                                                <i class="fa fa-money"></i><span class="text"> Currencies</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_customer_groups">
                                            <a href="http://localhost/stockfeb2017/system_settings/customer_groups">
                                                <i class="fa fa-chain"></i><span class="text"> Customer Groups</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_price_groups">
                                            <a href="http://localhost/stockfeb2017/system_settings/price_groups">
                                                <i class="fa fa-dollar"></i><span class="text"> Price Groups</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_categories">
                                            <a href="http://localhost/stockfeb2017/system_settings/categories">
                                                <i class="fa fa-folder-open"></i><span class="text"> Categories</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_expense_categories">
                                            <a href="http://localhost/stockfeb2017/system_settings/expense_categories">
                                                <i class="fa fa-folder-open"></i><span class="text"> Expense Categories</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_units">
                                            <a href="http://localhost/stockfeb2017/system_settings/units">
                                                <i class="fa fa-wrench"></i><span class="text"> Units</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_brands">
                                            <a href="http://localhost/stockfeb2017/system_settings/brands">
                                                <i class="fa fa-th-list"></i><span class="text"> Brands</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_variants">
                                            <a href="http://localhost/stockfeb2017/system_settings/variants">
                                                <i class="fa fa-tags"></i><span class="text"> Variants</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_tax_rates">
                                            <a href="http://localhost/stockfeb2017/system_settings/tax_rates">
                                                <i class="fa fa-plus-circle"></i><span class="text"> Tax Rates</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_warehouses">
                                            <a href="http://localhost/stockfeb2017/system_settings/warehouses">
                                                <i class="fa fa-building-o"></i><span class="text"> Warehouses</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_stores">
                                            <a href="http://localhost/stockfeb2017/system_settings/stores">
                                                <i class="fa fa-joomla"></i><span class="text"> Stores</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_salespoints">
                                            <a href="http://localhost/stockfeb2017/system_settings/salespoints">
                                                <i class="fa fa-joomla"></i><span class="text"> Salespoints</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_email_templates">
                                            <a href="http://localhost/stockfeb2017/system_settings/email_templates">
                                                <i class="fa fa-envelope"></i><span class="text"> Email Templates</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_user_groups">
                                            <a href="http://localhost/stockfeb2017/system_settings/user_groups">
                                                <i class="fa fa-key"></i><span class="text"> Group Permissions</span>
                                            </a>
                                        </li>
                                        <li id="system_settings_backups">
                                            <a href="http://localhost/stockfeb2017/system_settings/backups">
                                                <i class="fa fa-database"></i><span class="text"> Backups</span>
                                            </a>
                                        </li>
                                       <!-- <li id="system_settings_updates">
                                            <a href="http://localhost/stockfeb2017/system_settings/updates">
                                                <i class="fa fa-upload"></i><span class="text"> Updates</span>
                                            </a>
                                        </li>-->
                                    </ul>
                                </li>
                                                        <li class="mm_reports">
                                <a class="dropmenu" href="#">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <span class="text"> Reports </span> 
                                    <span class="chevron closed"></span>
                                </a>
                                <ul>
                                    <li id="reports_index">
                                        <a href="http://localhost/stockfeb2017/reports">
                                            <i class="fa fa-bars"></i><span class="text"> Overview Chart</span>
                                        </a>
                                    </li>
                                    <li id="reports_warehouse_stock">
                                        <a href="http://localhost/stockfeb2017/reports/warehouse_stock_flow">
                                            <i class="fa fa-building"></i><span class="text"> Warehouse Stock Flow</span>
                                        </a>
                                    </li>
                                    <li id="reports_warehouse_stock">
                                        <a href="http://localhost/stockfeb2017/reports/warehouse_stock">
                                            <i class="fa fa-building"></i><span class="text"> Warehouse Stock Chart</span>
                                        </a>
                                    </li>
                                    <li id="reports_best_sellers">
                                        <a href="http://localhost/stockfeb2017/reports/best_sellers">
                                            <i class="fa fa-line-chart"></i><span class="text"> Best Sellers</span>
                                        </a>
                                    </li>
                                                                        <li id="reports_register">
                                        <a href="http://localhost/stockfeb2017/reports/register">
                                            <i class="fa fa-th-large"></i><span class="text"> Register Report</span>
                                        </a>
                                    </li>
                                                                        <li id="reports_quantity_alerts">
                                        <a href="http://localhost/stockfeb2017/reports/quantity_alerts">
                                            <i class="fa fa-bar-chart-o"></i><span class="text"> Product Quantity Alerts</span>
                                        </a>
                                    </li>
                                                                        <li id="reports_expiry_alerts">
                                        <a href="http://localhost/stockfeb2017/reports/expiry_alerts">
                                            <i class="fa fa-bar-chart-o"></i><span class="text"> Product Expiry Alerts</span>
                                        </a>
                                    </li>
                                                                        <li id="reports_products">
                                        <a href="http://localhost/stockfeb2017/reports/products">
                                            <i class="fa fa-barcode"></i><span class="text"> Products Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_adjustments">
                                        <a href="http://localhost/stockfeb2017/reports/adjustments">
                                            <i class="fa fa-filter"></i><span class="text"> Adjustments Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_categories">
                                        <a href="http://localhost/stockfeb2017/reports/categories">
                                            <i class="fa fa-folder-open"></i><span class="text"> Categories Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_brands">
                                        <a href="http://localhost/stockfeb2017/reports/brands">
                                            <i class="fa fa-cubes"></i><span class="text"> Brands Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_daily_sales">
                                        <a href="http://localhost/stockfeb2017/reports/daily_sales">
                                            <i class="fa fa-calendar"></i><span class="text"> Daily Sales</span>
                                        </a>
                                    </li>
                                    <li id="reports_monthly_sales">
                                        <a href="http://localhost/stockfeb2017/reports/monthly_sales">
                                            <i class="fa fa-calendar"></i><span class="text"> Monthly Sales</span>
                                        </a>
                                    </li>
                                    <li id="reports_sales">
                                        <a href="http://localhost/stockfeb2017/reports/sales">
                                            <i class="fa fa-heart"></i><span class="text"> Sales Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_payments">
                                        <a href="http://localhost/stockfeb2017/reports/payments">
                                            <i class="fa fa-money"></i><span class="text"> Payments Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_profit_loss">
                                        <a href="http://localhost/stockfeb2017/reports/profit_loss">
                                            <i class="fa fa-money"></i><span class="text"> Profit and/or Loss/Net Worth</span>
                                        </a>
                                    </li>
                                    <li id="reports_daily_purchases">
                                        <a href="http://localhost/stockfeb2017/reports/daily_purchases">
                                            <i class="fa fa-calendar"></i><span class="text"> Daily Purchases</span>
                                        </a>
                                    </li>
                                    <li id="reports_monthly_purchases">
                                        <a href="http://localhost/stockfeb2017/reports/monthly_purchases">
                                            <i class="fa fa-calendar"></i><span class="text"> Monthly Purchases</span>
                                        </a>
                                    </li>
                                    <li id="reports_purchases">
                                        <a href="http://localhost/stockfeb2017/reports/purchases">
                                            <i class="fa fa-star"></i><span class="text"> Purchases Report</span>
                                        </a>
                                    </li>
                                    <!--<li id="reports_salesbysalespoint">
                                        <a href="http://localhost/stockfeb2017/reports/salesbysalespoint">
                                            <i class="fa fa-star"></i><span class="text">Sales by Salespoint Report</span>
                                        </a>
                                    </li>-->

                                    <li id="reports_storesproducts">
                                        <a href="http://localhost/stockfeb2017/reports/storesproducts">
                                            <i class="fa fa-star"></i><span class="text"> Store Products Report</span>
                                        </a>
                                    </li>

                                   <!--<li id="reports_salespointsproducts">
                                        <a href="http://localhost/stockfeb2017/reports/salespointsproducts">
                                            <i class="fa fa-star"></i><span class="text">Salespoint Products Report</span>
                                        </a>
                                    </li>

                                    <li id="reports_unclearedbalances">
                                        <a href="http://localhost/stockfeb2017/reports/unclearedbalances">
                                            <i class="fa fa-star"></i><span class="text">Uncleared Balance Report</span>
                                        </a>
                                    </li>-->
                                    <li id="reports_unclearedbalances">
                                        <a href="http://localhost/stockfeb2017/reports/paymentdetailsbysalespoint">
                                            <i class="fa fa-star"></i><span class="text">Payment Details by Salespoint</span>
                                        </a>
                                    </li>
                                    <li id="reports_unclearedbalances">
                                        <a href="http://localhost/stockfeb2017/reports/salesreportsbysalespoint">
                                            <i class="fa fa-star"></i><span class="text"> Sales by Salespoint Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_adminmanagepurchases">
                                        <a href="http://localhost/stockfeb2017/purchases/adminmanagepurchases">
                                            <i class="fa fa-star"></i><span class="text"> Manage Purchases</span>
                                        </a>
                                    </li>
                                    <li id="reports_expenses">
                                        <a href="http://localhost/stockfeb2017/reports/expenses">
                                            <i class="fa fa-star"></i><span class="text"> Expenses Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_customer_report">
                                        <a href="http://localhost/stockfeb2017/reports/customers">
                                            <i class="fa fa-users"></i><span class="text"> Customers Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_supplier_report">
                                        <a href="http://localhost/stockfeb2017/reports/suppliers">
                                            <i class="fa fa-users"></i><span class="text"> Suppliers Report</span>
                                        </a>
                                    </li>
                                    <li id="reports_staff_report">
                                        <a href="http://localhost/stockfeb2017/reports/users">
                                            <i class="fa fa-users"></i><span class="text"> Staff Report</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                                            </ul>
                </div>
                <a href="#" id="main-menu-act" class="full visible-md visible-lg">
                    <i class="fa fa-angle-double-left"></i>
                </a>
            </div>
            </td><td class="content-con">
            <div id="content">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="http://localhost/stockfeb2017/">Home</a></li><li class="active">Products</li>                            <li class="right_log hidden-xs">
                                Your IP Address <?=get_ip_address();?> <span class='hidden-sm'>( Last login at: <?= $last_login_time;?> )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                                                                                        <div class="alerts-con"></div>
<style type="text/css" media="screen">
    #PRData td:nth-child(7) {
        text-align: right;
    }
        #PRData td:nth-child(9) {
        text-align: right;
    }
        #PRData td:nth-child(8) {
        text-align: right;
    }
    </style>
<script>
    var oTable;
    $(document).ready(function () {
        oTable = $('#PRData').dataTable({
            "aaSorting": [[2, "asc"], [3, "asc"]],
            "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            "iDisplayLength": 10,
            'bProcessing': true, 'bServerSide': true,
            'sAjaxSource': 'http://localhost/stockfeb2017/products/getProducts',
            'fnServerData': function (sSource, aoData, fnCallback) {
                aoData.push({
                    "name": "token",
                    "value": "d6bcbbcd69eb572072063744c9bb3bc3"
                });
                $.ajax({'dataType': 'json', 'type': 'POST', 'url': sSource, 'data': aoData, 'success': fnCallback});
            },
            'fnRowCallback': function (nRow, aData, iDisplayIndex) {
                var oSettings = oTable.fnSettings();
                nRow.id = aData[0];
                nRow.className = "product_link";
                //if(aData[7] > aData[9]){ nRow.className = "product_link warning"; } else { nRow.className = "product_link"; }
                return nRow;
            },
            "aoColumns": [
                {"bSortable": false, "mRender": checkbox}, {"bSortable": false,"mRender": img_hl}, null, null, null, null, {"mRender": currencyFormat}, {"mRender": currencyFormat}, {"mRender": formatQuantity}, null, {"bVisible": false}, {"mRender": formatQuantity}, {"bSortable": false}
            ]
        }).fnSetFilteringDelay().dtFilter([
            {column_number: 2, filter_default_label: "[Code]", filter_type: "text", data: []},
            {column_number: 3, filter_default_label: "[Name]", filter_type: "text", data: []},
            {column_number: 4, filter_default_label: "[Brand]", filter_type: "text", data: []},
            {column_number: 5, filter_default_label: "[Category]", filter_type: "text", data: []},
            {column_number : 6, filter_default_label: "[Cost]", filter_type: "text", data: [] },{column_number : 7, filter_default_label: "[Price]", filter_type: "text", data: [] },            {column_number: 8, filter_default_label: "[Quantity]", filter_type: "text", data: []},
            {column_number: 9, filter_default_label: "[Unit]", filter_type: "text", data: []},
                        {column_number: 11, filter_default_label: "[Alert Quantity]", filter_type: "text", data: []},
        ], "footer");

    });
</script>
<form action="http://localhost/stockfeb2017/products/product_actions" id="action-form" method="post" accept-charset="utf-8">
      <input type="hidden" name="token" value="d6bcbbcd69eb572072063744c9bb3bc3" />
<div class="box">
    <div class="box-header">
        <h2 class="blue"><i
                class="fa-fw fa fa-barcode"></i>Products (All Warehouses)        </h2>

        <div class="box-icon">
            <ul class="btn-tasks">
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon fa fa-tasks tip" data-placement="left" title="Actions"></i>
                    </a>
                    <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                        <li>
                            <a href="http://localhost/stockfeb2017/products/add">
                                <i class="fa fa-plus-circle"></i> Add Product                            </a>
                        </li>
                                                <li>
                            <a href="http://localhost/stockfeb2017/products/update_price" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-file-excel-o"></i> Update Price                            </a>
                        </li>
                                                <li>
                            <a href="#" id="labelProducts" data-action="labels">
                                <i class="fa fa-print"></i> Print Barcode/Label                            </a>
                        </li>
                        <li>
                            <a href="#" id="sync_quantity" data-action="sync_quantity">
                                <i class="fa fa-arrows-v"></i> Sync Quantity                            </a>
                        </li>
                        <li>
                            <a href="#" id="returndamaged" data-action="returndamaged">
                                <i class="fa fa-arrows-v"></i> Return Damaged product
                            </a>
                        </li>
                        <li>
                            <a href="#" id="excel" data-action="export_excel">
                                <i class="fa fa-file-excel-o"></i> Export to Excel file                            </a>
                        </li>
                        <li>
                            <a href="#" id="pdf" data-action="export_pdf">
                                <i class="fa fa-file-pdf-o"></i> Export to PDF file                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="bpo" title="<b>Delete Products</b>"
                                data-content="<p>Are you sure?</p><button type='button' class='btn btn-danger' id='delete' data-action='delete'>Yes I'm sure</a> <button class='btn bpo-close'>No</button>"
                                data-html="true" data-placement="left">
                            <i class="fa fa-trash-o"></i> Delete Products                             </a>
                         </li>
                    </ul>
                </li>
                                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon fa fa-building-o tip" data-placement="left" title="Warehouses"></i></a>
                        <ul class="dropdown-menu pull-right tasks-menus" role="menu" aria-labelledby="dLabel">
                            <li><a href="http://localhost/stockfeb2017/products"><i class="fa fa-building-o"></i> All Warehouses</a></li>
                            <li class="divider"></li>
                            <li><a href="http://localhost/stockfeb2017/products/1"><i class="fa fa-building"></i>Warehouse 1</a></li><li><a href="http://localhost/stockfeb2017/products/2"><i class="fa fa-building"></i>Warehouse 2</a></li><li><a href="http://localhost/stockfeb2017/products/3"><i class="fa fa-building"></i>Warehouse 3</a></li>                        </ul>
                    </li>
                            </ul>
        </div>
    </div>
    <div class="box-content">
        <div class="row">
            <div class="col-lg-12">
                <p class="introtext">Please use the table below to navigate or filter the results. You can download the table as excel and pdf.</p>

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
    <div style="display: none;">
        <input type="hidden" name="form_action" value="" id="form_action"/>
        <input type="submit" name="performAction" value="performAction"  id="action-form-submit" />
    </div>
    </form><div class="clearfix"></div>
</div></div></div></td></tr></table></div></div><div class="clearfix"></div>
<footer>
<a href="#" id="toTop" class="blue" style="position: fixed; bottom: 30px; right: 30px; font-size: 30px; display: none;">
    <i class="fa fa-chevron-circle-up"></i>
</a>

    <p style="text-align:center;">&copy; 2017 DeNobelAS 
      - Page rendered in <strong>0.3930</strong> seconds</p>
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
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery.dataTables.dtFilter.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/select2.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/custom.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/jquery.calculator.min.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/core.js"></script>
<script type="text/javascript" src="http://localhost/stockfeb2017/themes/default/assets/js/perfect-scrollbar.min.js"></script>

<script type="text/javascript" charset="UTF-8">var oTable = '', r_u_sure = "Are you sure?";
    (function ($) { "use strict"; $.fn.select2.locales['sma'] = { formatMatches: function (matches) { if (matches === 1) { return "One result is available, press enter to select it."; } return matches + "results are available, use up and down arrow keys to navigate."; }, formatNoMatches: function () { return "No matches found"; }, formatInputTooShort: function (input, min) { var n = min - input.length; return "Please type "+n+" or more characters"; }, formatInputTooLong: function (input, max) { var n = input.length - max; if(n == 1) { return "Please delete "+n+" character"; } else { return "Please delete "+n+" characters"; } }, formatSelectionTooBig: function (n) { if(n == 1) { return "You can only select "+n+" item"; } else { return "You can only select "+n+" items"; } }, formatLoadMore: function (pageNumber) { return "Loading more results..."; }, formatSearching: function () { return "Searching..."; }, formatAjaxError: function() { return "Ajax request failed"; }, }; $.extend($.fn.select2.defaults, $.fn.select2.locales['sma']); })(jQuery);    $.extend(true, $.fn.dataTable.defaults, {"oLanguage":{"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}});
    $.fn.datetimepicker.dates['sma'] = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]};
    $(window).load(function () {
        $('.mm_products').addClass('active');
        $('.mm_products').find("ul").first().slideToggle();
        $('#products_index').addClass('active');
        $('.mm_products a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
