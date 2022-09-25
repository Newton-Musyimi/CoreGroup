<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
require_once('assets/php/workorders_scripts.php');
global $host;
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/workorder.css';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
<header>
    <?php
    getHeader();
    ?>
    <script>
        let current = document.getElementById("workorders_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
</header>

<div class="content-body">
    <div class="status">
    <ul>
        <li style="color:brown";>Pending:<span><?php getPendingValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li style="color:blue";>In-Progress:<span><?php getInProgressValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li style="color:green";>Completed:<span><?php getCompletedValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li style="color:red";>Cancelled:<span><?php getCancelledValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
    </ul>
    </div>
    <div class="border">
    <form action="ticketing.php" method ="POST">
        <input type="submit" value="ADD REPAIR JOB">
    </form>
    </div>
    <table>
        <?php getWorkorderTable(); //FOUND IN assets/php/workorders_scripts.php?>
    </table>
    <div id="workorder_summary"></div>

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script>
    function getWorkorderSummary(wo_id){
        let xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("workorder_summary").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "assets/php/workorder_summary.php?wo_id="+wo_id, true);
        xhttp.send();
    }
    document.querySelector('.work_order_view_button').addEventListener('submit', function(e){
        e.preventDefault();
        var form = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/workorders_scripts.php', true);
        xhr.onload = function(){
            console.log(this.responseText);
        }
        xhr.send(form);
    });
</script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>