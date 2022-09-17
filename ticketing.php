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
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/helpdesk.css';?>">
</head>

<body id="page-top">
<header>
    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <div class="top-content">
    <h1>Create a ticket</h1>


    <input type="radio" name="maintenance" id="maintenance" value="maintenance">Maintenance</label>
            <label for ="maintenance"></label><br><br>
            <input type="radio" name="repair" id="repair" value="repair">Repair</label>
            <label for ="repair"></label><br><br>
    <h3><strong>Device</strong></h3>
        <form action = "workorders.php" method="POST">
            <label for= "devicetype"><strong>Device Type</strong></label><br><br>
            <select name="devicetype" id="devicetype">
                <option>PC</option>
                <option>Laptop</option>
            </select><br><br>
            <label for ="devicebrand"><strong>Device Brand</strong>(eg. iPhone, Samsung, Nokia)</label><br><br>
            <input type= "text" name = "devicebrand" id= "device brand"><br>
            <label for="modelname"><strong>Model Name</strong>(eg. Samsung s10, iPhone 11, Huawei Nova)</label><br>
            <input type = "text" name= "modelname" id="modelname"><br>
            <label for ="serial number"><strong>Serial Number</strong></label><br>
            <input type= "text" name = "serialnumber" id= "serialnumber"><br>
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
            <label for ="textbox"><strong>Describe your problem here!!!</strong></label><br><br>
            <textarea id="descriptionbox" name="descriptionbox" rows="4" cols="50">
            </textarea><br><br>
            <label for ="date"><strong>Please choose a drop-off date</strong></label>
            <input type="date" name="date" id="date"><br><br>

            <h3><strong>Requests</strong></h3>
            <p>Please state any speacial requests</p>
            <label for ="textbox"><strong>Describe your problem here!!!</strong></label><br><br>
            <textarea id="requestbox" name="requestbox" rows="4" cols="50">
            </textarea>
            <p>Please select how you would like to reieve your device after maintenance/repair</p>
            <input type="radio" name="collection" id="collection" value="Collection">Collection</label>
            <label for ="delivery"></label><br><br>
            <input type="radio" name="delivery" id="delivery" value="Delivery">Delivery</label>
            <label for ="delivery"></label><br><br>
            <input type = "submit" name="submit" id="submit">
        </form>

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>