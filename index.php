<?php
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
session_start();
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
    <title>Woodstreet Academy</title>
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
            echo '<a href="security/logout.php" class="btn-bgstroke">Sign Up</a>';
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
    <section class="banner1">
        <h1>Woodstreet Academy</h1>
        <h3>PCRepairs Department</h3>
        <p>At Woodstreet Academy we repair all kinds of brands<br><h2><span id="brands"></span></h2></p>
    </section>
    <div class="middle-page">
        <section class="middle" style="background-image: url('assets/images/pexels-mateusz-dach-450035.jpg');" >
            <h2 id="image_text">Would you like to</h2>
            <a href="ticketing.php" class="btn-bgstroke">Create a ticket?</a>
        </section>
        <section class="banner2 ">
            
            <h3>About us</h3>
            <h4>What do we do?</h4>
            <p>We help students with their PC and laptop repairs to use their devices to excel in school.
            <h4>How do we do it?</h4>
            <p>We operate in a fully equipped technical workshop by highly trained technicians that love what they do.<br>
                Our well-trained staff will provide students with excellent service.

            </p>

        </section>
        <div class= "bottom-page">         
        </div>
        <!-- <section class="banner"></section> -->
    </div>
    
    <footer style="padding: 5px 0 5px 5px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
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