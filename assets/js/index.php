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

    <p id="message"></p>
    <script src="delete_linda.js"></script>
</body>
</html>