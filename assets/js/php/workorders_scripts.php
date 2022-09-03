<?php
session_start();
require_once("config.php");
$conn = get_db();
$client_id = $_SESSION['client_id'];
$query = "SELECT `workorders`.`wo_id`,
`workorders`.`status`,
`workorders`.`priority`,
`workorders`.`requested_by`,
`workorders`.`client_id`,
`workorders`.`dropoff_date`,
`workorders`.`date_started`,
`workorders`.`date_completed`,
`workorders`.`dispatch_method`,
`workorders`.`dispatch_status`,
`workorders`.`dispatch_date`,
`workorders`.`device_id`,
`workorders`.`client_comments`
FROM `coregroup`.`workorders`
WHERE client_id = $client_id;";
$result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

$row = mysqli_fetch_array($result);
if (is_array($row)) {
    
}

function getPendingValue(){
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'pending';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        
    }
}

function getInProgressValue(){
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'in_progress';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        
    }
}

function getCompletedValue(){
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'completed';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        
    }
}

function getCancelledValue(){
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'cancelled';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        
    }
}