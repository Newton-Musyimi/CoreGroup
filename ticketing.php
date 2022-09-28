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
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon_io/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon_io/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        p.pfield-wrapper::after {
            content: "\00a0\00a0 "; /* keeps spacing consistent */
        }
        p.required-field::after {
            content: "*";
            float: right;

            margin-left: -3%;
            color: red;
        }
    </style>
</head>

<body class="grid-container" id="page-top">
<header class="grid-item1">
    <?php
    getHeader();
    ?>
    <script>
        let current = document.getElementById("ticketing_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
</header>
<div class="grid-item2 content-body" id="ticket_body" >
    <h1>Create a ticket</h1>

    <form action = "workorders.php" method="POST">
        <p>Please select the type of ticket you want to open:</p>

        <label for ="maintenance">Maintenance/Check-Up</label>
        <input type="radio" name="request_type" id="maintenance" value="maintenance">&emsp;
        <label for ="repair">Repair</label>
        <input type="radio" name="request_type" id="repair" value="repair">&emsp;
        <label for ="replace">Replace</label>
        <input type="radio" name="request_type" id="replace" value="replace">&emsp;


        <h3><strong>Device</strong></h3>
        <label for= "devicetype"><strong>Device Type</strong></label><br><br>
        <select name="devicetype" id="devicetype">
            <option value="PC">PC</option>
            <option value="Laptop">Laptop</option>
            <option value="Printer">Printer</option>
        </select><br><br>

        <div id="ticket_brand_group">
            <label for ="devicebrand"><strong>Device Brand</strong></label><br><br>
            <select name="devicebrand" id="devicebrand">
                <option value="Other">Other...</option>
                <option value="Dell">Dell</option>
                <option value="Apple">Apple</option>
                <option value="HP">HP</option>
                <option value="Lenovo">Lenovo</option>
                <option value="Acer">Acer</option>
                <option value="Asus">Asus</option>
                <option value="Huawei">Huawei</option>
                <option value="Google">Google</option>
                <option value="LG">LG</option>
                <option value="Fujitsu">Fujitsu</option>
                <option value="NEC">NEC</option>
                <option value="Proline">Proline</option>
                <option value="Microsoft">Microsoft</option>
                <option value="NOC">NOC</option>
                <option value="Samsung">Samsung</option>
                <option value="Panasonic">Panasonic</option>
                <option value="Brother">Brother</option>
                <option value="Xerox">Xerox</option>
            </select><br><br>
        </div>


        <label for="modelname"><strong>Model Name</strong>(eg. MacBook Pro, HP L110, Dell Inspiron 15)</label><br>
        <input type = "text" name = "modelname" id = "modelname"><br>
        <label for ="serial number"><strong>Serial Number</strong></label><br>
        <input type= "text" name = "serialnumber" id = "serialnumber"><br>

        <div id="ticket_checkbox_group">

            <p><strong>Please check a box that applies to you:</strong></p>
            &emsp;<input type="checkbox" name="issue1" id = "issue1">
            <label for="issue1">Slow/Unresponsive</label><br><br>

            &emsp;<input type="checkbox" name="issue2" id ="issue2">
            <label for="issue2">Screen Damage</label><br><br>

            &emsp;<input type="checkbox" name="issue3" id ="issue3">
            <label for="issue3">Hardware (eg. body damage, cracked camera,keyboard, sensor) </label><br><br>

            &emsp;<input type="checkbox" name="issue1" id ="issue1">
            <label for="issue4">Battery and charging</label><br><br>

            &emsp;<input type="checkbox" name="issue4" id ="issue4">
            <label for="issue4">Network</label><br><br>

            &emsp;<input type="checkbox" name="issue5" id ="issue5">
            <label for="issue5">Functionality</label><br><br>

            &emsp;<input type="checkbox" name="issue6" id ="issue6">
            <label for="issue6">Other(Please help!)</label><br><br>
        </div>

        <label for ="textbox"><strong>Describe your problem here:</strong></label><br><br>
        <textarea id="descriptionbox" name="descriptionbox" rows="4" cols="50">
        </textarea><br><br>
        <label for ="date"><strong>Please choose a drop-off date</strong></label>
        <input type="date" name="date" id="date" class="date-today" min=""><br><br>

        <h3><strong>Requests</strong></h3>
        <p>Please state any speacial requests</p>
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
<footer class="grid-item3" style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>