<?php
session_start();
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
    <h1>Customer Portal</h1>
    <img src="assets/images/Picture1.png">
    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <form action="" method ="POST">
        <input type="submit" value="ADD REPAIR JOB">
    </form>
<table>
    <tr>
       <th>Job Code</th> 
       <th>Device</th> 
       <th>Cost</th> 
       <th>Status</th> 
       <th>Scheduled</th> 
       <th>Assigned To</th> 
       <th>View</th> 
    </tr>
        <td>1</td>
        <td>inspiron 15</td>
        <td>R 350.00</td>
        <td>Completed</td>
        <td>6/8/2022</td>
        <td><a href="#">Assigned To</a></td>
        <td><a href="#">View</a></td>
    <tr>
        <td>2</td>
        <td>inspiron 15</td>
        <td>R 350.00</td>
        <td>In Progress</td>
        <td>6/9/2022</td>
        <td><a href="#">Assigned To</a></td>
        <td><a href="#">View</a></td> 
    </tr>
    <tr>
        <td>3</td>
        <td>Acer</td>
        <td>R 30.00</td>
        <td>Cancelled</td>
        <td>5/9/2022</td>
        <td><a href="#">Assigned To</a></td>
        <td><a href="#">View</a></td> 
    </tr>
    <tr>
        <td>4</td>
        <td>Acer</td>
        <td>R 30.00</td>
        <td>Cancelled</td>
        <td>5/9/2022</td>
        <td><a href="#">Assigned To</a></td>
        <td><a href="#">View</a></td> 

    </tr>
    </table>

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/jquery.min.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/logout.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>
