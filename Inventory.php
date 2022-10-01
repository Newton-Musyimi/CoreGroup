<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
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
        <script>
            let current = document.getElementById("inventory_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>      
    </header>
    <div class="content-body">
        <h3>All Inventory Information</h3>
        <h1></h1>
        <div class="border">
        <div>
            <button id="add_order_button">Add Order</button>
        </div>
        <table>
            <tr>
                <th>Product Id</th>
                <th>Name</th>
                <th>Unit Price</th>
                <th>Unit Cost</th>
                <th>No. in Stock</th>
                <th>View</th>
            </tr>
            <tr>
                <td>20mm Screw</td>
                <td>R0.25</td>
                <td>25</td>
                <td>Green</td>
                <td>0</td>
            </tr>
            <tr>
                <td> iPhone 15 Scree</td>
                <td>R200</td>
                <td>3</td>
                <td>Red</td>
                <td>20</td>
            </tr>
        </table>
    </div>
    <div id="add_order_modal" class="modal">
        <h3>Add Device</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
                <label for="order_id">Order Id</label><br>
                <input type="text" id="order_id" name="order_id"><br>

                <label for="product_id">Product Id</label><br>
                <select id="product_id" name="product_id">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br><br>

                <label for="ordered_by">Ordered by:</label><br>
                <input type="text" id="ordered_by" name="ordered_by"><br>

                <label for="date_ordered">Date Order:</label><br>
                <input type="text" id="date_ordered" name="date_ordered"><br>

                <label for="wo_id">WO_Id</label><br>
                <input type="text" id="wo_id" name="wo_id"><br>

                <label for="quantity">Quantity</label><br>
                <input type="text" id="quantity" name="quantity"><br>

                <label for="order_status">Order Status</label><br>
                <input type="text" id="order_status" name="order_status"><br>

                <label for="date_collected">Date Colcted</label><br>
                <input type="text" id="date_collected" name="date_collected"><br>

                <label for="collect">Collect</label><br>
                <input type="text" id="collect" name="collect"><br>

                <input type="button" value="Add Order"
            <!-- Insert form above -->

        </form>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("add_order_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("add_order_button");

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