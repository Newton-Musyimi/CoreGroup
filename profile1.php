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
    <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
            <button class="btn btn-primary py-0" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <script>
        let current = document.getElementById("profile_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
    <?php
    $table = $_SESSION['user_table'];
    $query = "SELECT * FROM $table WHERE username = '".$_SESSION['username']."'";
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
        if($table === 'employees'){
            $title = $row['title'];
        }else{
            $title = "Client";
        }
        $firstname = $row['first_name'];
        $username = $row['username'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $surname = $row['last_name'];
        $address = $row['address'];
        $profile_picture = $row['profile_picture'];
    }
    ?>
    
</header>
<div class="content-body">
    <div class="banner">
        <h2 id= "profile_title" > Welcome back <?php echo "$firstname $surname";  ?></h2>
    </div>
    <div id="profile_picture">
            <p ><strong>Username: </strong><?php echo $username;  ?></p>
            <p ><strong>Title: </strong><?php echo $title;  ?></p>
            <img src="<?php echo $profile_picture; ?>" class="site_images">

    </div>
    
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type ="email" name="email" id="email"value="<?php echo $email;  ?>"><br><br>
        <label for="mobile">Mobile:</label>
        <input type ="text" name="mobile" id="mobile"value="<?php echo $mobile;  ?>"><br><br>
        
        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php echo $address;  ?>"><br><br>
        <input type="submit" name="update_profile_details" value="Update">
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