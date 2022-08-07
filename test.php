<?php
// connect to database...
// ..."g19m80452022"

session_start();
require_once ($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');
?>
<!DOCTYPE html>
<html lang="en-gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Core Group</title>
    <meta http-equiv="Cache-control" content="no-store">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
    </header>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="permission"> PERMISSION: <br>
            <input type="text" name="permission" id="permission" placeholder="permission">
        </label>
            <input type="text" name="with" id="with" hidden="true" value="ADD PERMISSION">
        <input type="submit" value="ADD PERMISSION">
    </form>
    <?php
    function standardize($string): string
    {
        $string = str_replace(' ', '', $string);
        $string = stripslashes($string);
        return strtolower($string);
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
    if (isset($_SESSION["logged_in"])) {
        require_once("security/Role.php");
        require_once("security/PrivilegedUser.php");
        $conn = get_db();
        $GLOBALS["DB"] = $conn;
        $user = PrivilegedUser::getByUsername($_SESSION["username"]);
        $role_id = $user->getRoleId();
        echo $role_id.'<br>';
        $permissions_query = "SELECT * FROM coregroup.permissions;";
        $result = mysqli_query($conn, $permissions_query);
        while($row = mysqli_fetch_array($result)){
            $perm = $row['perm_desc'];
            echo $perm.'<br>';
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            echo 'In request<br>';
            $permission = strtoupper($_POST['permission']);
            $with = strtoupper($_POST['with']);
            if($user->hasPerm($with)){
                $add_permissions_query = "INSERT INTO `coregroup`.`permissions` (`perm_desc`) VALUES ('$permission');
";
                $result = mysqli_query($conn, $add_permissions_query) or die("Could not add permission!: ".$conn->error);
                echo "Permission added!";
            }
        }
    }
    ?>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
</body>

</html>