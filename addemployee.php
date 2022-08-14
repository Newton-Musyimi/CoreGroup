<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
if (isset($_SESSION['id'])) {
    header("location: /SysDev/CoreGroup/index.php");
}
function current_employee($conn, $email, $phone_number){
    $user_search = "SELECT `email`, `mobile` FROM `employees` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $user_search) or die ("client SELECT error!" . $conn->error);
    while($row = mysqli_fetch_array($result)){
        if($row['email'] === $email){
            echo '<p class="access_form">Email <span style="color:red;">exists</span> enter a different email!</p>';
        }
        if($row['mobile'] === $phone_number){
            echo '<p class="access_form">Phone Number <span style="color:red;">exists</span> enter a different phone number!</p>';
        }
    }
}

function standardize($column_name): string
{
    $string = str_replace(' ','',$column_name);
    $string = stripslashes($string);
    return strtolower($string);            
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = get_db();

    //$organization = $_REQUEST['org'];
    $firstname = standardize($_REQUEST['first_name']);
    $lastname = standardize($_REQUEST['last_name']);
    $title = standardize($_REQUEST['title']);
    $address = strtoupper($_REQUEST['address']);
    $email = standardize($_REQUEST['email']);
    $phone_number = $_REQUEST['mobile'];
    /*
    $password = str_replace(' ', '',$_REQUEST['password']);
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    */
        
    $query = "INSERT INTO `employees`(`first_name`, `last_name`,`email`, `title`, `mobile`, `address`) 
            VALUES ('$firstname', '$lastname', '$email','$title', '$phone_number', '$address');";

    mysqli_query($conn, $query) or die(current_employee($conn, $email, $phone_number));
    mysqli_close($conn);

    
}