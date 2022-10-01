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
            let current = document.getElementById("orders_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
        <table id="order_details">
            <tr>
                <th>Order Id:</th>
                <th>Product Id:</th>
                <th>Ordered by:</th>
                <th>Date Ordered:</th>
                <th>WorkOrder Id:</th>
                <th>Quantity:</th>
                <th>Cost:</th>
                <th>Order Status:</th>
                <th>Date Collected:</th>
                <th>Collected:</th>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>Newton</td>
                <td>20/9/2022</td>
                <td>1</td>
                <td>10</td>
                <td>R1500</td>
                <td>Ongoing</td>
                <td>30/10/2022</td>
                <td>Not Collectd</td>
            </tr>
            <tr>
                <td>2</td>
                <td>2</td>
                <td>Newton</td>
                <td>20/9/2022</td>
                <td>2</td>
                <td>700</td>
                <td>R500</td>
                <td>Ongoing</td>
                <td>30/10/2022</td>
                <td>Collectd</td>
            </tr>
            <tr>
                <td>3</td>
                <td>3</td>
                <td>Sandra</td>
                <td>20/9/2022</td>
                <td>3</td>
                <td>90</td>
                <td>R1700</td>
                <td>Ongoing</td>
                <td>30/10/2022</td>
                <td>Collectd</td>
            </tr>   
        </table>

    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>