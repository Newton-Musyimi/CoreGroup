<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/header.php');

//require_once('/SysDev/CoreGroup/security/admin/config.php');
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
    <header>
        <?php
        getHeader();
        ?>
    </header>
    <div class='tab'>
        <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'Employees')">Employees</button>
        <button class="tablinks" onclick="openTab(event, 'AddEmployee')">Add Employee</button>
    </div>
    <div id='Employees' class='tabcontent'>
        <h3>Employees</h3>
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $conn = get_db();
                $sql = "SELECT * FROM employees";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "</tr>";

                    }
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div id="AddEmployee" class="tabcontent">
        <h3>Add Employee</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="title" value="TECHNICIAN">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php
            if(isset($_REQUEST['title'])){
                $title = $_REQUEST['title'];
                $first_name = $_REQUEST['first_name'];
                $last_name = $_REQUEST['last_name'];
                $email = $_REQUEST['email'];
                $mobile = $_REQUEST['mobile'];
                $address = $_REQUEST['address'];
                $sql = "INSERT INTO employees (title, first_name, last_name, email, mobile, address) VALUES ('$title', '$first_name', '$last_name', '$email', '$mobile', '$address');";
                if ($conn->query($sql) === TRUE) {
                    echo "<p style='color: green'>$first_name $last_name has been added to the database</p>";
                } else {
                    echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not add $first_name $last_name into the databse</p> <br><p style='color: red'><strong>Message: </strong>" .$conn->error."";
                }
                $conn ->close();
            }
            ?>
        </form>
    </div>
    <footer class="bg-white sticky-footer" style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Newton Musyimi 2022</span></div>
        </div>
    </footer>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/theme.js';?>"></script>
</body>

</html>