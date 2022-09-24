<?php
session_start();
require_once("php/config.php");
require_once('php/workorders_scripts.php');
//phpinfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<body>
    <ul>
        <li>pending:<span><?php getPendingValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li>In-Progress:<span><?php getInProgressValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li>Completed:<span><?php getCompletedValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
        <li>Cancelled:<span><?php getCancelledValue(); //FOUND IN assets/php/workorders_scripts.php?></span></li>
    </ul>
    <table>
        <?php getWorkorderTable(); //FOUND IN assets/php/workorders_scripts.php?>


    </table>
    <h3>Employees</h3>
    <?php
    getEmployees();
    ?>
    <br>
    <hr>
    <p>We work on <span id="brands"></span></p>
    <form action="" method="POST" style="width:50%;" id="create_pass">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="password" placeholder="password">
        <input type="submit" value="CREATE PASSWORD">
    </form>
    <form action="" method="POST" style="width:50%;" id="send_mail">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="subject" placeholder="subject">
        <input type="text" name="message" placeholder="message">
        <input type="submit" value="SEND MAIL">
        <p id="mail_response"></p>
    </form>

    <script>
        // submit form with ajax without jquery
        document.getElementById('create_pass').addEventListener('submit', function(e){
            e.preventDefault();
            let form = new FormData(this);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/add_pass.php', true);
            xhr.onload = function(){
                console.log(this.responseText);
            }
            xhr.send(form);
        });
        document.getElementById('send_mail').addEventListener('submit', function(e){
            e.preventDefault();
            let form = new FormData(this);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/send_mail.php', true);
            xhr.onload = function(){
                document.getElementById("mail_response").innerText = this.responseText;
            }
            xhr.send(form);
        });
    </script>


    <p id="message"></p>
    <script>
        let acc = document.getElementsByClassName("accordion");
        let i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                let panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
        let brands_array = ["Samsung", "Iphone", "Dell", "ACER", "HP", "Sony"];
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
</body>
</html>