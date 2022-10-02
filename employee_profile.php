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
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wood Street Academy</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<style>
    label {
        display: inline-block;
        width: 150px;
        text-align: center;
    }
</style>

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
    <?php
    $employee_id = 1;
    if(isset($_REQUEST['employee_id'])){
        $employee_id = $_REQUEST['employee_id'];
    }
    $query = "SELECT * FROM employees WHERE employee_id = $employee_id";
    $conn = get_db();
    $result = mysqli_query($conn, $query);
    $title = "";
    $username = "";
    $email = "";
    $mobile = "";
    $surname = "";
    $address = "";
    $firstname = "";
    $surname = "";
    if($row = mysqli_fetch_array($result)){
        $title = $row['title'];
        $firstname = $row['first_name'];
        $username = $row['username'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $surname = $row['last_name'];
        $address = $row['address'];
    }
    ?>

</header>
<div class="content-body">
    <div class="banner">
        <h2> Employee Profile </h2>
        <h4> Name: <?php echo "$firstname $surname";  ?> </h4>
    </div>

    <form action="" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username;  ?>"><br><br>
        <label for="email">Email:</label>
        <input type ="email" name="email" id="email"value="<?php echo $email;  ?>"><br><br>
        <label for="mobile">Mobile:</label>
        <input type ="text" name="mobile" id="mobile"value="<?php echo $mobile;  ?>"><br><br>
        <label for="title"> Title: </label>
        <input type="text" name = "title" id = "title" value="<?php echo $title;  ?>"><br><br>
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $address;  ?>"><br><br>
        <input type="submit" value="Update">
    </form>


</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>