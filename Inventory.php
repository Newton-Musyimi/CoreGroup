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
        <h3>Hello Mike</h3>
        <h1>All Inventory Information</h1>
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
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>