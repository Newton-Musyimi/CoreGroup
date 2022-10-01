<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
*/
require_once('admin/config.php');
require_once('header.php');
if (isset($_SESSION['logged_in'])) {
    global $host;
    if($_SESSION['role']=='CLIENT' || $_SESSION['role']=='RECEPTIONIST'){
        header("location: $host/SysDev/CoreGroup/ticketing.php");
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
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/security.css';?>">
</head>
<body id="page-top">
    <header value="login">
    <div class="logo">
                
            </div>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("login_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
      </div>
      <form method="post" class="form">

        <label for="user-email" style="padding-top:13px">
        &nbsp;Username
        </label>
        <input id="username" class="form-content" type="text" name="username" autocomplete="on" required />
        <div class="form-border"></div>
            <label for="user-password" style="padding-top:22px">&nbsp;Password
            </label>
            <input id="user-password" class="form-content" type="password" name="password" />
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" id="showPass" onclick="showPassword()">
          <label class="form-check-label" for="formCheck-1">Show Password</label>
        </div>
        <div class="form-border"></div>
        <a href="#">
          <legend id="forgot-pass">Forgot password?</legend>
        </a>
        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
        <a href="security/login.php" id="signup">Don't have account yet?</a>
      </form>
    </div>
  </div>
        

    <?php
    function standardize($string): string
    {
        $string = str_replace(' ', '', $string);
        $string = stripslashes($string);
        return strtolower($string);
    }

    function clientLogIn(): void
    {
        global $host;
        $conn = get_db();
        $username = standardize($_POST['username']);
        $password = $_POST['password'];
        $query = "SELECT `client_id`, `username`, `password` FROM `clients` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
        //echo "<p class='access_form'>Log in <span style='color:green;'>Success!</span> Username entered is okay.</p> ";
        $row = mysqli_fetch_array($result);
        $hashed_pass = $row['password'];
        if(password_verify($password, $hashed_pass)){
            $id = $row['client_id'];
            $username_query = $row['username'];
            $_SESSION['role'] = "CLIENT";
            $_SESSION['logged_in'] = $id;
            $_SESSION['username'] = $username_query;
            $_SESSION['user_table'] = "clients";
        }else{
            mysqli_close($conn);
            echo '<p>You have entered the wrong password. Try again!</p>';
            exit;
        }
        mysqli_close($conn);

        header("location:$host/SysDev/CoreGroup/workorders.php");
    }

    function employeeLogIn(): void
    {
        global $host;
        $conn = get_db();
        $username = standardize($_POST['username']);
        $password = str_replace(' ', '', $_POST['password']);
        $query = "SELECT `employee_id`, `username`, `password` FROM `employees` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
        //echo "<p class='access_form'>Log in <span style='color:green;'>Success!</span> Username entered is okay.</p> ";
        $row = mysqli_fetch_array($result);
        $hashed_pass = $row['password'];
        if(password_verify($password, $hashed_pass)){
            $id = $row['employee_id'];
            $username_query = $row['username'];
            $result = mysqli_query($conn, "SELECT `role_id` FROM `employee_role` WHERE `employee_id` = '$id';");

            if ($row = mysqli_fetch_array($result)){
                $result = mysqli_query($conn, "SELECT `role_id` FROM `employee_role` WHERE `employee_id` = '$id';");
                if ($row = mysqli_fetch_array($result)){
                    $result = mysqli_query($conn, "SELECT `role_name` FROM `roles` WHERE `role_id` = '$id';");
                    if ($row = mysqli_fetch_array($result)){
                        $role = $row['role_name'];
                        $_SESSION['role'] = $role;
                    }else{
                        $_SESSION['role'] = 'TECHNICIAN';
                    }
                }else{
                    $_SESSION['role'] = 'TECHNICIAN';
                }
            }else{
                $_SESSION['role'] = 'TECHNICIAN';
            }
        }else{
            mysqli_close($conn);
            echo '<p>You have entered the wrong password. Try again!</p>';
            exit;
        }
        mysqli_close($conn);
        $_SESSION['logged_in'] = $id;
        $_SESSION['username'] = $username_query;
        $_SESSION['user_table'] = "employees";
        header("location:$host/SysDev/CoreGroup/workorders.php");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn = get_db();
        $username = $_POST['username'];
        $query = "SELECT `table` FROM `users` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
        $row = mysqli_fetch_array($result);
        if($row['table'] == 'clients'){
            clientLogIn();
        }else{
            employeeLogIn();
        }
    }

    ?>

    <script>
        function showPassword() {
            var x = document.getElementById("user-password");
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
 <footer style="padding: 5px 0 5px 5px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>

</html>