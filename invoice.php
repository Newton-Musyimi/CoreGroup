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
            <?php
                $invoice_id = $_POST['invoice_id'];
                $query ="SELECT * FROM coregroup.invocies WHERE `invoice_id` = $invoice_id;";
                $conn = get_db();
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_array($result);
            ?>
            <table id="side-table">
                <tr>
                    <th>Invoice Date</th>
                    <td><?php echo $row['date'];?></td>
                </tr>
                <tr>
                    <th>Invoice Number</th>
                    <td><?php echo $row['invoice_number'];?></td>
                </tr>
                <tr>
                    <th>Reference</th>
                    <td><?php echo $row['reference'];?></td>
                </tr>
                <tr>
                    <th>Balance Due</th>
                    <td><?php echo $row['balance_due'];?></td>
                </tr>

            </table>
            <table id="bottom_table"style="margin-top:150px;">
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Vat</th>
                    <th id= "inv_sum">Amount ZAR</th>
                    <?php
                    
                    ?>
                </tr>
                <tr>
                    <td><?php echo $row['description']?></td>
                    <td><?php echo $row['quantity']?></td>
                    <td><?php echo $row['unit_price']?></td>
                    <td><?php echo $row['vat']?>%</td>
                    <td id= "inv_sum"><?php echo $row['amount_ZAR']?></td>
            <tr>
                <th>Invoice Total:</th>
                <td></td>
                <td></td>
                <td></td>
                <td><?php echo $row['invoice_total']?></td>
            </tr>
            <tr>
                    <td>Subtotal</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum"><?php echo $row['subtotal']?></td>
                </tr>
                <tr>
                    <td>Total standard Sales Tax</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum"><?php echo $row['total_standard_sales_tax']?></td>
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
                    <td id= "inv_sum"><?php echo $row['discounts']?></td>
                </tr>
                <tr>
                    <th>TOTAL ZAR</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td id= "inv_sum"><strong><?php echo $row['total_ZAR']?></strong></td> 
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