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
    <link rel="icon" type="assets/images/favicon_io/favicon-16x16.png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="assets/images/favicon_io/favicon-32x32.png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
    </header>
    <div class="content-body">
    <table>
        <tr>
            <th>Document Id:</th>
            <th>Name:</th>
            <th>Device Id:</th>
            <th>Uploaded by:</th>
            <th>Type:</th>
            <th>Description:</th>
            <th></th>
        </tr>
        <?php
        $query = "SELECT * FROM coregroup.documents;";
        $conn = get_db();
        $result = mysqli_query($conn, $query);
        while ( $row = mysqli_fetch_array($result)){
            $today = date("Y-m-d");
            $name = $today. "_" . $row['name'];
            echo "<tr>";
            echo "<td>{$row['document_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['device_id']}</td>";
            echo "<td>{$row['uploaded_by']}</td>";
            echo "<td>{$row['type']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td><a href=\"{$row['file_path']}\" download=\"$name\"><button class =\"tab_button\"type=\"button\">Download</button></a></td>";
            echo "<td><a href=\"assets/php/delete.php?document_id={$row['document_id']}\"><button class =\"tab_button\" type=\"button\">Delete</button></a></td>";
            echo "</tr>";
        }
        ?>
    </table>
        <?php
        if(isset($_REQUEST['add_documentation'])){
            $document_id=$_REQUEST['document_id'];
            $name = $_REQUEST['name'];
            $device_id = $_REQUEST['device_id'];
            $uploaded_by = $_REQUEST['uploaded_by'];
            $type = $_REQUEST['type'];
            $description = $_REQUEST['description'];
            $query = "INSERT INTO `coregroup`.`documents`
                (`document_id`,
                `name`,
                `device_id`,
                `uploaded_by`,
                `file_path`,
                `type`,
                `description`)
                VALUES
                ($document_id,
                $name,
                $device_id,
                $uploaded_by,
                $type,
                $description,
                );
                ";
            $conn = get_db();
            $result = mysqli_query($conn, $query);        
    }
        ?>
        
    
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>