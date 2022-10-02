<?php
session_start();
if(!isset($_SESSION['username'])){
    top("location: security/login.php");
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


        if(!isset($_REQUEST['work_order_id'])){
            echo "<p class='access_form'>Failed To Get Workorder: <span style='color:red;'>No Workorder ID Selected!</span> Go back to <a href='workorders.php'>Workorders Page</a> and Select a Workorder to 'View'</p>";
        }else{
            require_once("assets/php/Workorder.php");
            $id = $_REQUEST['work_order_id'];
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
                    <td><?php echo $workorder['client_id'];?></td>
                </tr> 
            </table>
            <table id="table2" style="margin-bottom:30px;"> 
                <tr>
                    <th>Device type:</th>
                    <td></td>
                </tr> 
                <tr>
                    <th>Device brand:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Model type:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Serial Number:</th>
                    <td></td>
                </tr>
                <tr>
                    <th><?php echo $workorder['techs'];?></th>
                    <td>
                        <form action="" id="add_technician_form" method="POST">
                            <select name="assignedto" id="assignedto">
                                <?php
                                $conn = get_db();
                                //SQL Code that gets value of employee id that is not assigned to a specific workorder
                                $query = "SELECT employee_id, first_name, last_name 
                                            FROM employees 
                                            WHERE employee_id NOT IN 
                                                  (SELECT employee_id 
                                                   FROM assigned_technicians 
                                                   WHERE wo_id = $id) 
                                              AND title = 'TECHNICIAN';";
                                $result = mysqli_query($conn, $query) OR DIE ("Could not get technicians!".$conn->error);
                                while($row = mysqli_fetch_array($result)){
                                    echo "<option value=\"{$row['employee_id']}\">{$row['first_name']} {$row['last_name']}</option>";
                                }
                                ?>

                            </select>
                            <input type="hidden" name="workorder_id" value="<?php echo $id;?>">
                            <input type="submit" name="add_assignee" value="Add Assignee">
                            <?php
                            if(isset($_REQUEST['add_assignee'])){

                            }
                            ?>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Parts used</th>
                    <td><button type= "button" class ="modal-button" name = "add_resources_button" id="add_resources_button">Add Resources</button></td>
                </tr>
            </table>
            <table id="table3" style="margin-bottom:30px;">
                <tr>
                    <th>Requested by:</th>
                    <td><?php echo $workorder['request_type'];?></td>
                </tr>
                <tr>
                    <th>Date started:</th>
                    <td><?php echo $workorder['date_started'];?></td>
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
                    <td><form action="" method="POST" enctpye="multipart/form-data">
                        <input type="file" id="documentation" name="documentation">

                    </form></td>
                </tr> 
                <tr>
                    <th>Hours Worked</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dispatch:</th>
                    <td><?php echo $workorder['dispatch_status'];?></td>
                </tr>
                <tr>
                    <th>Job Status: <?php echo $workorder['status'];?></th>
                    <td><form action="" method="POST">
                        <select name="job_status" id="job_status">
                            <option value="pending">Pending</option>
                            <option value="in-progress">In-Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option> 
                            
                    </form></td>
                </tr>
            </table>  
        </div>             

    </div>
    <div id="add_resources_modal" class="modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
                        <h2>Assign Resources</h2>
                        <h3>Workorder</h3>
                        <table>
                            <tr> 
                                <th>Product_Id</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Quantity to assign</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Screen</td>
                                <td>2</td>
                                <td><input type= "number" name="quantity_to_assign" id="quantity_to_assign">
                                    <input type="submit" value="Assign"></td>
                            </tr>
                        </table>
            <!-- Insert form above -->

        </form>
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