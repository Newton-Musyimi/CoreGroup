<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
global $host;
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/

require_once('security/admin/config.php');
require_once('security/header.php');
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wood Street Academy</title>
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
        <script>
            let current = document.getElementById("devices_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
        <div>
            <?php
            if($_SESSION['role'] != 'CLIENT'){
                echo "<button type= \"button\" class =\"modal-button\" name = \"add_device_button\" id=\"add_device_button\" style='display: none;'>Add Device</button>";
            }else{
                echo "<button type= \"button\" class =\"modal-button\" name = \"add_device_button\" id=\"add_device_button\">Add Device</button>";
            }
            ?>

        </div>
        <table>
            <tr>
                <th>Device ID</th>
                <th>Workorders Assigned</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Model</th>
                <th>View</th>
            </tr>
            <?php
            function getQuery(): string
            {
                if($_SESSION['role'] == 'CLIENT') {
                    $query = "SELECT * FROM devices WHERE owner_id = " . $_SESSION['logged_in'];
                }elseif($_SESSION['role'] == 'TECHNICIAN'){
                    $query = "SELECT devices.*, workorders.wo_id, assigned_technicians.employee_id FROM devices 
                                JOIN workorders ON workorders.device_id = devices.device_id
                                JOIN assigned_technicians ON assigned_technicians.wo_id = workorders.wo_id 
                                                                     WHERE assigned_technicians.employee_id = " . $_SESSION['logged_in'];
                }else{
                    $query = "SELECT * FROM devices";
                }
                return $query;
            }
            function workordersAssigned($device_id){
                $conn = get_db();
                $query = "SELECT COUNT(device_id) AS workorders FROM workorders WHERE device_id = $device_id GROUP BY device_id;";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                if($row === null){
                    return 0;
                }else {
                    return $row['workorders'];
                }
            }
            $query = getQuery();
            $conn = get_db();
            $result = mysqli_query($conn,$query);
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>{$row['device_id']}</td>";
                    echo "<td>".workordersAssigned($row['device_id'])."</td>";
                    echo "<td>{$row['category']}</td>";
                    echo "<td>{$row['brand']}</td>";
                    echo "<td>{$row['model']}</td>";
                    echo "<td><form action=\"device_summary.php\" method=\"post\">
                        <input type=\"hidden\" name=\"device_id\" value=\"{$row['device_id']}\">
                        <input type=\"submit\" value=\"View\">
                    </form></td>";
                    echo "</tr>";
                }
            ?>
        </table>
            <?php
            if(isset($_REQUEST['add_device'])){
                $category = $_REQUEST['category'];
                $brand= $_REQUEST['devicebrand'];
                $model = $_REQUEST['modelname'];
                $device_name = $_REQUEST['device_name'];
                $device_serial = $_REQUEST['serialnumber'];

                $query="INSERT INTO `coregroup`.`devices`
                    (
                    `category`,
                    `brand`,
                    `model`,
                    `serial_number`,
                    `device_name`)
                    VALUES
                    (
                     $category,
                     $brand,
                     $model,
                     $device_serial,
                     $device_name
                    )";
                $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
                if($result){
                    echo "<script>alert('Device Added Successfully')</script>";
                }
            }
            ?>
          
    </div>
    <div id="add_device_modal" class="modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
            <h3>Add Device</h3>
            <div class="form-group">
                <label for="device_name">Device Name</label><br>
                <input type="text" name="device_name" id="device_name"><br><br>

            </div>
            <label for= "devicetype"><strong>Device Type</strong></label><br><br>
            <select name="category" id="devicetype" required>
                <option value="PC">PC</option>
                <option value="Laptop">Laptop</option>
                <option value="Printer">Printer</option>
            </select><br><br>

            <div id="ticket_brand_group">
                <label for ="devicebrand"><strong>Device Brand</strong></label><br><br>
                <select name="devicebrand" id="devicebrand" required>
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


            <div class="form-group">
            </div>
            <input type= "submit" name="add_device" id="add_device" value="Add Device">

            <!-- Insert form above -->

        </form>
    </div>
</header>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("add_device_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("add_device_button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>