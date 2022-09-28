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
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<style>
    h1{
    border-bottom: 2px solid black;
    }
    .table1 { grid-area: top; }
    .table2 { grid-area: middle1; }
    .table3 { grid-area: middle2; 
    width: 100%;}
    .table3 { grid-area: footer; }

    .grid-container {
    display: grid;
    grid-template-areas:
        'top top top top top top'
        'middle1 middle1 middle1 middle2 middle2 middle2'
        'footer footer footer footer footer footer';
    }
</style>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("workorder_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
        
</header>
    <div class="content-body">
        
        <h1>WorkOrder Summary</h1>
        <h2>Work Order number:</h2> 
        <div class="grid-container">
            <table class="table1" style="margin-bottom:30px;">
                <tr>
                    <th>Date:</th>
                    <td></td>
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
                    <td></td>
                </tr>
                <tr>
                    <th>Ticket Number:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Customer Name:</th>
                    <td></td>
                </tr> 
            </table>
            <table class="table2" style="margin-bottom:30px;"> 
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
                    <th>Assigned to:</th>
                    <td><form action="" method="POST"><select name="assignedto" id="assignedto">
                        <option value="tech1">Akhona Bastile</option>
                        <option value="tech2">Sandra Muyodi</option>
                        <option value="tech3">Newton Musyimi</option>
                        <option value="tech4">Matthew Strachan</option>   
                    </form></td>
                </tr>
            </table>
            <table class="table3" style="margin-bottom:30px;">
                <tr>
                    <th>Requested by:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Date started:</th>
                    <td></td>
                </tr>   
                <tr>
                    <th>Date completed</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Comments</th>
                    <td></td>
                </tr>
            </table>
            <table class="table4" style="margin-bottom:30px;"> 
                <tr>
                    <th>Documentation:</th>
                    <td><form action="" method="POST" enctpye="multipart/form-data">
                        <input type="file" id="documentation" name="documentation">

                    </form></td>
                </tr> 
                <tr>
                    <th>Device brand:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Hours Worked</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Dispatch:</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Job Status:</th>
                    <td></td>
                </tr>
            </table>  
        </div>             
        <?php
        $id = "";
        if(!isset($_REQUEST['work_order_id'])){
            echo "<p class='access_form'>Failed To Get Workorder: <span style='color:red;'>No Workorder ID Selected!</span> Go back to <a href='workorders.php'>Workorders Page</a> and Select a Workorder to 'View'</p>";
        }else{
            $id = $_REQUEST['work_order_id'];
            //$conn = get_db();
            //getWorkorderSummary($id);
        }
        if (isset($_REQUEST['documentation'])){

        }
        ?>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>