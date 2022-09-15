<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
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
<header>
    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <h1>Create a ticket</h1>

    <h3>Add Work Order</h3>
        <form action = "clienworkorder.php" method="POST">
            <label for= "devicetype">Device Type</label>
            <select name="devicetype" id="devicetype">
                <option>PC</option>
                <option>Laptop</option>
                <option>Phablet</option>
                <option>Phone</option>
            </select>
            <label for ="devicebrand">Device Brand (eg. iPhone, Samsung, Nokia)</label>
            <input type= "text" name = "devicebrand" id= "device brand">
            <label for="modelname">Model Name(eg. Samsung s10, iPhone 11, Huawei Nova)</label>
            <input type = "text" name= "modelname" id="modelname">
            <label for ="serial number">Serial Number</label>
            <input type= "text" name = "serialnumber" id= "serialnumber">
            <input type="checkbox" name="issue1" id ="issue1">
            <label for="issue1">Slow/Unresponsive</label><br><br>
            <input type="checkbox" name="issue2" id ="issue2">
            <label for="issue2">Screen Damage</label><br><br>
            <input type="checkbox" name="issue3" id ="issue3">
            <label for="issue3">Hardware(eg. body damage, cracked camera,keyboard, sensor) </label><br><br>
            <input type="checkbox" name="issue1" id ="issue1">
            <label for="issue4">Battery and charging</label><br><br>
            <input type="checkbox" name="issue4" id ="issue4">
            <label for="issue4">Network</label><br><br>
            <input type="checkbox" name="issue5" id ="issue5">
            <label for="issue5">Functionality</label><br><br>
            <input type="checkbox" name="issue6" id ="issue6">
            <label for="issue6">Other(Please help!!!!!)</label><br><br>
            <label for ="textbox">Describe your problem here!!!</label>
            <textarea id="descriptionbox" name="descriptionbox" rows="4" cols="50">
            </textarea>
            <label for ="date">Please choose a drop-off date</label>
            <input type="date" name="date" id="date">

            <h3><strong>Requests</strong></h3>
            <p>Please state any speacial requests</p>
            <label for ="textbox">Describe your problem here!!!</label>
            <textarea id="requestbox" name="requestbox" rows="4" cols="50">
            </textarea>
            <p>Please select how you would like to reieve your device after maintenance/repair</p>
            <input type="radio" name="collection" id="collection" value="Collection"></label>
            <label for ="delivery"></label>
            <input type="radio" name="delivery" id="delivery" value="Delivery"></label>
            <label for ="delivery"></label>
            <input type = "submit" name="submit" id="submit">

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/jquery.min.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/logout.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>