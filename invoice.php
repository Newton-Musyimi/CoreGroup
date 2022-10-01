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
<style>
    h1{
    border-bottom: 2px solid black;
    }
    #address { grid-area: top; }
    #side-table { grid-area: side; }
    #bottom_table { grid-area: bottom; 
    width: 100%;}

    .grid-container {
    display: grid;
    grid-template-areas:
        'top top side side side side'
        'bottom bottom bottom bottom bottom bottom';
    }
</style>


<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
     
    </header>
    <h1>Woodstreet Academy</h1>
    <div class="content-body">
        <div class="grid-container">
            <div id="address">
                
                <p>admin@woodstreet.co.za</p>
                <p>49 Bastile Drive</p>
                <p>046 566 8795</p>
            </div>
            <table id="side-table">
                <tr>
                    <th>Invoice Date</th>
                    <td>24 August 2022<td>
                </tr>
                <tr>
                    <th>Invoice Number</th>
                    <td>IVN AA0001<td>
                </tr>
                <tr>
                    <th>Reference</th>
                    <td>JoeSoap@gmail.com // MikeOxlong@gmail.com<td>
                </tr>
                <tr>
                    <th>Balance Due</th>
                    <td><strong>R 414.00</strong><td>
                </tr>

            </table>
            <table id="bottom_table"style="margin-top:150px;">
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Vat</th>
                    <th id= "inv_sum">Amount ZAR</th>
                </tr>
                <tr>
                    <td>Samsung A22 Glass Screen</td>
                    <td>1</td>
                    <td>250</td>
                    <td>15%</td>
                    <td id= "inv_sum">250.00</td>
                </tr>
                <tr>
                    <td>Glue Binding</td>
                    <td>1</td>
                    <td>10</td>
                    <td>15%</td>
                    <td id= "inv_sum">10.00</td>
                </tr>
                <tr>
                    <td>2mm Screws</td>
                    <td>2</td>
                    <td>50</td>
                    <td>15%</td>
                    <td id= "inv_sum">100.00</td>
                </tr>
            <tr></tr>
            <tr>
                <th>Invoice Total:</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum">360.00</td>
                </tr>
                <tr>
                    <td>Total standard Sales Tax</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum">54.00</td>
                </tr>
                <tr>
                    <td></td>
                    <td<td>
                </tr>
                <tr>
                    <td>Discounts</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum">0.00</td>
                </tr>
                <tr>
                    <th>TOTAL ZAR</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum"><strong>R 414.00</strong></td> 
                </tr>
            </table>
        </div>
    </div> 
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>