<?php
session_start();
require_once("security/admin/config.php");
require_once("header.php");

//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon.png">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body id="page-top">
    <header>
        <a href="scripts/logout.php">Log out</a>
        <?php
        if(isset($_SESSION['logged_in'])){
            $role = $_SESSION['role'];
            getHeader($role);
        }else{
            echo "<h1>Header</h1>";
        }
        ?>
    </header>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/logout.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>