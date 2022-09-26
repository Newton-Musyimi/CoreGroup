<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
$host = "http://".$_SERVER['HTTP_HOST'];
require_once("config.php");
$conn = get_db();
$employee = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT employee_id, first_name, last_name, title, mobile, email, address FROM `coregroup`.`employees` WHERE employee_id = $employee;";
$result = mysqli_query($conn, $query) or die("Could not query for employee with id number:$employee! Contact admin for assistance: " . $conn->error);

$row = mysqli_fetch_array($result);
if (is_array($row)) {
    $id = $row['employee_id'];
    $name = $row['first_name']." ".$row['last_name'];
    $position = $row['title'];
    $mobile = $row['mobile'];
    $email = $row['email'];
    $address = $row['address'];

    $profile = array(
        "id" => $id,
        "name" => $name,
        "position" => $position,
        "mobile" => $mobile,
        "email" => $email,
        "address" => $address
    );

    header('Content-type: application/json');
    echo json_encode($profile);
}
