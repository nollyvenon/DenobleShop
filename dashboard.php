<?php
require_once("includes/initialize_admin.php");
if (!$session_admin->is_logged_in()) {
    redirect_to("log-in");
}
if ($_GET['msg'] == '10'){
	   $message_error .= "You do not have right to that page or feature. Regards.";
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <base href="http://localhost/stockfeb2017/"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ZentaBooks</title>
    <link rel="shortcut icon" href="<?php echo SITE_ASSETS;?>/images/icon.png"/>
    <link href="<?php echo SITE_ASSETS;?>/styles/theme.css" rel="stylesheet"/>
    <link href="<?php echo SITE_ASSETS.'/styles/style.css';?>" rel="stylesheet"/>
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
    <?php include 'includsin/header.php';?>

    <div class="container" id="container">
        <div class="row" id="main-con">
        <table class="lt"><tr><td class="sidebar-con">
            <?php include 'includsin/sidebar.php';?>
            </td><td class="content-con">
            <div id="content">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <ul class="breadcrumb">
                            <li class="active">Dashboard</li>                            <li class="right_log hidden-xs">
                                Your IP Address 127.0.0.1 <span class='hidden-sm'>( Last login at: 15/06/2017 23:42  )</span>                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                                                    <?php require_once 'layouts/feedback_message.php'; ?>
                                                                                                                        <div class="alerts-con"></div>
    <div class="box" style="margin-bottom: 15px;">
        <div class="box-header">
            <h2 class="blue"><i class="fa-fw fa fa-bar-chart-o"></i>Overview Chart</h2>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-md-12">
                    <p class="introtext">Stock Overview Chart including monthly sales with product tax and  order tax (columns), purchases (line) and current stock value by cost and price (pie). You can save the graph as jpg, png and pdf.</p>

                    <div id="ov-chart" style="width:100%; height:450px;"></div>
                    <p class="text-center">You can change chart by clicking the chart legend. Click any legend above to show/hide it in chart.</p>
                </div>
            </div>
        </div>
    </div>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa fa-th"></i><span class="break"></span>Quick Links</h2>
            </div>
            <div class="box-content">
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bblue white quick-button small" href="http://localhost/stockfeb2017/products">
                        <i class="fa fa-barcode"></i>

                        <p>Products</p>
                    </a>
                </div>
                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bdarkGreen white quick-button small" href="http://localhost/stockfeb2017/sales">
                        <i class="fa fa-heart"></i>

                        <p>Sales</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="blightOrange white quick-button small" href="http://localhost/stockfeb2017/quotes">
                        <i class="fa fa-heart-o"></i>

                        <p>Quotations</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bred white quick-button small" href="http://localhost/stockfeb2017/purchases">
                        <i class="fa fa-star"></i>

                        <p>Purchases</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bpink white quick-button small" href="http://localhost/stockfeb2017/transfers">
                        <i class="fa fa-star-o"></i>

                        <p>Transfers</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bgrey white quick-button small" href="http://localhost/stockfeb2017/customers">
                        <i class="fa fa-users"></i>

                        <p>Customers</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="bgrey white quick-button small" href="http://localhost/stockfeb2017/suppliers">
                        <i class="fa fa-users"></i>

                        <p>Suppliers</p>
                    </a>
                </div>

                <div class="col-lg-1 col-md-2 col-xs-6">
                    <a class="blightBlue white quick-button small" href="http://localhost/stockfeb2017/notifications">
                        <i class="fa fa-comments"></i>

                        <p>Notifications</p>
                        <!--<span class="notification green">4</span>-->
                    </a>
                </div>

                                    <div class="col-lg-1 col-md-2 col-xs-6">
                        <a class="bblue white quick-button small" href="http://localhost/stockfeb2017/auth/users">
                            <i class="fa fa-group"></i>
                            <p>Users</p>
                        </a>
                    </div>
                    <div class="col-lg-1 col-md-2 col-xs-6">
                        <a class="bblue white quick-button small" href="http://localhost/stockfeb2017/system_settings">
                            <i class="fa fa-cogs"></i>

                            <p>Settings</p>
                        </a>
                    </div>
                                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="row" style="margin-bottom: 15px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h2 class="blue"><i class="fa-fw fa fa-tasks"></i> Latest Five</h2>
            </div>
            <div class="box-content">
                <div class="row">
                    <div class="col-md-12">

                        <ul id="dbTab" class="nav nav-tabs">
                                                        <li class=""><a href="#sales">Sales</a></li>
                                                        <li class=""><a href="#quotes">Quotations</a></li>
                                                        <li class=""><a href="#purchases">Purchases</a></li>
                                                        <li class=""><a href="#transfers">Transfers</a></li>
                                                        <li class=""><a href="#customers">Customers</a></li>
                                                        <li class=""><a href="#suppliers">Suppliers</a></li>
                                                    </ul>

                        <div class="tab-content">
                        
                            <div id="sales" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="sales-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Date</th>
                                                    <th>Reference No</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Payment Status</th>
                                                    <th>Paid</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="14" class="invoice_link"><td>1</td>
                                                            <td>11/06/2017 21:03</td>
                                                            <td>SALE/2017/06/0001</td>
                                                            <td>Jude</td>
                                                            <td><div class="text-center"><span class="label label-success">Completed</span></div></td>
                                                            <td class="text-right"> ₦280,000.00</td>
                                                            <td><div class="text-center"><span class="label label-info">Partial</span></div></td>
                                                            <td class="text-right"> ₦825,000.00</td>
                                                        </tr><tr id="13" class="invoice_link"><td>2</td>
                                                            <td>10/06/2017 00:00</td>
                                                            <td>SALE/2017/06/0004</td>
                                                            <td></td>
                                                            <td><div class="text-center"><span class="label label-success">Completed</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                            <td><div class="text-center"><span class="label label-info">Partial</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                        </tr><tr id="12" class="invoice_link"><td>3</td>
                                                            <td>10/06/2017 00:00</td>
                                                            <td>SALE/2017/06/0004</td>
                                                            <td></td>
                                                            <td><div class="text-center"><span class="label label-success">Completed</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                            <td><div class="text-center"><span class="label label-info">Partial</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                        </tr><tr id="11" class="invoice_link"><td>4</td>
                                                            <td>10/06/2017 00:00</td>
                                                            <td>SALE/2017/06/0004</td>
                                                            <td></td>
                                                            <td><div class="text-center"><span class="label label-success">Completed</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                            <td><div class="text-center"><span class="label label-info">Partial</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                        </tr><tr id="10" class="invoice_link"><td>5</td>
                                                            <td>10/06/2017 00:00</td>
                                                            <td>SALE/2017/06/0004</td>
                                                            <td></td>
                                                            <td><div class="text-center"><span class="label label-success">Completed</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                            <td><div class="text-center"><span class="label label-info">Partial</span></div></td>
                                                            <td class="text-right"> ₦0.00</td>
                                                        </tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="quotes" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="quotes-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Date</th>
                                                    <th>Reference No</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="1" class="quote_link"><td>1</td>
                                                        <td>02/03/2017 13:03</td>
                                                        <td>QUOTE/2017/03/0001</td>
                                                        <td>a</td>
                                                        <td><div class="text-center"><span class="label label-warning">Pending</span></div></td>
                                                        <td class="text-right"> ₦812,090.00</td>
                                                    </tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="purchases" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="purchases-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Date</th>
                                                    <th>Reference No</th>
                                                    <th>Supplier</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="12" class="purchase_link"><td>1</td>
                                                    <td>02/06/2017 10:42</td>
                                                    <td>PO/2017/06/0005</td>
                                                    <td>Phone World</td>
                                                    <td><div class="text-center"><span class="label label-success">Received</span></div></td>
                                                    <td class="text-right"> ₦1,830,000.00</td>
                                                </tr><tr id="11" class="purchase_link"><td>2</td>
                                                    <td>05/05/2017 11:37</td>
                                                    <td>PO/2017/05/0004</td>
                                                    <td>Phone World</td>
                                                    <td><div class="text-center"><span class="label label-success">Received</span></div></td>
                                                    <td class="text-right"> ₦7,100.00</td>
                                                </tr><tr id="10" class="purchase_link"><td>3</td>
                                                    <td>05/05/2017 10:20</td>
                                                    <td>PO/2017/05/0003</td>
                                                    <td>Phone World</td>
                                                    <td><div class="text-center"><span class="label label-success">Received</span></div></td>
                                                    <td class="text-right"> ₦3,265,000.00</td>
                                                </tr><tr id="8" class="purchase_link"><td>4</td>
                                                    <td>05/05/2017 07:05</td>
                                                    <td>PO/2017/05/0001</td>
                                                    <td>Phone World</td>
                                                    <td><div class="text-center"><span class="label label-success">Received</span></div></td>
                                                    <td class="text-right"> ₦810,000.00</td>
                                                </tr><tr id="7" class="purchase_link"><td>5</td>
                                                    <td>02/03/2017 23:44</td>
                                                    <td>PO/2017/03/0041</td>
                                                    <td>Phone World</td>
                                                    <td><div class="text-center"><span class="label label-success">Received</span></div></td>
                                                    <td class="text-right"> ₦591,000.00</td>
                                                </tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="transfers" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="transfers-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Date</th>
                                                    <th>Reference No</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                                                                    <tr>
                                                        <td colspan="7"
                                                            class="dataTables_empty">No data available</td>
                                                    </tr>
                                                                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="customers" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="customers-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Company</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="10" class="customer_link pointer"><td>1</td>
                                            <td>Jude</td>
                                            <td>Jude Edokpolor</td>
                                            <td>judeedokpolor@yahoo.com</td>
                                            <td>2348027257478</td>
                                            <td>17ZumsiWHe1Z8nbDCSDJbKNS9CnSMc262u</td>
                                        </tr><tr id="4" class="customer_link pointer"><td>2</td>
                                            <td>a</td>
                                            <td>John</td>
                                            <td>gooption@yahoo.com</td>
                                            <td>+2349080494803</td>
                                            <td>Lagos</td>
                                        </tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="suppliers" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="suppliers-tbl" cellpadding="0" cellspacing="0" border="0"
                                                   class="table table-bordered table-hover table-striped"
                                                   style="margin-bottom: 0;">
                                                <thead>
                                                <tr>
                                                    <th style="width:30px !important;">#</th>
                                                    <th>Company</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr id="8" class="supplier_link pointer"><td>1</td>
                                        <td>A-Z World</td>
                                        <td>A-Z World</td>
                                        <td>info@ella.com.ng</td>
                                        <td>08027257478</td>
                                        <td>Lagos</td>
                                    </tr><tr id="7" class="supplier_link pointer"><td>2</td>
                                        <td>Phone World</td>
                                        <td>The Era Dubai</td>
                                        <td>nollyvenon1@yahoo.co.uk</td>
                                        <td>08000000000</td>
                                        <td>6 Fadeyi Street, Fadeyi</td>
                                    </tr><tr id="6" class="supplier_link pointer"><td>3</td>
                                        <td>DeNoble Awka</td>
                                        <td>Judah Okoma</td>
                                        <td>denobel@yahoo.com</td>
                                        <td>080333333333</td>
                                        <td>6 Fadeyi Street, Fadeyi</td>
                                    </tr>                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.order').click(function () {
            window.location.href = 'http://localhost/stockfeb2017/orders/view/' + $(this).attr('id') + '#comments';
        });
        $('.invoice').click(function () {
            window.location.href = 'http://localhost/stockfeb2017/orders/view/' + $(this).attr('id');
        });
        $('.quote').click(function () {
            window.location.href = 'http://localhost/stockfeb2017/quotes/view/' + $(this).attr('id');
        });
    });
