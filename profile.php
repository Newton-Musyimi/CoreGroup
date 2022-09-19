<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/profile.css';?>">
</head>

<body id="page-top">
<header>
    <?php
    getHeader();
    ?>
    <script>
        let current = document.getElementById("profile_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
    <div class="banner">
    <h2>welcome Back Akhona</h2>
    </div>
</header>
<div class="content-body">
    <form action="" method="POST">
        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="Akhona Bastile"><br><br>
        <label for="email">Email:</label>
        <input type ="email" name="email" id="name"value="akhonabastile40@gmail.com"><br><br>
        <label for="mobile">Mobile:</label>
        <input type ="text" name="mobile" id="mobile"value="0846665471"><br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="Grahamstown, Eastern Cape"><br><br>
        <input type="button" value="Update">
    </form>


</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>