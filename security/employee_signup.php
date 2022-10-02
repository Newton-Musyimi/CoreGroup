<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
*/
require_once('admin/config.php');
global $host;
require_once('header.php');
if (isset($_SESSION['logged_in'])) {

    if($_SESSION['role']=='CLIENT' || $_SESSION['role']=='RECEPTIONIST'){
        header("location: ticketing.php");
    }else if($_SESSION['role']=='ADMINISTRATOR'){
        header("location:$host/SysDev/CoreGroup/dashboard1.php");
    }else{
        header("location:$host/SysDev/CoreGroup/workorders.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wood Street Academy</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/security.css';?>">
</head>

<body id="page-top">
<header value="login">
    <?php
    getHeader();
    ?>
    <script>
        let current = document.getElementById("signup_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
</header>
<div class="content-body">
    <form action="signup.php" method ="POST">
        <input type="submit" value="CLIENT SIGNUP">
    </form>
    <div id="card2">
        <div id="card-content">
            <div id="card-title">
                <h2>EMPLOYEE SIGN-UP</h2>
                <div class="underline-title">

                </div>
            </div>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form" method="post">
                    <div class="form-group">
                        <label for="employee_id">Employee ID</label><br>
                        <input type="number" class="form-content" id="employee_id" name="employee_id"  placeholder="Employee ID"><br><br>
                        <div class="form-border"></div>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label><br>
                        <input type="text" class="form-content" id="username" name="username"  placeholder="Username"><br><br>
                        <div class="form-border"></div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label><br>
                        <input type="password" class="form-content" id="password" name="password" placeholder="Password"><br><br>
                        <div class="form-border"></div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="showPass" onclick="showPassword()">
                            <label class="form-check-label" for="formCheck-1">Show Password</label>
                        </div>
                    </div>

                    <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>

                    <?php
                    function standardize($string): string
                    {
                        $string = str_replace(' ', '', $string);
                        $string = stripslashes($string);
                        return strtolower($string);
                    }
                    function checkUsername($username): bool
                    {
                        global $conn;
                        $sql = "SELECT * FROM clients WHERE username='$username'";
                        $client_result = mysqli_query($conn, $sql);
                        $clients = mysqli_num_rows($client_result) > 0;
                        $sql = "SELECT * FROM employees WHERE username='$username'";
                        $employee_result = mysqli_query($conn, $sql);
                        $employees = mysqli_num_rows($employee_result) > 0;
                        if ($clients || $employees) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function checkEmployment($conn, $employee_id): bool
                    {
                        $sql = "SELECT * FROM employees WHERE employee_id='$employee_id';";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                    if(isset($_REQUEST['employee_id'])){
                        $conn = get_db();
                        $employee_id = $_REQUEST['employee_id'];
                        $employment_status = checkEmployment($conn, $employee_id);
                        if(!$employment_status) {
                            echo '<div class="alert alert-danger" role="alert">
                            Employee does not exist. Contact the administrator!
                        </div>';
                            $conn ->close();
                            exit;
                        }else{
                            $username = standardize($_REQUEST['username']);
                            $invalid = checkUsername($username);
                            if($invalid) {
                                echo '<div class="alert alert-danger" role="alert">
                            Username already exists
                        </div>';
                            }else{
                                $password = $_REQUEST['password'];
                                $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                                $sql = "UPDATE `coregroup`.`employees` 
                                                        SET
                                                        `username` = $username,
                                                        `password` = $pass_hash
                                                        WHERE `employee_id` = $employee_id;";
                                if($conn->query($sql) === TRUE){
                                    echo "<p style='color: green'>$username, your account has been created!</p><br>Proceed to <a href='login.php'>login</a>";
                                    $sql = "INSERT INTO users (username, table) VALUES ('$username', 'EMPLOYEE');";
                                    $conn->query($sql);
                                }else{
                                    echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not create account for $username</p> <br><p style='color: red'><strong>Message: </strong>" .$conn->error."</p>";
                                }
                                $conn ->close();
                            }
                        }
                    }
                    ?>
                </form>
                <br>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</div>


<footer style="padding-bottom: 32px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
    </div>
</footer>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>
