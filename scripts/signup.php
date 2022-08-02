<?php
require_once('/SysDev/CoreGroup/security/admin/config.php');
if (isset($_SESSION['id'])) {
    header("location: /SysDev/CoreGroup/index.php");
}
function current_employee($conn, $user_id, $email, $phone_number){
    $user_search = "SELECT `user_id`, `email`, `mobile` FROM `employees` WHERE `employee_id` = '$user_id'";
    $result = mysqli_query($conn, $user_search) or die ("client SELECT error!" . $conn->error);
    while($row = mysqli_fetch_array($result)){
        if($row['user_id'] === $user_id){
            echo '<p class="access_form">ID <span style="color:red;">exists</span> pick a different username!</p>';
        }
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
    return strtolower($string);            
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) OR die("Could not connect to MySQL: " . mysqli_connect_error() . "<br>Contact IT for assistance!");

    //$organization = $_REQUEST['org'];
    $firstname = standardize($_REQUEST['first_name']);
    $lastname = standardize($_REQUEST['last_name']);
    $user_id = standardize($_REQUEST['user_id']);
    $sex = ($_REQUEST['gender']);
    if($sex === "male"){
        $gender = 1;
    }else{
        $gender = 0;
    }
    $email = standardize($_REQUEST['email']);
    $phone_number = $_REQUEST['mobile'];
    $password = str_replace(' ', '',$_REQUEST['password']);
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "SELECT `user_id`, `employee_status` FROM `employees` WHERE `email` = '$user_id';";
    
    $result = mysqli_query($conn, $query) or die("If you are an employee then you need to see human resources to get registered before you can create an account." . $conn->error);
    $row = mysqli_fetch_array($result);
    if($row['employee_status'] == 1 && $row['user_id'] == $user_id){
        
        $query = "INSERT INTO `users`(`first_name`, `last_name`, `user_id`, `email`, `mobile`, `password`) 
                VALUES ('$firstname', '$lastname', '$user_id', '$email','$phone_number', '$pass_hash');";
                
        mysqli_query($conn, $query) or die(current_employee($conn, $user_id, $email, $phone_number));
        mysqli_close($conn);
        echo 'Account created. proceed to <a href="login.php">log in</a>
        <script> location.replace("login.php"); </script>';
        
    }else{
        echo 'You are not an employee. If you are, contact the manager for assistance!';
        mysqli_close($conn);
    }
    
}