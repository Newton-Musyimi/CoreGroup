<?php
require_once("config.php");
$conn = get_db();
$client_id = $_SESSION['logged_in'];
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
    global $client_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'pending';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getInProgressValue(){
    global $client_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'in-progress';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getCompletedValue(){
    global $client_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'completed';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getCancelledValue(){
    global $client_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $client_id AND `workorders`.`status` = 'cancelled';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getAssignedTechnicians($workorder_id){
    global $client_id, $conn;
    $query = "SELECT employees.username, assigned_technicians.employee_id FROM employees 
    JOIN assigned_technicians ON assigned_technicians.employee_id = employees.employee_id
    WHERE assigned_technicians.wo_id = $workorder_id;";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);
    $list = "";
    while($row = mysqli_fetch_array($result)){
        $list .= "<li>{$row['username']}</li>";
    }
    return $list;
}

function getWorkorderTable(){
    global $client_id, $conn;
    $query = "SELECT `workorders`.`wo_id`, `workorders`.`status`, `workorders`.`date_started`, `devices`.`device_name` AS name
    FROM `coregroup`.`workorders` JOIN coregroup.devices ON workorders.device_id = devices.device_id
    WHERE client_id = $client_id;";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$client_id! Contact admin for assistance: " . $conn->error);

    while($row = mysqli_fetch_array($result)){
        $date = date('D d M Y', strtotime($row['date_started']));
        echo "<tr>
        <td>{$row['wo_id']}</td>
        <td>{$row['name']}</td>
        <td>0.00</td>
        <td>{$row['status']}</td>
        <td>$date</td>
        <td>
            <button class='accordion'>Assigned Technicians</button>
            <div class='panel'>
            <ul>".getAssignedTechnicians($row['wo_id'])."</ul>
            </div>
        </td>
        <td><a href=\"#\">View</a></td>
    </tr>";
    }

}

function getEmployees(){
    global $conn;
    $query = "SELECT * FROM employees;";
    $result = mysqli_query($conn, $query) or die("Could not query employee details! Contact admin for assistance: " . $conn->error);
    echo "<ul>";
    while($row = mysqli_fetch_array($result)){
        echo "<li>
            {$row['first_name']} {$row['last_name']}&emsp;
            {$row['username']}&emsp;
            {$row['email']}&emsp;
            {$row['mobile']}&emsp;
            {$row['password']}&emsp;
            {$row['employee_id']}
   </li>";


    }
    echo "</ul>";
}