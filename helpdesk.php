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
    <title>Wood Street Academy</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
    <!-- Code has not been deleted. It has been renamed to ticketing.php and will be linked to this page through a link.
        This is to allow clients to be automatically directed to the ticketing page without seeing the helpdesk page 
        which is only supposed to be visible to the secretary and admin-->
<header>
    <?php
    getHeader();
    ?>
</header>
    <script>
        let current = document.getElementById("helpdesk_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
    
        <h2>Frequently Asked Questions:</h2>
        <p>Click on the buttons for questions that apply to you</p>

        <button class="accordion">My computer does not turn on, what do I do now?</button>
        <div class="panel">
            <p>First check the computer's power cord to make sure it is completely plugged into the wall socket. If you are using a plug strip, make sure it is completely plugged into the wall socket and that the power switch on the plug strip is turned on. Some plug strips also have a built in circuit breaker which usually looks like a black or red button near the power switch. Press the button to reset it and see if that solves the problem.</p>
        </div>

        <button class="accordion">What do I do when my computer crashes?</button>
        <div class="panel">
            <p>There are many reasons why a computer may just stop working or "freeze". Most of the time there isn't much we can do about it, it is a fact of life that computer programs have become so complex that occasionally users will experience problems even when performing common tasks. When your computer no longer responds to keyboard commands your best bet is to restart the computer.</p>
        </div>

        <button class="accordion">I can't connect to my network drive anymore, what can I do?</button>
        <div class="panel">
            <p>Verify that the network cable is properly connected to the back of the computer. In addition, when checking the connection of the network cable, ensure that the LED's on the network are properly illuminated. For example, a network card with a solid green LED or light usually indicates that the card is either connected or receiving a signal. Note: generally, when the green light is flashing, this is an indication of data being sent or received.</p>
        </div>

        <button class="accordion">Can a virus damage computer hardware?</button>
        <div class="panel">
            <p>No. Computer viruses are software code designed to spread to computer files and other computers, delete files, and cause other problems with the data on the computer. So if you're experiencing an issue with a hardware device such as your printer, video card, sound card, etc. it is not due to a virus.</p>
        </div>

        <button class="accordion">If I format or erase my hard drive will it remove a virus?</button>
        <div class="panel">
            <p>If your computer is infected with a virus formatting or erasing the hard disk drive and starting over will almost always remove any type of virus. However, keep in mind if backups have been made that contain the virus, other media or drives connected to the computer have a virus, your computer is connected to another computer on a network with a virus, and/or the virus is stored on some other type of software you use with your computer it can become re-infected if not properly protected.</p>
        </div>

        <button class="accordion">Do you service businesses?</button>
        <div class="panel">
            <p>Yes of course! We specialize in supporting small to medium sized businesses in all of their technology needs. We can do everything from the ground up if you are moving into a new office (running network cables and more) or we can maintain your current computers and network.</p>
        </div>

        <button class="accordion">Do you service laptops?</button>
        <div class="panel">
            <p>Yes, we are a full service laptop repair center. We can fix your laptop power jack if it is loose, replace dead laptop screens, and replace broken hinges, or order any parts (ex. batteries, chargers, etc.) you may need.</p>
        </div>

        <button class="accordion">Do you service Macs?</button>
        <div class="panel">
            <p>Yes, we work on Mac Laptops and Desktops for both hardware and software issues. We can even make Macs and PC's work together in your network.</p>
        </div>

        <button class="accordion">How long will it take to get my computer back?</button>
        <div class="panel">
            <p>It depends on the issue (and how busy we are) but most repairs are done within 3-5 business days and sometimes even sooner! Advanced hardware repairs or repairs that require custom ordered parts can take longer depending on the severity of the issue. We take pride in having extremely fast turn-around and in many cases we have fixed our customers computers on the spot for them. All or our repairs are done "in house" to ensure the fastest turnaround time possible.</p>
        </div>

        <button class="accordion">I'm not exactly sure what is wrong with my computer, can you still help me if I can't explain the issue?</button>
        <div class="panel">
            <p>Sure! When you bring in your computer to our office, we set it up right in front of you and go over all of the issues we can see. This way you can describe the problems you are having with the computer in the best way possible.</p>
        </div>

        <button class="accordion">Do you have parts for sale?</button>
        <div class="panel">
            <p>PC Repairs isn't a retail store in the typical sense of the word, but we do stock a lot of parts that are needed for most of the repairs we do. This is to reduce waiting time for our repair jobs. If you are in need of a part, give us a call or stop in, we might just have what you're looking for!</p>
        </div>

        <button class="accordion">If I can't be without a computer while mine is being fixed, can you offer me a rental?</button>
        <div class="panel">
            <p>Unfortunately we don't offer this service anymore, but we do have Rush Service which in many cases can get your computer fixed in the same or next day!.</p>
        </div>

</div>
<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>-