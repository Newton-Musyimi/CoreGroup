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
            let current = document.getElementById("template_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
        <h1>Device Summary</h1>
        <div class="grid-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="POST">
        <table class="table1" style="margin-bottom:30px;">
            <tr>
                <th>IMAGE:</th>
                <td><img src="assets/images/hardware-bg.jpg" class="site_images" ></td>
            </tr>
            <tr>
                <th>Device ID:</th>
                <td>1</td>
            </tr> 
            <tr>
                <th>Owner ID:</th>
                <td>3</td>
            </tr>
            <tr>
                <th>Description:</th>
                <td><input type="text" name="description" value="descript" /></td>
            </tr>
            <tr>
                <th>Category:</th>
                <td>desktop </td>
            </tr>
            <tr>
                <th>Brand:</th>
                <td>APPLE</td>
            </tr>
            <tr>
                <th>Model:</th>
                <td>MacBook Pro</td>
            </tr>
            <tr>
                <th>Serial Number:</th>
                <td>0000900753</td>
            </tr>
            <tr>
                <th>Location:</th>
                <td><input type="text" name="location" value="location" /></td>
            </tr>
            <tr>
                <th>Device Name:</th>
                <td><input type="text"  name="device_name" value="device name" /></td>
            </tr>
        </table>
        </form>
           
        

    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>