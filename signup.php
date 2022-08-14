<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
if (isset($_SESSION['logged_in'])) {
    if($_SESSION['role']=='CLIENT' || $_SESSION['role']=='RECEPTIONIST'){
        header("location: helpdesk.php");
    }else if($_SESSION['role']=='ADMINISTRATOR'){
        header("location: admin.php");
    }else{
         header("location: workorders.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
<header value="login">
    <?php
    getHeader();
    ?>
</header>
<div class="content-body">
    <h1>Client Sign Up</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username"  placeholder="Username">
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php
        function checkUsername($username): bool
        {
            global $conn;
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                return true;
            } else {
                return false;
            }
        }
        if(isset($_REQUEST['title'])){
            $conn = get_db();
            $username = $_REQUEST['username'];
            $invalid = checkUsername($username);
            if($invalid) {
                die('<div class="alert alert-danger" role="alert">
                        Username already exists
                    </div>');
            }
            $title = $_REQUEST['title'];
            $first_name = $_REQUEST['first_name'];
            $last_name = $_REQUEST['last_name'];
            $email = $_REQUEST['email'];
            $mobile = $_REQUEST['mobile'];
            $address = $_REQUEST['address'];
            $password = str_replace(' ', '',$_REQUEST['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO clients (title, first_name, last_name, email, mobile, address) VALUES ('$title', '$first_name', '$last_name', '$email', '$mobile', '$address');";
            if ($conn->query($sql) === TRUE) {
                //echo "<p style='color: green'>$first_name $last_name has been added to the database</p>";
                $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'CLIENT');";
                if($conn->query($sql) === TRUE){
                    echo "<p style='color: green'>$username, your account has been created!</p><br>Proceed to <a href='login.php'>login</a>";
                }else{
                    $account_error = $conn->error;
                    $sql = "DELETE FROM clients WHERE email = '$email';";
                    if($conn->query($sql) === TRUE){
                        echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not create account for $username</p> <br><p style='color: red'><strong>Message: </strong>" .$account_error."</p>";
                    }
                }
            } else {
                echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not add $first_name $last_name into the database</p> <br><p style='color: red'><strong>Message: </strong>" .$conn->error."";
            }
            $conn ->close();
        }
        ?>
    </form>
    <br>
    <p>Already have an account? <a href="login.php">Login</a></p>
    <p>If you are an employee, proceed to the <a href="employee_signup.php">Employee Account SignUp</a> Page</p>

</div>

<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
    </div>
</footer>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>
