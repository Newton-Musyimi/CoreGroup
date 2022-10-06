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
    <title>Wood Street Academy</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<style>
    #table1 { grid-area: summary; }
   .grid-container {
    display: grid;
    grid-template-areas:
        'summary summary'
        'summary summary'
        'summary summary'
        'summary summary';
    }
    .table1{
        border-style: solid;
    }
</style>

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
        <h1>Device Summary</h1>
        <div class="grid-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="POST">
                <?php
                $device_id = $_POST['device_id'];
                $query ="SELECT * FROM coregroup.devices WHERE `device_id` = $device_id;";
                $conn = get_db();
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
                ?>
                <table class="table1" id ="summary" style="margin-bottom:30px;">
                    <tr>
                        <th>Device ID:</th>
                        <td><?php echo $row['device_id'];?></td>
                    </tr>
                    <tr>
                        <th>Owner ID:</th>
                        <td><?php echo $row['owner_id'];?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?php echo $row['description'];?></td>
                    </tr>
                    <tr>
                        <th>Category:</th>
                        <td><?php echo $row['category'];?></td>
                    </tr>
                    <tr>
                        <th>Brand:</th>
                        <td><?php echo $row['brand'];?></td>
                    </tr>
                    <tr>
                        <th>Model:</th>
                        <td><?php echo $row['model'];?></td>
                    </tr>
                    <tr>
                        <th>Serial Number:</th>
                        <td><?php echo $row['serial_number'];?></td>
                    </tr>
                    <tr>
                        <th>Location:</th>
                        <td><?php echo $row['location'];?></td>
                    </tr>
                    
                </table>
            </form>

        </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>