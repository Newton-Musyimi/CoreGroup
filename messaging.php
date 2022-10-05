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
<style>
    #messages { grid-area: messages; }
    #message_text { grid-area: message_text; }
    .grid-container {
    display: grid;
    grid-template-areas:
        'messages messages message_text message_text message_text message_text message_text'
        'messages messages message_text message_text message_text message_text message_text'
        'messages messages message_text message_text message_text message_text message_text'
        'messages messages message_text message_text message_text message_text message_text'
        'messages messages message_text message_text message_text message_text message_text'
        ;
    }
    #message_text{
        border-style:solid;
        max-width:75%;
        padding:5vh;
    }
    .grid-container,h2,h3{
        position: relative;
    }
    table{
        border-style:solid;
        width:25%;
    }
</style>


<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("messaging_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
         
    </header>
        <button id="compose_modal_button" class ="modal-button">Compose</button>
    <div class="content-body">

            
        <div class="grid-container">
            <input type="button" class ="modal-button" name="reply_modal_button" id="reply_modal_button" style = "float:right;"  value="Reply">
            <div id="messages">
                <table id="messaging">
                    <?php
                    $conn = get_db();
                    $username = $_SESSION['username'];
                    if($_SESSION['role'] == 'RECEPTIONIST' OR $_SESSION['role'] == 'TECHNICIAN') {
                        $sql = "SELECT * FROM messages WHERE sender = $username OR recipient = $username OR recipient = 'helpdesk' ORDER BY datetime DESC;";
                    }else if($_SESSION['role'] == 'ADMINISTRATOR') {
                        $sql = "SELECT * FROM messages";
                    }else{
                        $sql = "SELECT * FROM messages WHERE sender = $username OR recipient = $username ORDER BY datetime DESC;";
                    }

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $datetime = date('dS D F Y H:i:s A', strtotime($row['datetime']));
                            echo "<tr class=\"message_summary\" onclick='window.location=\"messaging.php?message_id={$row['message_id']}\"'>
                                        <td>{$row['title']}<br>From:{$row['sender']}</td>
                                        <td>Wo. id:{$row['recipient']}<br>$datetime</td>
                                    </tr>";
                        }
                    }
                    ?>
                </table>


            </div>
            <div id="message_text" >
                <?php

                if(isset($_REQUEST['message_id'])){
                    if($_SESSION['role'] == 'RECEPTIONIST' OR $_SESSION['role'] == 'TECHNICIAN') {
                        $sql = "SELECT * FROM messages WHERE sender = $username OR recipient = $username OR recipient = 'helpdesk' ORDER BY datetime DESC;";
                    }else if($_SESSION['role'] == 'ADMINISTRATOR') {
                        $sql = "SELECT * FROM messages";
                    }else{
                        $sql = "SELECT * FROM messages WHERE sender = $username OR recipient = $username ORDER BY datetime DESC;";
                    }
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $message_id = $row['message_id'];
                        $recipient = $row['recipient'];
                        $datetime = date('dS D F Y H:i:s A', strtotime($row['datetime']));
                        $message = $row['message'];

                ?>



                <div id="message_header" style = "padding-right:10px;">
                    <h2>Subject:<?php echo $row['title'];?> </h2><p style = "float:right; "><strong>Date:<?php echo $datetime;?></strong></p>
                    <h3>From:<?php echo $row['sender'];?></h3>
                </div>
                <div id="message_box">
                    <?php echo $row['message'];
                    }
                    }?>
                </div>
            </div>
        </div>

        <div id="compose_modal" class="modal">
            <span class="close">&times;</span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
                <!-- Insert form below -->
                    <h3>Compose</h3>
                    <label for="title"><strong>Title:</strong></label><br>
                    <input type="text" name="title"><br><br>
                    <label for="to"><strong>To:</strong></label><br>
                    <input type="text" name="to"><br><br>
                    <textarea id="message" name="message" rows="4" cols="50"></textarea><br>
                    <input type="submit"name="submit" value="Send">
                <!-- Insert form above -->

            </form>
        </div>
        <div id="reply_modal" class="modal">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
                <span class="close">&times;</span>
                <!-- Insert form below -->
                    <h3>Reply</h3>
                    <label for="title"><strong>Title:</strong></label><br>
                    <input type="text" name="title"><br><br>
                    <label for="to"><strong>To:</strong></label><br>
                    <input type="text" name="to"><br><br>
                    <textarea id="response" name="response" rows="4" cols="50"></textarea><br>
                    <input type="submit"name="submit" value="Send">
                <!-- Insert form above -->

            </form>
        </div>

    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("compose_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("compose_modal_button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

         // When the user clicks anywhere outside the modal, close it
         window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }else if(event.target == modal2){
                    modal2.style.display = "none";
                }
        }   
        // Get the modal
        var modal2 = document.getElementById("reply_modal");

        // Get the button that opens the modal
        var btn2 = document.getElementById("reply_modal_button");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>