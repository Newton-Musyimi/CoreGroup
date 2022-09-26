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
        <h3>Welcome Back, Mike</h3>
        <h1>All Staff information</h1>
    </header>
    <div class="content-body">
        <table>
            <tr>
                <th>Staff Name</th>
                <th>eMail</th>
                <th>Mobile</th>
                <th>Title</th>
                <th>Address</th>
            </tr>
            <tr>
                <td>Akhona Bastile</td>
                <td>akhonabastile40@gmail.com</td>
                <td>0823153376</td>
                <td>Technician</td>
                <td>PE Bru</td>
                
            </tr>
            <tr>
                <td>Newton Muso</td>
                <td> g19m8045@campus.ru.ac.za</td>
                <td>0791411796</td>
                <td>Technician</td>
                <td>Kenya</td>
               			 		
            </tr>
            <tr>
                <td> Sandra Muyodi</td>
                <td>g20m2920@campus.ru.ac.za</td>
                <td>0673308480</td>
                <td>Administrator</td>
                <td>Kenya</td>
               						

            </tr>
            <tr>
                <td> Matthew Strachan</td>
                <td>g19s4128@campus.ru.ac.za</td>
                <td>0605268744</td>
                <td>Administrator</td>
                <td>PA BRU</td>
               				 	

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