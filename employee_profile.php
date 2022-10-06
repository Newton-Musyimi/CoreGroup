<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: security/login.php");
}
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Wood Street Academy</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Nunito.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php global $host; echo $host.'/SysDev/CoreGroup/assets/images/favicon16.png';?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $host.'/SysDev/CoreGroup/assets/images/favicon.png';?>">
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body id="page-top">
<header>
    <?php
    getHeader();
    ?>
    <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
            <button class="btn btn-primary py-0" type="button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <script>
        let current = document.getElementById("profile_button");
        current.style.backgroundColor="#048337";
        current.focus();
    </script>
    <?php
    $title = "";
    $username = "";
    $email = "";
    $mobile = "";
    $surname = "";
    $address = "";
    $firstname = "";
    $surname = "";
    if(isset($_REQUEST['employee_id'])){
        $employee_id = $_REQUEST['employee_id'];
        $query = "SELECT * FROM employees WHERE employee_id = $employee_id";
        $conn = get_db();
        $result = mysqli_query($conn, $query);
        $title = "";
        $username = "";
        $email = "";
        $mobile = "";
        $surname = "";
        $address = "";
        $firstname = "";
        $surname = "";
        if($row = mysqli_fetch_array($result)){
            $title = $row['title'];
            $firstname = $row['first_name'];
            $username = $row['username'];
            $email = $row['email'];
            $mobile = $row['mobile'];
            $surname = $row['last_name'];
            $address = $row['address'];
            $profile_picture = $row['profile_picture'];
        }
    }

    ?>


</header>
<div class="container-fluid">
    <h3 class="text-dark mb-4"><?php echo "$firstname $surname - $title";  ?></h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow">
                    <img class="rounded-circle mb-3 mt-4 site_images" src="<?php echo $profile_picture; ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Employee Information</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <strong>Email Address: </strong><?php echo $email;  ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <strong>Mobile: </strong><?php echo $mobile;  ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="address">
                                    <strong>Address: </strong><?php echo $address;  ?>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card shadow mb-3" <?php if($_SESSION['role'] !== 'ADMINISTRATOR'){
                        echo "style='display: none;'";
                    } ?>>
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Fire Employee</p>
                        </div>
                        <div class="card-body">
                                <div class="mb-3">
                                    <button onclick="fireEmployee(<?php echo $_REQUEST['employee_id'];?>)" type="submit" class="tab_button" name="fire_employee"style="float: right; color: black; background-color: red;">Fire Employee</button>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy 2022</span></div>
    </div>
</footer>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<script>
    function fireEmployee(employeeId){
        let r = confirm("Are you sure you want to fire this employee?");
        if (r == true) {
            window.location.href = 'security/delete.php?fire_employee='+employeeId;
        } else {
            window.location.href = 'profile.php';
        }
    }
</script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
<script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>