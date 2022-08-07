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
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
    </header>
    <div class="content-body">

    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/js/jquery.min.js';?>"></script>
    <script src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js';?>"></script>
    <script src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/js/logout.js';?>"></script>
    <script src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>