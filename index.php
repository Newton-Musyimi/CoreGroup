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
    <title>Wood Street Academy</title>
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
        <h1>Wood Street Academy</h1>
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
        <section class="banner1">
            <h3>Contact us</h3>
            <h4>Need a hand? Write us a message</h4>
            <form method="post">
                <label for = "full_name">Full Name:</label><br>
                <input type="text" name="full_name" required><br><br>
                <label for = "email">eMail:</label><br>
                <input type="email" name="email" required><br><br>
                <label for = "message">Message:</label><br>
                <textarea id="message" name="message" row="10" col="50"></textarea><br><br>
                <input type="submit" name ="submit" value="SEND">
            </form>
           <!-- <?php
            echo "<p style=\"color: green;\">Your submitted message has been sent!</p>";
        ?> -->
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
<!-- php for forot-password-->
<?php

include('db.php');
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
   $results = mysqli_query($con,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "<p>No user is registered with this email address!</p>";
   }
  }
   if($error!=""){
   echo "<div class='error'>".$error."</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   }else{
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://www.allphptricks.com/forgot-password/reset-password.php?
key='.$key.'&email='.$email.'&action=reset" target="_blank">
https://www.allphptricks.com/forgot-password/reset-password.php
?key='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>AllPHPTricks Team</p>';
$body = $output; 
$subject = "Password Recovery - AllPHPTricks.com";

$email_to = $email;
$fromserver = "noreply@yourwebsite.com"; 
require("PHPMailer/PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "mail.yourwebsite.com"; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "noreply@yourwebsite.com"; // Enter your email here
$mail->Password = "password"; //Enter your password here
$mail->Port = 25;
$mail->IsHTML(true);
$mail->From = "noreply@yourwebsite.com";
$mail->FromName = "AllPHPTricks";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
	}
   }
}else{
?>
<form method="post" action="" name="reset"><br /><br />
<label><strong>Enter Your Email Address:</strong></label><br /><br />
<input type="email" name="email" placeholder="username@email.com" />
<br /><br />
<input type="submit" value="Reset Password"/>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>