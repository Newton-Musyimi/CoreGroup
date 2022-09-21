<?php
$conn = get_db();
$user_id = $_SESSION['logged_in'];
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
WHERE client_id = $user_id;";
$result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);

$row = mysqli_fetch_array($result);
if (is_array($row)) {
    
}
if(isset($_POST['wo_id'])){
    global $conn;
    $query = "SELECT * FROM `workorders` WHERE `wo_id` = {$_POST['wo_id']}";
    $result = mysqli_query($conn, $query) or die("Could not query for workorder with id number: {$_POST['wo_id']}! Contact admin for assistance: " . $conn->error);
    while($row = mysqli_fetch_array($result)){
        echo "{row['wo_id']}";
    }
}
function getPendingValue(){
    global $user_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $user_id AND `workorders`.`status` = 'pending';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getInProgressValue(){
    global $user_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $user_id AND `workorders`.`status` = 'in-progress';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getCompletedValue(){
    global $user_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $user_id AND `workorders`.`status` = 'completed';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getCancelledValue(){
    global $user_id, $conn;
    $query = "SELECT 
    COUNT(`workorders`.`status`)
    FROM `coregroup`.`workorders`
    WHERE client_id = $user_id AND `workorders`.`status` = 'cancelled';";
    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);

    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
        echo $row['COUNT(`workorders`.`status`)'];
    }
}

function getAssignedTechnicians($workorder_id){
    global $conn;
    $query = "SELECT employees.username, assigned_technicians.employee_id FROM employees 
    JOIN assigned_technicians ON assigned_technicians.employee_id = employees.employee_id
    WHERE assigned_technicians.wo_id = $workorder_id;";
    $result = mysqli_query($conn, $query) or die("Could not query for workorder with id number:$workorder_id! Contact admin for assistance: " . $conn->error);
    $list = "";
    while($row = mysqli_fetch_array($result)){
        $list .= "<li>{$row['username']}</li>";
    }
    return $list;
}
function adminWorkorderTable(){
    global $user_id, $conn;
    $query = "SELECT `workorders`.*, `devices`.`device_name` AS device_name
                        FROM `coregroup`.`workorders` JOIN coregroup.devices ON workorders.device_id = devices.device_id;";

    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);
    echo "<tr>
                <th>Job Code</th>
                <th>Device</th>
                <th>Cost</th>
                <th>Status</th>
                <th>Scheduled</th>
                <th>Assigned To</th>
                <th>View</th>
            </tr>";
    while($row = mysqli_fetch_array($result)){
        $date = date('D d M Y', strtotime($row['date_started']));
        echo "<tr>
                <td>{$row['wo_id']}</td>
                <td>{$row['client_id']}</td>
                <td>{$row['device_name']}</td>
                <td>0.00</td>
                <td>{$row['status']}</td>
                <td>$date</td>
                <td>{$row['status']}</td>
                <td>{$row['status']}</td>
                <td>{$row['status']}</td>
                <td>{$row['status']}</td>
                <td>{$row['status']}</td>
                <td>
                    <button class='accordion'>Assigned Technicians</button>
                    <div class='panel'>
                    <ul>".getAssignedTechnicians($row['wo_id'])."</ul>
                    </div>
                </td>
                <td>
                    <form class='work_order_view_button'>
                        <input type='hidden' name='work_order_id' value='{$row['wo_id']}'>
                        <input type='submit' value='View'>
                    </form>
                 </td>
                 <td>
                    <button onclick(getWorkorderSummary({$row['wo_id']})) class='work_order_view_button'>
                        
                        <input type='submit' value='View'>
                    </button>
                 </td>
            </tr>";
    }
}
function clientWorkorderTable(){
    global $user_id, $conn;
    $query = "SELECT `workorders`.`wo_id`, `workorders`.`status`, `workorders`.`date_started`, `devices`.`device_name` AS name
                        FROM `coregroup`.`workorders` JOIN coregroup.devices ON workorders.device_id = devices.device_id
                        WHERE client_id = $user_id;";

    $result = mysqli_query($conn, $query) or die("Could not query for client workorder with id number:$user_id! Contact admin for assistance: " . $conn->error);
    echo "<tr>
                <th>Job Code</th>
                <th>Device</th>
                <th>Cost</th>
                <th>Status</th>
                <th>Scheduled</th>
                <th>Assigned To</th>
                <th>View</th>
            </tr>";
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
                <td>
                    <form action='workorder.php' class='work_order_view_button' method='post'>
                        <input type='hidden' name='work_order_id' value='{$row['wo_id']}'>
                        <input type='submit' value='View'>
                    </form>
                 </td>
                 <td>
                    <button onclick=\"getWorkorderSummary({$row['wo_id']})\" class='work_order_view_button'>
                        
                        VIEW
                    </button>
                 </td>
            </tr>";
    }
}
function receptionistWorkorderTable(){
    global $user_id, $conn;

}
function technicianWorkorderTable(){
    global $user_id, $conn;

}
function getWorkorderTable(){
    if(isset($_SESSION['logged_in'])) {
        $role = $_SESSION['role'];
        echo "You are a(n) $role<br>";
        if ($role == 'ADMINISTRATOR') {
            adminWorkorderTable();
        } elseif ($role == 'CLIENT') {
            clientWorkorderTable();
        } elseif ($role == 'RECEPTIONIST') {
            receptionistWorkorderTable();
        } else {
            technicianWorkorderTable();
        }
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