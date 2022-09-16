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
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
<img src="assets/images/Picture1.png" alt="logo">
<header>
    <h1>Customer Portal</h1>

    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <ul>
        <li>pending:<span><?php getPendingValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>In-Progress:<span><?php getInProgressValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>Completed:<span><?php getCompletedValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>Cancelled:<span><?php getCancelledValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
    </ul>
    <form action="helpdesk.php" method ="POST">
        <input type="submit" value="ADD REPAIR JOB">
    </form>
    <table>
        <?php getWorkorderTable(); //FOUND IN assets/js/php/workorders_scripts.php?>
    </table>

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>