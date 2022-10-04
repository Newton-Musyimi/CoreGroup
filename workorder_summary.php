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
require_once('assets/php/workorders_scripts.php');
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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<style>
    h1{
    border-bottom: 2px solid black;
    }
    #table1 { grid-area: table1; }
    #table2 { grid-area: table2; }
    #table3 { grid-area: table3; 
    width: 100%;}
    #table4 { grid-area: table4; }

    .grid-container {
    display: grid;
    grid-template-areas:
        'table1 table1 table1 table1 table1 table1'
        'table2 table2 table2 table3 table3 table3'
        'table4 table4 table4 table4 table4 table4';
    }
</style>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("workorders_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
        
</header>
    <div class="content-body">
        <?php
        function addAssignee($role, $id): void
        {
            if ($role == 'ADMINISTRATOR' || $role == 'RECEPTIONIST') {
                echo "<form action=\"\" id=\"add_technician_form\" method=\"POST\" style='height: 100%;'>
                            <select name=\"assignedto\" id=\"assignedto\">";
                $conn = get_db();
                //SQL Code that gets value of employee id that is not assigned to a specific workorder
                $query = "SELECT employee_id, first_name, last_name 
                                            FROM employees 
                                            WHERE employee_id NOT IN 
                                                  (SELECT employee_id 
                                                   FROM assigned_technicians 
                                                   WHERE wo_id = $id) 
                                              AND title = 'TECHNICIAN';";
                $result = mysqli_query($conn, $query) or die ("Could not get technicians!" . $conn->error);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=\"{$row['employee_id']}\">{$row['first_name']} {$row['last_name']}</option>";
                }
                echo "</select>
                        <input type=\"hidden\" name=\"workorder_id\" value=\"$id\">
                        <input type=\"submit\" name=\"add_assignee\" value=\"Add Assignee\">";
            }
        }

        if(!isset($_REQUEST['work_order_id']) && !isset($_REQUEST['workorder_id'])){
            echo "<p class='access_form'>Failed To Get Workorder: <span style='color:red;'>No Workorder ID Selected!</span> Go back to <a href='workorders.php'>Workorders Page</a> and Select a Workorder to 'View'</p>";
        }else{
            require_once("assets/php/Workorder.php");
            $id = $_REQUEST['work_order_id'] ?? $_REQUEST['workorder_id'];

            $workorder = (new Workorder)->getByWorkorderId($id);

        }
        if (isset($_REQUEST['documentation'])){
            echo "<p>Document sucessfully uploaded. style=' color:green;'</p>";
        }
        ?>
        <h1>WorkOrder Summary</h1>
        <h2>Work Order number:<?php echo $id;?></h2> 
        <div class="grid-container">
            <table id="table1" style="margin-bottom:30px;">
                <tr>
                    <th>Date:</th>
                    <td><?php echo $workorder['date_started'];?></td>
                </tr>   
                <tr>
                    <th>Time:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Type:</th>
                    <td><?php echo $workorder['request_type'];?></td>
                </tr>
                <tr>
                    <th>Customer Name:</th>
                    <td><?php echo $workorder['client_name'];?></td>
                </tr>
                <tr>
                    <th><?php echo $workorder['techs'];?></th>
                    <td>


                        <?php
                        $role = $_SESSION['role'];
                        addAssignee($role, $id);
                        if(isset($_REQUEST['add_assignee'])){
                            $technician_id = $_REQUEST['assignedto'];
                            $workorder_id = $_REQUEST['workorder_id'];
                            $conn = get_db();
                            $query = "INSERT INTO assigned_technicians (employee_id, wo_id) VALUES ($technician_id, $workorder_id);";
                            $result = mysqli_query($conn, $query) or die ("Could not add technician!" . $conn->error);
                            if($result){
                                echo "<p style='color:green;'>Technician added successfully!</p>";
                                echo "<script>
                                            window.location.href = 'workorder_summary.php?work_order_id=$id';
                                            </script>";
                            }else{
                                echo "<p style='color:red;'>Failed to add technician!</p>";
                            }
                        }
                        ?>

                    </td>
                </tr>
                <tr>
                    <th>Parts used: <button type= "button" class ="modal-button" name="view_resources_button" id="view_resources_button">View Parts</button>
                    <th>Invoice:<a href="invoice.php"><button type= "button" class ="modal-button" name="view_invoice_button" id="view_invoice_button">View Invoice</button>

                    </th>
                    <td>
                        <?php
                        if ($role != 'CLIENT') {
                            echo "<button type= \"button\" class =\"modal-button\" name = \"add_resources_button\" id=\"add_resources_button\">Add Parts</button></td>";
                        }
                        ?>
                </tr>
            </table>
            <table id="table2" style="margin-bottom:30px;"> 
                <tr>
                    <th>Device type:</th>
                    <td><?php echo $workorder['device_type'];?></td>
                </tr> 
                <tr>
                    <th>Device brand:</th>
                    <td><?php echo $workorder['device_brand'];?></td>
                </tr>
                <tr>
                    <th>Device Model:</th>
                    <td><?php echo $workorder['device_model'];?></td>
                </tr>
                <tr>
                    <th>Serial Number:</th>
                    <td><?php echo $workorder['device_serial_number'];?></td>
                </tr>
            </table>
            <table id="table3" style="margin-bottom:30px;">
                <tr>
                    <th>Requested by:</th>
                    <td><?php echo $workorder['requested_by'];?></td>
                </tr>
                <tr>
                    <th>Date dropped-off:</th>
                    <td><?php echo $workorder['dropoff_date'];?></td>
                </tr>   
                <tr>
                    <th>Date completed</th>
                    <td><?php echo $workorder['date_completed'];?></td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td><?php echo $workorder['client_comments'];?></td>
                </tr>
            </table>
            <table id="table4" style="margin-bottom:30px;"> 
                <tr>
                    <th>Documentation:</th>
                    <td>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="file" id="documentation" name="documentation">
                            <input type="submit" name="add_documentation" value="Upload Document">
                        </form>
                    </td>
                    <?php
                    if(isset($_REQUEST['add_documentation'])) {
                        $document_id = $_REQUEST['document_id'];
                        $name = $_REQUEST['name'];
                        $device_id = $_REQUEST['device_id'];
                        $uploaded_by = $_REQUEST['uploaded_by'];
                        $today = date("Y-m-d");
                        $type = $_REQUEST['type'];
                        $description = $_REQUEST['description'];
                        $query = "INSERT INTO `coregroup`.`documents`
                            (`document_id`,
                            `name`,
                            `device_id`,
                            `uploaded_by`,
                            `file_path`,
                            `type`,
                            `description`)
                            VALUES
                            ($document_id,
                            $name,
                            $device_id,
                            $uploaded_by,
                            $type,
                            $description,
                            );
                            ";
                        $conn = get_db();
                        $result = mysqli_query($conn, $query) or die("query not successfully executed");
                        if ($result) {
                            echo "<p style='color:green;'>Document successfully uploaded!</p>";
                            echo "<script>
                                    window.location.href = 'workorder_summary.php?work_order_id=$id';
                                    </script>";
                        }
                    }
                    ?>
                </tr>
                <?php
                if ($role == "TECHNICIAN"){
                    echo "<tr>
                    <th>Hours Worked:{$workorder['hours_worked']}</th>
                    <td><form action=\"\" method=\"POST\">
                        <input type='number' name='hours_worked'>
                            <input type='submit' name='update_technician_hours' value='Update Technician Hours'>
                    </form></td>
                </tr>";
                }else{
                    echo "<tr>
                    <th>Hours Worked:</th>
                    <td>{$workorder['hours_worked']}</td>";
                }
                ?>

                <tr>
                    <th>Dispatch:</th>
                    <td><?php echo $workorder['dispatch_status'];?>
                        </td>
                </tr>
                <tr>
                    <th>Job Status: </th>
                    <td>
                        <?php
                        if (($role == 'ADMINISTRATOR' || $role == 'TECHNICIAN') && $workorder['status'] !== 'completed') {
                            echo "<form action=\"\" method=\"POST\">
                        <select name=\"job_status\" id=\"job_status\" style='height: 100%;'>
                            <option value=\"pending\">Pending</option>
                            <option value=\"in-progress\">In-Progress</option>
                            <option value=\"completed\">Completed</option>
                            <option value=\"cancelled\">Cancelled</option> 
                            </select>
                            <input type='submit' name='update_status' value='Update Workorder Status'>
                    </form>";
                        }else{
                            echo $workorder['status'];
                        }
                        ?></td>
                </tr>
            </table>  
        </div>             

    </div>
    <div id="add_resources_modal" class="modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
                        <h2>Assign Resources</h2>
                        <h3 class="h3_heading">Workorder</h3>
                        <table>
                            <tr>
                                <th>Product_Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Quantity to assign</th>
                            </tr>
                            <?php
                            $conn = get_db();
                            $query = "SELECT count(`resources`.`product_id`) AS quantity, product, category, resources.price AS price, resources.product_id FROM products
                            INNER JOIN resources ON `resources`.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` IS NULL
                            GROUP BY resources.product_id;";
                            $result = mysqli_query($conn, $query) or die ("Could not get products!" . $conn->error);
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>
                                    <td>{$row['product_id']}</td>
                                    <td>{$row['product']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>
                                    <form>
                                        <input type='number' name='quantity' min='0' max='{$row['quantity']}'>
                                        <input type='submit' name='assign_resources' value='Assign'>
                                    </form>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </table>
            <!-- Insert form above -->
            <?php
            if(isset($_POST['assign_resources'])){
                $quantity_to_assign = $_POST['quantity_to_assign'];
                $product_id = $_POST['product_id'];
                $workorder_id = $_POST['workorder_id'];
                $query = "INSERT INTO `coregroup`.`assigned_resources`
                            (`workorder_id`,
                            `product_id`,
                            `quantity_assigned`)
                            VALUES
                            ($workorder_id,
                            $product_id,
                            $quantity_to_assign);";
                $conn = get_db();
                $result = mysqli_query($conn, $query) or die("query not successfully executed");
                echo "<p style='color:green;'>Resources successfully assigned!</p>";
                echo "<script>
                        window.location.href = 'workorder_summary.php?work_order_id=$id';
                        </script>";
            }
            ?>

        </form>
    </div>
    <div id="view_resources_modal" class="modal">

        <table class="modal-content">
            <span class="close">&times;</span>
            <th>
                <td>Product Id</td>
                <td>Product Name</td>
                <td>Quantity Assigned</td>
                <td>Price Per Unit</td>
                <td>Total Cost</td>
            </th>
            <?php
            $conn = get_db();
            $query = "SELECT count(`resources`.`product_id`) AS quantity, product, category, resources.price AS price, resources.product_id FROM products
                            INNER JOIN resources ON `resources`.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` = $id
                            GROUP BY resources.product_id;";
            $result = mysqli_query($conn, $query) or die ("Could not get parts!" . $conn->error);
            while($row = mysqli_fetch_array($result)) {
                $total_cost = floatval($row['price']) * floatval($row['quantity']);
                echo "<tr>
                        <td>{$row['product']}</td>
                        <td>{$row['category']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['price']}</td>
                        <td>$total_cost</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("add_resources_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("add_resources_button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        <?php
            if($role != 'CLIENT') {
                echo "btn.onclick = function() {
                    modal.style.display = 'block';
                }";
            }
        ?>

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside the modal, close it


        var modal2 = document.getElementById("view_resources_modal");

        // Get the button that opens the modal
        var btn2 = document.getElementById("view_resources_button");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }

        // When the user clicks anywhere outside the modal, close it
        window.onclick = function(event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }else if(event.target === modal2){
                modal2.style.display = "none";
            }
        }
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>
</html>