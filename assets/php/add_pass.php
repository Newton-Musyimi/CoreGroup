<?php
require_once('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$conn = get_db();
$pass_hash = password_hash($password, PASSWORD_DEFAULT);
$query = "UPDATE employees SET password = '$pass_hash' WHERE username = '$username'";
echo $pass_hash;
mysqli_query($conn, $query) or die("Could not update password hash for user: $username! Contact admin for assistance: " . $conn->error);

$query = "INSERT INTO plain_text_pass (username, password) VALUES ('$username', '$password')";
mysqli_query($conn, $query) or die("Could not update plain text password for user: $username! Contact admin for assistance: " . $conn->error);