</script>

    <style type="text/css" media="screen">
        .tooltip-inner {
            max-width: 500px;
        }
    </style>
    <script src="<?php echo SITE_ASSETS;?>/js/hc/highcharts.js"></script>
    <script type="text/javascript">
        $(function () {
            Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {cx: 0.5, cy: 0.3, r: 0.7},
                    stops: [[0, color], [1, Highcharts.Color(color).brighten(-0.3).get('rgb')]]
                };
            });
            $('#ov-chart').highcharts({
                chart: {},
                credits: {enabled: false},
                title: {text: ''},
                xAxis: {categories: ["Jun-2017"]},
                yAxis: {min: 0, title: ""},
                tooltip: {
                    shared: true,
                    followPointer: true,
                    formatter: function () {
                        if (this.key) {
                            return '<div class="tooltip-inner hc-tip" style="margin-bottom:0;">' + this.key + '<br><strong>' + currencyFormat(this.y) + '</strong> (' + formatNumber(this.percentage) + '%)';
                        } else {
                            var s = '<div class="well well-sm hc-tip" style="margin-bottom:0;"><h2 style="margin-top:0;">' + this.x + '</h2><table class="table table-striped"  style="margin-bottom:0;">';
                            $.each(this.points, function () {
                                s += '<tr><td style="color:{series.color};padding:0">' + this.series.name + ': </td><td style="color:{series.color};padding:0;text-align:right;"> <b>' +
                                currencyFormat(this.y) + '</b></td></tr>';
                            });
                            s += '</table></div>';
                            return s;
                        }
                    },
                    useHTML: true, borderWidth: 0, shadow: false, valueDecimals: site.settings.decimals,
                    style: {fontSize: '14px', padding: '0', color: '#000000'}
                },
                series: [{
                    type: 'column',
                    name: 'Sold Product Tax',
                    data: [0.0000]
                },
                    {
                        type: 'column',
                        name: 'Order Tax',

                        data: [23.0000]
                    },
                    {
                        type: 'column',
                        name: 'Sales',
                        data: [280000.0000]
                    }, {
                        type: 'spline',
                        name: 'Purchases',
                        data: [1830000.0000],
                        marker: {
                            lineWidth: 2,
                            states: {
                                hover: {
                                    lineWidth: 4
                                }
                            },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'spline',
                        name: 'Purchased Product Tax',
                        data: [0.0000],
                        marker: {
                            lineWidth: 2,
                            states: {
                                hover: {
                                    lineWidth: 4
                                }
                            },
                            lineColor: Highcharts.getOptions().colors[3],
                            fillColor: 'white'
                        }
                    }, {
                        type: 'pie',
                        name: 'Stock Value',
                        data: [
                            ['', 0],
                            ['', 0],
                            ['Stock Value by Price', -1364000.0000],
                            ['Stock Value by Cost', -1284000.0000],
                        ],
                        center: [80, 42],
                        size: 80,
                        showInLegend: false,
                        dataLabels: {
                            enabled: false
                        }
                    }]
            });
        });
    </script>

    <script type="text/javascript">
        $(function () {
                        $('#bschart').highcharts({
                chart: {type: 'column'},
                title: {text: ''},
                credits: {enabled: false},
                xAxis: {type: 'category', labels: {rotation: -60, style: {fontSize: '13px'}}},
                yAxis: {min: 0, title: {text: ''}},
                legend: {enabled: false},
                series: [{
                    name: 'Sold',
                    data: [['LG Keyboard<br>(68388393)', 34.0000],['Dell 14" Chrome Flatscreen Monitor<br>(97969990)', 3.0000],['Samsung 40" Digital FHD Flat TV UA40J5000AKXSJ - Black<br>(SAMFHDUA40J5000AKXSJ)', 1.0000],],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#000',
                        align: 'right',
                        y: -25,
                        style: {fontSize: '12px'}
                    }
                }]
            });
                    });
    </script>
    <div class="row" style="margin-bottom: 15px;">
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2 class="blue"><i
                            class="fa-fw fa fa-line-chart"></i>Best Sellers (Jun-2017)                    </h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="bschart" style="width:100%; height:450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header">
                    <h2 class="blue"><i
                            class="fa-fw fa fa-line-chart"></i>Best Sellers (May-2017)                    </h2>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="lmbschart" style="width:100%; height:450px;"></div>
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
      - Page rendered in <strong>1.9861</strong> seconds</p>
