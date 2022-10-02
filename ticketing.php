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
    <title>Wood Street Academy</title>
    <meta http-equiv="Cache-control" content="no-store">

    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
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
    <?php
    if($_SESSION['role'] == 'CLIENT'){
        $conn = get_db();
        $id = $_SESSION['logged_in'];
        $query = "SELECT count(device_id) AS number_of_devices FROM devices WHERE owner_id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        if(intval($row['number_of_devices']) > 0){
            echo "<div id='ticketing_button_group'>
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='new'>
            <input type='submit' value='New Device'>
        </form>
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='existing'>
            <input type='submit' value='Existing  Device'>
        </form>
    </div>";
        }
    }else{
        echo "<div id='ticketing_button_group'>
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='new'>
            <input type='submit' value='New Device'>
        </form>
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='existing'>
            <input type='submit' value='Existing  Device'>
        </form>
    </div>";
    }
    ?>
    <form action="<?php echo htmlspecialchars('ticketing.php'); ?>" method="POST">
        <p>Please select the type of ticket you want to open:</p>

        <label for ="maintenance">Maintenance/Check-Up</label>
        <input type="radio" name="request_type" id="maintenance" value="maintenance">&emsp;
        <label for ="repair">Repair</label>
        <input type="radio" name="request_type" id="repair" value="repair">&emsp;
        <label for ="replace">Replace</label>
        <input type="radio" name="request_type" id="replace" value="replace">&emsp;


        <h3><strong>Device</strong></h3>

        <?php
        $client_id = "";
        $id = 0;
        if ($_SESSION['role'] == 'CLIENT'){
            $id = $_SESSION['logged_in'];
        }
        function getClientIds(){
            $conn = get_db();
            $query = "SELECT client_id, username FROM clients;";
            $result = mysqli_query($conn, $query);
            $ids = "";
            while($row = mysqli_fetch_array($result)){
                $ids .= "<option value=\"{$row['client_id']}\">{$row['username']}</option>";
            }
            return $ids;
        }
        function newDeviceInput(){
            if($_SESSION['role'] == 'CLIENT'){
                global $id;
                echo "
                <div class=\"form-group\">
                <label for= \"client_id\"><strong>Username: {$_SESSION['username']} </strong></label>
                    <input type=\"hidden\" name=\"client_id\" id=\"client_id\" value=\"$id\"><br><br>
        
                </div>
                    <input type=\"hidden\" name=\"submit_type\" id=\"submit_type\" value=\"new\"><br><br>";
            }else{
                echo "
                <div class=\"form-group\">
                <input type=\"hidden\" name=\"submit_type\" id=\"submit_type\" value=\"new\"><br><br>
                    <label for= \"client_id\"><strong>Client Id</strong></label><br><br>
                    <select name=\"client_id\" id=\"client_id\" required>".
                    getClientIds()
                    ."
                    </select><br><br>

                </div>";
            }

        echo "
                <div class=\"form-group\">
                    <label for=\"device_name\">Device Name</label><br>
                    <input type=\"text\" name=\"device_name\" id=\"device_name\"><br><br>
                </div>
                <label for= \"devicetype\"><strong>Device Type</strong></label><br><br>
                <select name=\"category\" id=\"devicetype\" required>
                    <option value=\"Desktop\">PC</option>
                    <option value=\"Laptop\">Laptop</option>
                </select><br><br>

                <div id=\"ticket_brand_group\">
                    <label for =\"devicebrand\"><strong>Device Brand</strong></label><br><br>
                    <select name=\"devicebrand\" id=\"devicebrand\" required>
                        <option value=\"Other\">Other...</option>
                        <option value=\"Dell\">Dell</option>
                        <option value=\"Apple\">Apple</option>
                        <option value=\"HP\">HP</option>
                        <option value=\"Lenovo\">Lenovo</option>
                        <option value=\"Acer\">Acer</option>
                        <option value=\"Asus\">Asus</option>
                        <option value=\"Huawei\">Huawei</option>
                        <option value=\"Google\">Google</option>
                        <option value=\"LG\">LG</option>
                        <option value=\"Fujitsu\">Fujitsu</option>
                        <option value=\"NEC\">NEC</option>
                        <option value=\"Proline\">Proline</option>
                        <option value=\"Microsoft\">Microsoft</option>
                        <option value=\"NOC\">NOC</option>
                        <option value=\"Samsung\">Samsung</option>
                        <option value=\"Panasonic\">Panasonic</option>
                        <option value=\"Brother\">Brother</option>
                        <option value=\"Xerox\">Xerox</option>
                    </select><br><br>
                </div>


                <label for=\"modelname\"><strong>Model Name</strong>(eg. MacBook Pro, HP L110, Dell Inspiron 15)</label><br>
                <input type = \"text\" name = \"modelname\" id = \"modelname\"><br>
                <label for =\"serial number\"><strong>Serial Number</strong></label><br>
                <input type= \"text\" name = \"serialnumber\" id = \"serialnumber\"><br>  ";
        }
        function getDevices(){
            if ($_SESSION['role'] == 'CLIENT'){
                $id = $_SESSION['logged_in'];
                $query = "SELECT device_id, device_name FROM devices WHERE owner_id = $id";
            }else{
                $query = "SELECT device_id, device_name, clients.username AS username , clients.client_id
                            FROM devices 
                                JOIN clients ON clients.client_id = devices.owner_id;";
            }
            $conn = get_db();
            $result = mysqli_query($conn, $query);
            $devices = "";
            while($row = mysqli_fetch_array($result)){
                $devices .= "<option value=\"{$row['device_id']}+{$row['client_id']}\">{$row['device_name']} - {$row['username']}</option>";
            }
            mysqli_close($conn);
            return $devices;
        }
        if(isset($_REQUEST['ticket_device_type']) && !isset($_REQUEST['submit'])){
            if($_REQUEST['ticket_device_type'] == 'new'){
                newDeviceInput();
            }else{
                echo "
                <input type=\"hidden\" name=\"submit_type\" id=\"submit_type\" value=\"saved\"><br><br>
                <div class=\"form-group\">
                    <label for= \"device_client\"><strong>Select Device: </strong></label>
                    <select name=\"device_client\" id=\"device_client\" required>".
                    getDevices()
                    ."
                    </select><br><br>

                </div>";
            }
        }else{
            newDeviceInput();
        }
        ?>


        <div id="ticket_checkbox_group">

            <p><strong>Please check a box that applies to you:</strong></p>
            &emsp;<input type="checkbox" name="performance" id = "issue1">
            <label for="issue1">Slow/Unresponsive</label><br><br>

            &emsp;<input type="checkbox" name="screen" id ="issue2">
            <label for="issue2">Screen Damage</label><br><br>

            &emsp;<input type="checkbox" name="hardware" id ="issue3">
            <label for="issue3">Hardware (eg. body damage, cracked camera,keyboard, sensor) </label><br><br>

            &emsp;<input type="checkbox" name="networking" id ="issue4">
            <label for="issue4">Network</label><br><br>

            &emsp;<input type="checkbox" name="functionality" id ="issue5">
            <label for="issue5">Functionality</label><br><br>

            &emsp;<input type="checkbox" name="power" id ="issue1">
            <label for="issue4">Battery and charging</label><br><br>

            &emsp;<input type="checkbox" name="other" id ="issue6">
            <label for="issue6">Other(Please help!)</label><br><br>
        </div>

        <label for ="textbox"><strong>Describe your problem here:</strong></label><br><br>
        <textarea id="descriptionbox" name="descriptionbox" rows="4" cols="50">
        </textarea><br><br>
        <label for ="date"><strong>Please choose a drop-off date</strong></label>
        <input type="date" name="date" id="date" class="date-today" min=""><br><br>

        <h3><strong>Requests</strong></h3>
        <p>Please state any special requests</p>
        <textarea id="requestbox" name="request_box" rows="4" cols="50">
        </textarea>
        <div>
            <p>Please select how you would like to receive your device after maintenance/repair</p>
            <input type="radio" name="dispatch" id="collection" value="Collection" required>
            <label for ="delivery">Collection</label><br><br>
            <input type="radio" name="dispatch" id="delivery" value="Delivery">
            <label for ="delivery">Delivery</label><br><br>
        </div>

        <input type = "submit" name="submit" id="submit">
        <?php
        function addDevice($client_id, $description, $category, $brand, $model, $serial, $location, $device_name){
            $conn = get_db();
            $device_name = $conn -> real_escape_string($device_name);
            $model = $conn -> real_escape_string($model);
            $description = $conn -> real_escape_string($description);
            $dev_id = 0;
            $query = "INSERT INTO `coregroup`.`devices`
                        (`owner_id`,
                        `description`,
                        `category`,
                        `brand`,
                        `model`,
                        `serial_number`,
                        `location`,
                        `device_name`)
                        VALUES(
                            '$client_id',
                            '$description',
                            '$category',
                            '$brand',
                            '$model',
                            '$serial',
                            '$location',
                            '$device_name'); ";
            if(mysqli_query($conn, $query) OR DIE ("Could not add device! ".$conn->error)){
                $query = "SELECT device_id FROM devices WHERE owner_id = $client_id ORDER BY device_id DESC;";
                $result = mysqli_query($conn, $query) OR DIE ("Could not get device! ".$conn->error);
                $row = mysqli_fetch_array($result);
                $dev_id = $row['device_id'];
            }
            mysqli_close($conn);
            return $dev_id;
        }

        function addWorkOrder($client_id, $dev_id, $request_type, $requested_by, $dispatch_method, $dropoff){
            $conn = get_db();
            $wo_id = 0;
            $query = "INSERT INTO `coregroup`.`workorders`
                                (`requested_by`,
                                `client_id`,
                                `request_type`,
                                `dropoff_date`,
                                `dispatch_method`,
                                `device_id`)
                                VALUES(
                                    '$requested_by',
                                    '$client_id',
                                    '$request_type',
                                    '$dropoff',
                                    '$dispatch_method',
                                    '$dev_id');
                                    ";
            if(mysqli_query($conn, $query) OR DIE ("Could not add workorder! ".$conn->error)){
                $query = "SELECT wo_id FROM workorders WHERE client_id = $client_id AND device_id = $dev_id ORDER BY wo_id DESC;";
                $result = mysqli_query($conn, $query) OR DIE ("Could not get workorder! ".$conn->error);
                $row = mysqli_fetch_array($result);
                $wo_id = $row['wo_id'];
            }
            mysqli_close($conn);
            return $wo_id;
        }

        if(isset($_REQUEST['submit_type'])){

            $description  = $_REQUEST['descriptionbox'];;
            $request_type = $_REQUEST['request_type'];
            $requested_by = $_SESSION['username'];
            $dispatch_method = $_REQUEST['dispatch'];
            $dropoff = $_REQUEST['date'];
            $wo_id = 0;
            if($_REQUEST['submit_type'] === 'new'){
                $client_id = $_REQUEST['client_id'];
                $category = $_REQUEST['category'];
                $brand = $_REQUEST['devicebrand'];
                $model = $_REQUEST['modelname'];
                $serial_number = $_REQUEST['serialnumber'];
                $location = $_REQUEST['client_id'];
                $device_name = $_REQUEST['device_name'];
                $dev_id = intval(addDevice($client_id, $description, $category, $brand, $model, $serial_number, $location, $device_name));
                if($dev_id !== 0){
                    $wo_id = intval(addWorkOrder($client_id, $dev_id, $request_type, $requested_by, $dispatch_method, $dropoff));
                }else{
                    exit;
                }
            }else{
                $string = $_REQUEST['device_client'];
                $device_client = explode("+", $string);
                $client_id = intval($device_client[1]);
                $dev_id = intval($device_client[0]);
                $wo_id = intval(addWorkOrder($client_id, $dev_id, $request_type, $requested_by, $dispatch_method, $dropoff));
            }
            if($wo_id !== 0){
                $url = $host."/SysDev/CoreGroup/workorder_summary.php?work_order_id=$wo_id";
                echo "<script>window.location.replace(\"$url\");</script>";
            }else{

            }
        }
        if(isset($_REQUEST['']))
        ?>
    </form>
</div>
<footer class="grid-item3" style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
    </div>
</footer>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>