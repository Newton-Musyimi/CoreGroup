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
        header("location:$host/SysDev/CoreGroup/dashboard.php");
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
    <title>Core Group</title>
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
    <form action="employee_signup.php" method ="POST">
        <input type="submit" value="EMPLOYEE SIGNUP" id = emp_sign_up_button>
    </form>
    <div id="card2">
        <div id="card-content">
            <div id="card-title">
                <h2>CLIENT<br>SIGN-UP</h2>
                <div class="underline-title">

                </div>
            </div>
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="client" value="CLIENT">
                    <div class="form-group">
                        <label for="username">Username</label><br>
                        <input type="text" class="form-content" id="username" name="username"  placeholder="Username"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label><br>
                        <input type="text" class="form-content" id="first_name" name="first_name" placeholder="First Name" >
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label><br>
                        <input type="text" class="form-content" id="last_name" name="last_name" placeholder="Last Name"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" class="form-content" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label><br>
                        <input type="text" class="form-content" id="mobile" name="mobile" placeholder="Mobile"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label><br>
                        <input type="text" class="form-content" id="address" name="address" placeholder="Address"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><br>
                        <input type="password" class="form-content" id="password" name="password" placeholder="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>
                        <div class="form-border"></div>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label><br>
                        <input type="password" class="form-content" onchange="confirmPass(this)" id="confirm-password" name="confirm-password" placeholder="confirm-password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must be entered exactly the same as the password above"><br><br>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="showPass" onclick="showPassword()">
                            <label class="form-check-label" for="formCheck-1">Show Password</label>
                        </div>
                        <p id="confirm-password-error"></p>
                        <div class="form-border"></div>
                    </div>

                    <button type="submit" id="submit-btn" class="form-content btn btn-primary">Submit</button><br><br>

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
                    if(isset($_REQUEST['client'])){
                        $conn = get_db();
                        $username = standardize($_REQUEST['username']);
                        $invalid = checkUsername($username);
                        if($invalid) {
                            die('<div class="alert alert-danger" role="alert">
                            Username already exists
                        </div>');
                        }
                        $user_type = $_REQUEST['client'];
                        $first_name = $_REQUEST['first_name'];
                        $last_name = $_REQUEST['last_name'];
                        $email = $_REQUEST['email'];
                        $mobile = $_REQUEST['mobile'];
                        $address = $_REQUEST['address'];
                        $password = str_replace(' ', '',$_REQUEST['password']);
                        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO clients (username, first_name, last_name, email, mobile, address, password) VALUES ('$username', '$first_name', '$last_name', '$email', '$mobile', '$address', '$pass_hash');";
                        if ($conn->query($sql) === TRUE) {
                            //echo "<p style='color: green'>$first_name $last_name has been added to the database</p>";
                            $get_client_id_query = "SELECT client_id FROM clients WHERE email='$email';";
                            $result = mysqli_query($conn, $get_client_id_query);
                            $row = mysqli_fetch_assoc($result);
                            $user_id = $row['client_id'];
                            $sql = "INSERT INTO users (username, coregroup.users.table) VALUES ('$username', 'clients');";
                            if($conn->query($sql) === TRUE){
                                $sql = "INSERT INTO plain_text_pass (username, password) VALUES ('$username', '$password');";
                                $plain_pass_success = "";
                                if($conn->query($sql) === TRUE){
                                    $plain_pass_success = "Plain text password has been added to the database";
                                }else{
                                    $plain_pass_success = "Plain text password has not been added to the database: ".$conn->error;
                                }
                                echo "<p style='color: green'>$username, your account has been created!</p><br><p>Proceed to <a href='login.php'>login</a> $plain_pass_success</p>";
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
            </div>

        </div>
    </div>
</div>


<footer style="padding: 5px 0 5px 5px;">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
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
        var y = document.getElementById("confirm-password");
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
</script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>