</footer>
</div><div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
<div class="modal fade in" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true"></div>
<div id="modal-loading" style="display: none;">
    <div class="blackbg"></div>
    <div class="loader"></div>
</div>
<div id="ajaxCall"><i class="fa fa-spinner fa-pulse"></i></div>
<script type="text/javascript">
var dt_lang = {"sEmptyTable":"No data available in table","sInfo":"Showing _START_ to _END_ of _TOTAL_ entries","sInfoEmpty":"Showing 0 to 0 of 0 entries","sInfoFiltered":"(filtered from _MAX_ total entries)","sInfoPostFix":"","sInfoThousands":",","sLengthMenu":"Show _MENU_ ","sLoadingRecords":"Loading...","sProcessing":"Processing...","sSearch":"Search","sZeroRecords":"No matching records found","oAria":{"sSortAscending":": activate to sort column ascending","sSortDescending":": activate to sort column descending"},"oPaginate":{"sFirst":"<< First","sLast":"Last >>","sNext":"Next >","sPrevious":"< Previous"}}, dp_lang = {"days":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"daysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sun"],"daysMin":["Su","Mo","Tu","We","Th","Fr","Sa","Su"],"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"today":"Today","suffix":[],"meridiem":[]}, site = {"base_url":"http:\/\/localhost\/stockfeb2017\/","settings":{"logo":"logo41.png","logo2":"logo42.png","site_name":"ZentaBooks","language":"english","default_salespoint":"1","default_store":"1","default_warehouse":"1","accounting_method":"0","default_currency":"NGN","default_tax_rate":"1","rows_per_page":"10","version":"3.0.2.23","default_tax_rate2":"1","dateformat":"5","sales_prefix":"SALE","quote_prefix":"QUOTE","purchase_prefix":"PO","transfer_prefix":"TR","delivery_prefix":"DO","payment_prefix":"IPAY","return_prefix":"SR","returnp_prefix":"PR","expense_prefix":"","item_addition":"1","theme":"default","product_serial":"1","default_discount":"1","product_discount":"1","discount_method":"1","tax1":"1","tax2":"1","overselling":"0","salescommission":"0.10","loyaltycardval":"0.00100","iwidth":"800","iheight":"800","twidth":"60","theight":"60","watermark":"1","smtp_host":"pop.gmail.com","bc_fix":"4","auto_detect_barcode":"1","captcha":"0","reference_format":"2","racks":"1","attributes":"1","product_expiry":"1","decimals":"2","qty_decimals":"2","decimals_sep":".","thousands_sep":",","invoice_view":"0","default_biller":"3","rtl":"0","each_spent":null,"ca_point":null,"each_sale":null,"sa_point":null,"sac":"0","display_all_products":"1","display_symbol":"1","symbol":" \u20a6","remove_expired":"0","barcode_separator":"_","set_focus":"0","max_number_of_staff_for_leave":"3","price_group":"1","barcode_img":"1","ppayment_prefix":"POP","disable_editing":"90","qa_prefix":"","update_cost":"1","user_language":"english","user_rtl":"0"},"dateFormats":{"js_sdate":"dd\/mm\/yyyy","php_sdate":"d\/m\/Y","mysq_sdate":"%d\/%m\/%Y","js_ldate":"dd\/mm\/yyyy hh:ii","php_ldate":"d\/m\/Y H:i","mysql_ldate":"%d\/%m\/%Y %H:%i"}};
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
        $('.mm_welcome').addClass('active');
        $('.mm_welcome').find("ul").first().slideToggle();
        $('#welcome_index').addClass('active');
        $('.mm_welcome a .chevron').removeClass("closed").addClass("opened");
    });
</script>
</body>
</html>
