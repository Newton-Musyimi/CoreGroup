<?php
session_start();
require_once("php/config.php");
require_once('php/workorders_scripts.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .active, .accordion:hover {
            background-color: #ccc;
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: white;
            overflow: hidden;
        }
        hr{
            border: 1px solid black;

        }
    </style>
    <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<body>
    <ul>
        <li>pending:<span><?php getPendingValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>In-Progress:<span><?php getInProgressValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>Completed:<span><?php getCompletedValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
        <li>Cancelled:<span><?php getCancelledValue(); //FOUND IN assets/js/php/workorders_scripts.php?></span></li>
    </ul>
    <table>
        <tr>
            <th>Job Code</th>
            <th>Device</th>
            <th>Cost</th>
            <th>Status</th>
            <th>Scheduled</th>
            <th>Assigned To</th>
            <th>View</th>
        </tr>
        <?php getWorkorderTable(); //FOUND IN assets/js/php/workorders_scripts.php?>


    </table>
    <h3>Employees</h3>
    <?php
    getEmployees();
    ?>
    <br>
    <hr>
    <form action="" method="POST">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="password" placeholder="password">
        <input type="submit" value="CREATE PASSWORD">
    </form>

    <script>
        // submit form with ajax without jquery
        document.querySelector('form').addEventListener('submit', function(e){
            e.preventDefault();
            var form = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'assets/js/php/workorders_scripts.php?pass=\'true\', true);
            xhr.onload = function(){
                console.log(this.responseText);
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
    </script>
    <script src="delete_linda.js"></script>
</body>
</html>