<?php
session_start();
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/security/admin/config.php');
*/
require_once('security/admin/config.php');
require_once('security/header.php');
//require_once('/SysDev/CoreGroup/security/admin/config.php');
?>
<!DOCTYPE html>
<html lang="en-gb">
<style>
table, th, td {
  border-bottom: 1px solid;
}
tr:hover {background-color: #048337;}
</style>

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
        <script>
            let current = document.getElementById("employees_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>
    </header>
    <button id="add_employee_button">Add Employee</button>
    <div id='Employees'>
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
    <div id="add_employee_modal" class="modal">
        <h3>Add Employee</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <div class="form-group">
                <label for="title">Employee Title/Position</label><br>
                <select class="form-control" id="title" name="title">
                    <option value="TECHNICIAN">Technician</option>
                    <option value="MANAGER">Manager</option>
                    <option value="SECRETARY">Secretary</option>
                </select><br>
            </div>

            <div class="form-group">
                <label for="username">Username</label><br>
                <input type="text" class="form-control" id="username" name="username" placeholder="username" required><br>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label><br>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required><br>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label><br>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required><br>
            </div>
            <div class="form-group">
                <label for="email">Email</label><br>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required><br>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label><br>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile" required><br>
            </div>
            <div class="form-group">
                <label for="address">Address</label><br>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required><br>
            </div><br>
            <button type="submit" class="btn btn-primary">Submit</button><br>

        </form>
    </div>
    <?php
    function valid(): bool{
        return true;
    }
    function current_employee($conn, $email, $phone_number){
        $user_search = "SELECT `email`, `mobile` FROM `employees` WHERE `email` = '$email'";
        $result = mysqli_query($conn, $user_search) or die ("client SELECT error!" . $conn->error);
        $error = "";
        while($row = mysqli_fetch_array($result)){
            if($row['email'] === $email){
                $error .= '<p class="access_form">Email <span style="color:red;">exists</span> enter a different email!</p>';
            }
            if($row['mobile'] === $phone_number){
                $error .= '<p class="access_form">Phone Number <span style="color:red;">exists</span> enter a different phone number!</p>';
            }
        }
        return $error;
    }
    function standardize($column_name): string
    {
        $string = str_replace(' ','',$column_name);
        $string = stripslashes($string);
        return strtolower($string);
    }
    if(isset($_REQUEST['title'])){
        $title = $_REQUEST['title'];
        $first_name = $_REQUEST['first_name'];
        $last_name = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        $mobile = $_REQUEST['mobile'];
        $address = $_REQUEST['address'];
        $username = standardize($_REQUEST['username']);
        if(valid()){
            
            $sql = "INSERT INTO employees (title, first_name, last_name, email, mobile, address, username) VALUES ('$title', '$first_name', '$last_name', '$email', '$mobile', '$address', '$username');";
            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: green'>$first_name $last_name has been added to the database</p>";
            } else {
                echo "<p style='color: darkred'><strong style='color: red'>Error:</strong> Could not add $first_name $last_name into the databse because:".current_employee($conn, $email, $mobile)."</p><p style='color: red'><strong>Message: </strong>" .$conn->error."</p>";
            }
            $conn ->close();
        }
        
    }
    ?>
    <footer class="bg-white sticky-footer" style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Newton Musyimi 2022</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("add_employee_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("add_employee_button");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>

</html>