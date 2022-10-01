<?php
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
session_start();
require_once('security/admin/config.php');
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
require_once('security/admin/config.php');
require_once('security/header.php');
require_once('assets/php/workorders_scripts.php');
global $host;

//echo $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Wood Street Academy</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="icon" type="assets/images/favicon_io/favicon-16x16.png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="assets/images/favicon_io/favicon-32x32.png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'controls']});
        google.charts.setOnLoadCallback(drawDbtPie);
        google.charts.setOnLoadCallback(drawDbsPie);

        function drawDbsPie() {
            let ticketByStatusData = $.ajax({
                url: "assets/php/dashboard_scripts.php?ticket_by_status=true",
                dataType: "json",
                async: false
            }).responseText;
            ticketByStatusData = JSON.parse(ticketByStatusData);
            let dataTbs = new google.visualization.arrayToDataTable(ticketByStatusData);



            let options = {
                title: 'Tickets by Status',
                backgroundColor: 'antiquewhite'
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart_div_dbs'));

            chart.draw(dataTbs, options);
        }

        function drawDbtPie() {
            let ticketByTypeData = $.ajax({
                url: "assets/php/dashboard_scripts.php?ticket_by_type=true",
                dataType: "json",
                async: false
            }).responseText;
            ticketByTypeData = JSON.parse(ticketByTypeData);
            let dataTbt = new google.visualization.arrayToDataTable(ticketByTypeData);



            let options = {
                title: 'Tickets by Type',
                backgroundColor: 'antiquewhite'
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart_div_dbt'));

            chart.draw(dataTbt, options);
        }



    </script>
</head>

<body id="page-top" style="background: linear-gradient(#2dbd6e, #a6f77b); background-repeat: no-repeat;">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("dashboard_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div id="wrapper">
        <div class="d-flex flex-column" id="content-wrapper" style="background: linear-gradient(-51deg, #2dbd6e, #a6f77b);">
            <div id="content">

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-primary py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-xxl-11 me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>COMPLETED</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php getCompletedValue(); //FOUND IN assets/php/workorders_scripts.php?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-success py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>IN-PROGRESS</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php getInProgressValue(); //FOUND IN assets/php/workorders_scripts.php?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-info py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>PENDING</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php getPendingValue(); //FOUND IN assets/php/workorders_scripts.php?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-start-warning py-2">
                                <div class="card-body">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>CANCELLED</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span><?php getCancelledValue(); //FOUND IN assets/php/workorders_scripts.php?></span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-8" style="width: 100%;">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                                    <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                            <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}]}}}"></canvas></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="text-primary fw-bold m-0">Tickets By Type</h6>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-area" id="pie_chart_div_dbt"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card shadow mb-4">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h6 class="text-primary fw-bold m-0">Tickets By Status</h6>
                                            <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                                <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                                    <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="chart-area" id="pie_chart_div_dbs"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End: Chart -->
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>