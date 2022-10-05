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
    $table = $_SESSION['user_table'];
    $query = "SELECT * FROM $table WHERE username = '".$_SESSION['username']."'";
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
        if($table === 'employees'){
            $title = $row['title'];
        }else{
            $title = "Client";
        }
        $firstname = $row['first_name'];
        $username = $row['username'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $surname = $row['last_name'];
        $address = $row['address'];
        $profile_picture = $row['profile_picture'];
    }
    mysqli_close($conn);
    ?>


</header>
    <div class="container-fluid">
                    <h3 class="text-dark mb-4"><?php echo "$firstname $surname - $title";  ?></h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4 site_images" src="<?php echo $profile_picture; ?>">
                                    <div class="mb-3">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" >
                                            <input type="file" name="profile_picture">
                                            <input type="submit" name="update_profile_picture" value="Update profile picture">
                                            <input type = "submit" name="delete_account"  value = "Delete Account">
                                            <?php
                                            if(isset($_REQUEST['update_profile_picture'])){
                                                $conn = get_db();
                                                $check_image = getimagesize($_FILES["profile_picture"]["tmp_name"]);

                                                if($check_image !== false){
                                                    $id = intval($_SESSION['logged_in']);
                                                    $file_name = basename($_FILES["profile_picture"]["name"]);
                                                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
                                                    $target = "assets/images/avatars/$username.$extension";
                                                    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target);
                                                    if($table == 'clients'){
                                                        $user = 'client_id';
                                                        $query = "UPDATE clients
                                                                SET
                                                                `profile_picture` = '$target'
                                                                WHERE `client_id` = $id;
                                                                ";
                                                    }else{
                                                        $user = 'employee_id';
                                                        $query = "UPDATE employees
                                                                SET
                                                                `profile_picture` = '$target'
                                                                WHERE `employee_id` = $id;
                                                                ";
                                                    }
                                                    mysqli_query($conn, $query) or die($conn->error);
                                                    mysqli_close($conn);
                                                    echo "
                                                    <script>
                                                    window.location.href = 'profile.php';
                                                    </script>";
                                                }else{
                                                    echo "File is not an image!";
                                                }
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 fw-bold">User Infomation</p>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="email">
                                                                <strong>Email Address</strong>
                                                            </label><br>
                                                            <input  type="email" name="email" id="email"value="<?php echo $email;  ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="mobile">
                                                                <strong>Mobile</strong>
                                                            </label><br>
                                                            <input  type="text" name="mobile" id="mobile"value="<?php echo $mobile;  ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="address">
                                                        <strong>Address</strong>
                                                    </label>
                                                    <br>
                                                    <input  type="text" name="address" id="address" value="<?php echo $address;  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="submit" name="update_profile_details" value="Update Profile Details">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <footer class="bg-white sticky-footer">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>