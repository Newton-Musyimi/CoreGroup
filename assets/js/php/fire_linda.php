<?php
require_once("config.php");
$conn = get_db();
$employee = mysqli_real_escape_string($conn, $_POST['id']);
$query = "DELETE FROM `coregroup`.`employees` WHERE employee_id = $employee;";
$result = mysqli_query($conn, $query) or die("Could not query for employee with id number:$employee! Contact admin for assistance: " . $conn->error);