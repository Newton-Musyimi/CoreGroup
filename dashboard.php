
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <?php
    session_start();
    /*
    require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
    */
    if(!isset($_SESSION['username'])){
        header("location: security/login.php");
    }
    require_once('security/admin/config.php');
    require_once('security/header.php');
    global $host;

    if(isset($_SESSION['username'])) {

        $conn = get_db();
        $_GLOBALS['conn'] = $conn;
        //require_once ('assets/php/dashboard_scripts.php');
    } else {
        header("Location: $host.'/SysDev/CoreGroup/security/login.php");
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/dashboard.css';?>">
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

<body id="page-top">
    <header value="admin">
        <?php
        echo "Welcome to the dashboard, " . $_SESSION['username'] . "!";
        getHeader();
        ?>
        <script>
            let current = document.getElementById("dashboard_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
        <div class="container">
            <div class="column">
                <div class="row">
                    <div class="chart" id="pie_chart_div_dbt"></div>
                    <div class="chart" id="pie_chart_div_dbs"></div>
                </div>
                <div class="row chart" style="width:100%; margin:0px;">
                    <div class="completed-card">
                        <div class="card-body">
                            Completed
                        </div>
                    </div>
                    <div class="completed-card">
                        <div class="card-body">
                            In-Progress
                        </div>
                    </div>
                    <div class="completed-card">
                        <div class="card-body">
                            Pending
                        </div>
                    </div>
                    <div class="completed-card">
                        <div class="card-body">
                            Cancelled
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="chart" id="technician_by_rating"></div>
                    <div class="chart" id="overall_rating"></div>
                </div>
            </div>
            <div class="column">

            </div>

        </div>
    </div>

    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>

</body>

</html>