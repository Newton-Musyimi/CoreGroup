<?php
require_once ("Role.php");
require_once ("PrivilegedUser.php");

// connect to database...
// ..."g19m80452022"
require_once('/SysDev/CoreGroup/security/admin/config.php');
$conn = get_db();
$GLOBALS["DB"] = $conn;
session_start();

if (isset($_SESSION["logged_in"])) {
    $user_id = PrivilegedUser::getByUsername($_SESSION["loggedin"]);
}

if ($user_id->hasPrivilege("thisPermission")) {
    // do something
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
    </header>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Core Group 2022</span></div>
        </div>
    </footer>
</body>

</html>