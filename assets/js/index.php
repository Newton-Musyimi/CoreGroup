<?php
session_start();
require_once('php/workorder_scripts.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <button id="fire_employee_button">Fire</button>
    </form>
    <ul>
        <li>pending:<span><?php getPendingValue(); ?></span></li>
        <li>In-Progress:<span><?php getInProgressValue(); ?></span></li>
        <li>Completed:<span><?php getCompletedValue(); ?></span></li>
        <li>Cancelled:<span><?php getCancelledValue(); ?></span></li>
    </ul>
    <p id="message"></p>
    <script src="delete_linda.js"></script>
    <script>
        Document.getElementById("pending_value") =
    </script>
</body>
</html>