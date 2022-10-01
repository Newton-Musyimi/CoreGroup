<?php
session_start();
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
    <title>Woodstreet Academy</title>
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
        <button type= "button" name = "add_device_button" id="add_device_button">Add Device</button>
        </div>
        <table>
            <tr>
                <th>Device Image</th>
                <th>Device ID</th>
                <th>Device</th>
                <th>Type</th>
                <th>Assigned To</th>
                <th>View</th>
            </tr>
            <tr>
                <td><img src="assets/images/hardware-bg.jpg" class="site_images" ></td>
                <td>1.</td>
                <td>Inspiron 15</td>
                <td>Laptop</td>
                <td>Assigned To</td>
                <td>
                    <form action="device_summary.php" method="post">
                        <input type="hidden" name="work_order_id" value="1">
                        <input type="submit" value="View">
                    </form>
                </td>
            </tr>
            <tr>
                <td><img src="assets/images/hardware-bg.jpg" class="site_images" ></td>
                <td>2.</td>
                <td>Dell</td>
                <td>Desktop</td>
                <td>Assigned To</td>
                <td>
                    <form action="device_summary.php" method="post">
                        <input type="hidden" name="work_order_id" value="1">
                        <input type="submit" value="View">
                    </form>
                </td>
            </tr>
            <tr>
                <td><img src="assets/images/hardware-bg.jpg" class="site_images" ></td>
                <td>3.</td>
                <td>Macbook Pro</td>
                <td>Laptop</td>
                <td>Assigned To</td>
                <td>
                    <form action="device_summary.php" method="post">
                        <input type="hidden" name="work_order_id" value="1">
                        <input type="submit" value="View">
                    </form>
                </td>
            </tr>
            <tr>
                <td><img src="assets/images/hardware-bg.jpg" class="site_images" ></td>
                <td>4.</td>
                <td>NOC</td>
                <td>Monitor</td>
                <td>Assigned To</td>
                <td>
                    <form action="device_summary.php" method="post">
                        <input type="hidden" name="work_order_id" value="1">
                        <input type="submit" value="View">
                    </form>
                </td>
            </tr>
        </table>  
    </div>
    <div id="add_device_modal" class="modal">
        <h3>Add Device</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
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
            <!-- Insert form above -->

        </form>
    </div>
    <?php
    if(isset($_REQUEST['device_name'])){
    }
    ?>
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