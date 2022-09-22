
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <?php
    session_start();
    /*
    require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
    */
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'controls']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {

            let dashboard = new google.visualization.Dashboard(
                document.getElementById('ticket_by'));

            // We omit "let" so that programmaticSlider is visible to changeRange.
            let programmaticSlider = new google.visualization.ControlWrapper({
                'controlType': 'NumberRangeFilter',
                'containerId': 'ticket_by_filter',
                'options': {
                    'filterColumnLabel': 'Number',
                    'ui': {'labelStacking': 'vertical'}
                }
            });

            let programmaticChart  = new google.visualization.ChartWrapper({
                'chartType': 'PieChart',
                'containerId': 'chart_div',
                'options': {
                    'width': 300,
                    'height': 300,
                    'legend': 'none',
                    'chartArea': {'left': 15, 'top': 15, 'right': 0, 'bottom': 0},
                    'pieSliceText': 'value'
                }
            });

            let ticketByTypeData = $.ajax({
                url: "assets/php/dashboard_scripts.php",
                dataType: "json",
                async: false
            }).responseText;

            console.log(ticketByTypeData);
            console.log(typeof ticketByTypeData);
            ticketByTypeData = JSON.parse(ticketByTypeData);
            console.log(typeof ticketByTypeData);

            let data = new google.visualization.arrayToDataTable(ticketByTypeData);

            dashboard.bind(programmaticSlider, programmaticChart);
            dashboard.draw(data);

            resetRange = function() {
                programmaticSlider.setState({'lowValue': 0, 'highValue': 50});
                programmaticSlider.draw();
            };

            changeOptions = function() {
                programmaticChart.setOption('is3D', true);
                programmaticChart.draw();
            };
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
        <div id="dashboard">
            <div id="ticket_by"  style="border: 1px solid #ccc">
                <div id="ticket_by_filter" "padding-left: 2em; min-width: 250px"></div>
            <div>
                <button style="margin: 1em 1em 1em 2em" onclick="resetRange();">Reset</button>
                <button style="margin: 1em 1em 1em 2em" onclick="changeOptions();">Make the pie chart 3D</button>
            </div>

            <div id="chart_div"></div>

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