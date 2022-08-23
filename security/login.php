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
        header("location: helpdesk.php");
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
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<body id="page-top">
    <header value="login">
        <?php
        getHeader();
        ?>
    </header>
    <div class='tab'>
        <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'clientLoginForm')">Client Login</button>
        <button class="tablinks" onclick="openTab(event, 'employeeLoginForm')">Employee Login</button>
    </div>
    <div id='clientLoginForm' class='tabcontent'>
        <div class="content-body">
            <h1>Client Log In</h1>
            <table>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <tr>
                        <td><label for="username"><strong>USERNAME:</strong></label><br></td>
                        <td><input type="text" id="username" name="username" value="clientnewton" required><br></td>
                    </tr>
                    <input type="hidden" name="user_type" value="client">
                    <tr>
                        <td><label for="password"><strong>PASSWORD:</strong></label><br></td>
                        <td><input type="password" id="password" name="password" value="g19m80452022"><br><br></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="submit" name="submit" value="LOG IN"></td>
                    </tr>
                </form>
            </table>
        </div>
    </div>
    <div id='employeeLoginForm' class='tabcontent'>
        <div class="content-body">
            <h1>Employee Log In</h1>
            <table>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <tr>
                        <td><label for="username"><strong>USERNAME:</strong></label><br></td>
                        <td><input type="text" id="username" name="username" value="newtonmusyimi" required><br></td>
                    </tr>
                    <input type="hidden" name="user_type" value="employee">
                    <tr>
                        <td><label for="password"><strong>PASSWORD:</strong></label><br></td>
                        <td><input type="password" id="password" name="password" value="g19m80452022"><br><br></td>
                    </tr>
                    <tr>
                        <td><input type="submit" class="submit" name="submit" value="LOG IN"></td>
                    </tr>
                </form>
            </table>
        </div>
    </div>

    <?php
    function standardize($string): string
    {
        $string = str_replace(' ', '', $string);
        $string = stripslashes($string);
        return ucfirst($string);
    }

    function clientLogIn(){
        global $host;
        $conn = get_db();
        $username = standardize($_POST['username']);
        $password = str_replace(' ', '', $_POST['password']);
        $query = "SELECT `client_id`, `username`, `password` FROM `clients` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);
        //echo "<p class='access_form'>Log in <span style='color:green;'>Success!</span> Username entered is okay.</p> ";
        $row = mysqli_fetch_array($result);
        $hashed_pass = $row['password'];
        if(password_verify($password, $hashed_pass)){
            $id = $row['client_id'];
            $username_query = $row['username'];
            $_SESSION['role'] = "CLIENT";
        }else{
            echo '<p>You have entered the wrong password. Try again!</p>';
            exit;
        }
        mysqli_close($conn);
        $_SESSION['logged_in'] = $id;
        $_SESSION['username'] = $username_query;
        header("location:$host/SysDev/CoreGroup/client_workorders.php");
    }

    function employeeLogIn(){
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
            echo '<p>You have entered the wrong password. Try again!</p>';
            exit;
        }
        mysqli_close($conn);
        $_SESSION['logged_in'] = $id;
        $_SESSION['username'] = $username_query;
        header("location:$host/SysDev/CoreGroup/dashboard.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['user_type'] == 'client'){
            clientLogIn();
        }else{
            employeeLogIn();
        }
    }

    ?>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>