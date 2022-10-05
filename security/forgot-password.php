<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/

require_once('admin/config.php');
require_once('header.php');
global $host;
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Wood Street Academy</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/forgot_password.css';?>">/
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>
<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("template_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <div class="content-body">
<?php
$conn=get_db();
if(isset($_POST["email"]) && (!empty($_POST["email"]))) {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $error = "";
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error .= "<p>Invalid email address please type a valid email address!</p>";
    } else {
        $sel_query = "SELECT `users`.`table` FROM `coregroup`.`users` where `users`.`username`='$username';";
        $results = mysqli_query($conn, $sel_query) or die($conn->error);
        if ($row = mysqli_fetch_array($results)) {
            $table = $row['table'];
            $sel_query = "SELECT email FROM $table WHERE username='$username'";
            if ($row = mysqli_num_rows($results)) {
                echo "<form method=\"post\" action=\" \"name=\"reset\"><br><br>
                <label for=\"password\"><strong>Enter Your New Password:</strong></label><br /><br />
                <input type=\"password\" name=\"password\" id=\"password\"><br /><br />
                <label for=\"confirm\"><strong>reEnter Your new Password:</strong></label><br /><br />
                <input type=\"password\" name=\"confirm\" id=\"confirm\" />
            <br /><br />
            <input type=\"submit\" value=\"Reset Password\"/>
            </form>";
            }
        } else {
            $error .= "<p>No user is registered with this username!</p>";
        }
    }
}else{
    echo "<form method=\"post\" action=\" \"name=\"reset\"><br><br>
    <label for=\"username\"><strong>Username:</strong></label><br /><br />
    <input type=\"text\" name=\"username\" id=\"username\"> <br /><br />
    <label for=\"email\"><strong>Enter Your Email Address:</strong></label><br /><br />
    <input type=\"email\" name=\"email\" id=\"email\" />
<br /><br />
<input type=\"submit\" value=\"Confirm User\"/>
</form>";
}
if(isset($_REQUEST['confirm'])){
    $user = 'username';
    $query = "UPDATE `coregroup`.`plain_text_pass`
                SET
                `password` = {password: }
                  WHERE `username` = {expr};
                 SELECT * FROM coregroup.plain_text_pass";
}else{
    $user = 'employee_id';
    $query = "UPDATE `coregroup`.`plain_text_pass`
    SET
    `password` = {password: }
      WHERE `username` = {expr};
     SELECT * FROM coregroup.plain_text_pass";

}

       
?>

    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>