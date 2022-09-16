<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
global $host;

//echo $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="assets/images/favicon_io/favicon-16x16.png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="assets/images/favicon_io/favicon-32x32.png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/homepage.css';?>">
</head>

<body id="page-top">

    <header value="home">
        <div class ="navbar"> <!-- correction required here - the navbar class shouldn't be declared here because it's clashing with header.php -->
        <div class="logo"> <!-- THIS -->
                <img src="assets/images/Picture1.png" alt="Core group"> <!-- THIS -->
        </div>
                <h3>Core Group</h3> <!-- THIS -->
                <p>Because we care.....</p> <!-- THIS --> 
            <?php
            getHeader();
            ?>
        </div>
    </header>
    <div class="middle-page">

    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <div class= "bottom-page">
        <form action="security/login.php" method="POST">
            <input type = "submit" value ="Create a Ticket">
        </form>
    </div>
        
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>