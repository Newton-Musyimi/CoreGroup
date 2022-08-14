<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
if (isset($_SESSION['id'])) {
    if($_SESSION['role']=='CLIENT' || $_SESSION['role']=='RECEPTIONIST'){
        header("location: helpdesk.php");
    }else if($_SESSION['role']=='ADMINISTRATOR'){
        header("location: admin.php");
    }else{
        header("location: employee_profile.php");
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
    <h1>Employee Sign Up</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="employee_id">Employee ID</label>
            <input type="text" class="form-control" id="employee_id" name="employee_id"  placeholder="Employee ID">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username"  placeholder="Username">
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
            $employee_id = $_REQUEST['employee_id'];
            $username = str_replace(' ', '',$_REQUEST['username']);
            $invalid = checkUsername($username);
            if($invalid) {
                die('<div class="alert alert-danger" role="alert">
                        Username already exists
                    </div>');
            }
            $password = str_replace(' ', '',$_REQUEST['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'CLIENT');";
            if($conn->query($sql) === TRUE){
                echo "<p style='color: green'>$username, your account has been created!</p><br>Proceed to <a href='login.php'>login</a>";
            }else{
                echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not create account for $username</p> <br><p style='color: red'><strong>Message: </strong>" .$conn->error."</p>";
                }
            $conn ->close();
        }
        ?>
    </form>
    <br>
    <p>Already have an account? <a href="login.php">Login</a></p>

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
