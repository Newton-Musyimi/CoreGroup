<?php
session_start();
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
    </style>
    <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'].'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<body>
    <ul>
        <li>pending:<span><?php getPendingValue(); ?></span></li>
        <li>In-Progress:<span><?php getInProgressValue(); ?></span></li>
        <li>Completed:<span><?php getCompletedValue(); ?></span></li>
        <li>Cancelled:<span><?php getCancelledValue(); ?></span></li>
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
        <?php getWorkorderTable(); ?>


    </table>
    <h3>Employees</h3>
    <?php
    getEmployees();
    ?>

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