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
    <div id="ticketing_button_group">
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='new'>
            <input type='submit' value='New Device'>
        </form>
        <form action ='ticketing.php' method='post'>
            <input type='hidden' name='ticket_device_type' value='existing'>
            <input type='submit' value='Existing  Device'>
        </form>
    </div>
    <form action="<?php echo htmlspecialchars('workorder_summary.php'); ?>" method="POST">
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
        
                </div>";
            }else{
                echo "
                <div class=\"form-group\">
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
                $query = "SELECT device_id, device_name, clients.username AS username 
                            FROM devices 
                                JOIN clients ON clients.client_id = devices.owner_id;";
            }
            $conn = get_db();
            $result = mysqli_query($conn, $query);
            $devices = "";
            while($row = mysqli_fetch_array($result)){
                $devices .= "<option value=\"{$row['device_id']}\">{$row['device_name']} - {$row['username']}</option>";
            }
            return $devices;
        }
        if(isset($_REQUEST['ticket_device_type'])){
            if($_REQUEST['ticket_device_type'] == 'new'){
                echo newDeviceInput();
            }else{
                echo "
                <div class=\"form-group\">
                    <label for= \"device_id\"><strong>Select Device: </strong></label>
                    <select name=\"device_id\" id=\"device_id\" required>".
                    getDevices()
                    ."
                    </select><br><br>

                </div>";
            }
        }else{
            echo newDeviceInput();
        }
        ?>


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