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
            let current = document.getElementById("template_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
    </div>
    <table>
       
        <table id="side_table" style="margin-bottom: 50px;">
            <tr>
                <th>Quote Date</th>
                <td>24 August 2022<td>
            </tr>
            <tr>
                <th>Quote Number</th>
                <td>QU AA0001<td>
            </tr>
            <tr>
                <th>Reference</th>
                <td>JoeSoap@gmail.com // MikeOxlong@gmail.com<td>
            </tr>

        <table calss = "table2" style="margin-top: 150px;">
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Vat</th>
                <th>Amount ZAR</th>
            </tr>
            <tr>
                <td>Samsung A22 Glass Screen</td>
                <td>1</td>
                <td>250</td>
                <td>15%</td>
                <td>250.00</td>
            </tr>
            <tr>
                <td>Glue Binding</td>
                <td>1</td>
                <td>10</td>
                <td>15%</td>
                <td>10.00</td>
            </tr>
            <tr>
                <td>2mm Screws</td>
                <td>2</td>
                <td>50</td>
                <td>15%</td>
                <td>100.00</td>
            </tr>
        </table>
        <h4>Invoice Total:</h4>
        
        <table>
        <tr>
                <td>Subtotal</td>
                <td>360.00<td>
            </tr>
            <tr>
                <td>Total standard Sales Tax</td>
                <td>54.00<td>
            </tr>
            <tr>
                <td>Discounts</td>
                <td>0.00<td>
            </tr>
            <tr>
                <th>TOTAL ZAR</th>
                <td>414.00</td> 
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