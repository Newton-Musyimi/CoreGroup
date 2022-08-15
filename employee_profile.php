<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');

//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
<header>
    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <div class='tab'>
        <button class='tablinks' id="defaultOpen" onclick='openTab(event, "Profile")'>My Profile</button>
        <button class='tablinks' onclick='openTab(event, "Devices")'>Devices</button>
    </div>
    <div id="Profile" class="tabcontent">
        <h3>My Profile</h3>

    </div>
    <div id='Devices' class='tabcontent'>
        <h3>Devices</h3>
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