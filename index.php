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
    <header>
        <?php
        getHeader();
        ?>
        <!--<section class="banner">
            <h1>Woodstreet Academy</h1>
            <h3>PCRepairs Department</h3>
            <p>We offer a range of PC, laptop, phablet, and phone repairs.</p>
            <?php if(isset($_SESSION['logged_in'])){
            }else{
                echo '<a href="security/signup.php" class="btn-bgstroke">Sign Up</a>';
            } ?>

        </section>-->
        <script>
            let current = document.getElementById("home_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="middle-page">
        <section class="middle" style="background-image: url('assets/images/pexels-mateusz-dach-450035.jpg')" >
            <h1>Woodstreet Academy</h1>
            <h3>PCRepairs Department</h3>
            <p>We offer a range of PC, laptop, phablet, and phone repairs.</p>
            <?php if(isset($_SESSION['logged_in'])){
            }else{
                echo '<a href="security/signup.php" class="btn-bgstroke">Sign Up</a>';
            } ?>
        </section>
        <div class= "bottom-page">         
        </div>
        <section class="banner">


            <h2>We do all kinds of repair</h2>
            <p>At Woodstreet Academy we repair all kinds of brands<br><h2><span id="brands"></span></h2></p>
            <a href="ticketing.php" class="btn-bgstroke">Create a ticket</a>

        </section>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script>
        let brands_array = ["Samsung", "iPhone", "Dell", "ACER", "HP", "Sony"];
        let j = 0;
        let speed = 1000;
        let target = document.getElementById("brands");
        function typeWriter(){
            if(j >= brands_array.length){
                j = 0;
            }
            if(j < brands_array.length){
                target.innerHTML = brands_array[j];
                j++;
                setTimeout(typeWriter, speed);
            }
        }
        typeWriter();
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>