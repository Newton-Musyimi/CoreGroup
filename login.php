<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
if (isset($_SESSION['id'])) {
    if($_SESSION['role']=='CLIENT' || $_SESSION['role']=='RECEPTIONIST'){
        header("location: helpdesk.php");
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
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon.png">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
    </header>
    <form action="login.php" method="POST">
        <label for="username">USERNAME: </label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">PASSWORD: </label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="LOG IN">
    </form>
    <?php
    function standardize($string): string
    {
        $string = str_replace(' ', '', $string);
        $string = stripslashes($string);
        return strtolower($string);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = get_db();
        $username = standardize($_POST['username']);
        $password = $_POST['password'];
        $query = "SELECT `user_id`, `username`, `user_type`, `password` FROM `users` WHERE `username` = '$username';";
        $result = mysqli_query($conn, $query) or die("<p class='access_form'>Log in <span style='color:red;'>failed!</span> Username entered is incorrect.</p> " . $conn->error);

        $row = mysqli_fetch_array($result);
        $hashed_pass = $row['password'];
        echo $hashed_pass.'<br>';
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        echo $pass_hash.'<br>';
        if(password_verify('g19m80452022', $hashed_pass)){
            $id = $row['user_id'];
            $username_query = $row['username'];
            if($row['user_type'] == 'client'){
                $_SESSION['role'] = "CLIENT";
            }else{
                var_dump($row);

                $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = '$id';");

                if ($row = mysqli_fetch_array($result)){
                    $result = mysqli_query($conn, "SELECT `role_id` FROM `user_role` WHERE `user_id` = '$id';");
                    if ($row = mysqli_fetch_array($result)){
                        $result = mysqli_query($conn, "SELECT `role_name` FROM `roles` WHERE `role_id` = '$id';");
                        if ($row = mysqli_fetch_array($result)){
                            $role = $row['role_name'];
                            $_SESSION['role'] = $role;
                        }else{
                            $_SESSION['role'] = 'EMPLOYEE';
                        }
                    }else{
                        $_SESSION['role'] = 'EMPLOYEE';
                    }
                }else{
                    $_SESSION['role'] = 'EMPLOYEE';
                }
            }



        }else{
            echo '<p>You have entered the wrong password. Try again!</p>';
            exit;
        }
        mysqli_close($conn);
        $_SESSION['logged_in'] = $id;
        $_SESSION['username'] = $username_query;
        var_dump($_SESSION);
        //header("location: ../admin.php");


    }
    ?>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="/assets/js/logout.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>