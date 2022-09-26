<?php
define('SERVERNAME', 'is3-dev.ict.ru.ac.za');
define('USERNAME', 'G19M8045');
define('PASSWORD', 'G19M8045');
define('DATABASE', 'coregroup');
$host = "http://".$_SERVER['HTTP_HOST'];

//$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) OR die("Could not connect to MySQL: " . mysqli_connect_error() . " Contact IT for assistance!");
function get_db(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) OR die("Could not connect to MySQL: " . mysqli_connect_error() . " Contact IT for assistance!");
    return $conn;
}
/*
if(isset($_SESSION['id'])){
    echo "User ID: ".$_SESSION['id']." </br>First Name: ".ucfirst($_SESSION['firstname']);
}
mysqli_set_charset($conn, 'utf8mb4');
*/