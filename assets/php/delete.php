<?php
require_once ('config.php');
if(isset($_REQUEST['device_id'])){
    $device_id = $_REQUEST['device_id'];
    $query = "DELETE FROM `coregroup`.`devices` WHERE `device_id` = $device_id;";
    $conn = get_db();
    $result = mysqli_query($conn, $query);
    if($result){
        echo "Device deleted successfully!";
    }else{
        echo "Device could not be deleted!";
    }
}

if(isset($_REQUEST['document_id'])){
    $document_id = $_REQUEST['document_id'];
    $query = "DELETE FROM `coregroup`.`documents` WHERE `document_id` = $document_id;";
    $conn = get_db();
    $result = mysqli_query($conn, $query);
    if($result){
        echo "Document deleted successfully!";
    }else{
        echo "Document could not be deleted!";
    }
}

