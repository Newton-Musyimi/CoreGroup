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
    <link rel="stylesheet" href="<?php echo $host.'/SysDev/CoreGroup/assets/css/style.css';?>">
</head>

<body id="page-top">
    <header>
        <?php
        getHeader();
        ?>
        <script>
            let current = document.getElementById("inventory_button");
            current.style.backgroundColor="#048337";
            current.focus();
        </script>      
    </header>
    <div class="content-body">
        <h3 class="h3_heading">All Inventory Information</h3>
        <h1></h1>
        <div class="border">
        <div>
            <button class ="modal-button" id="add_order_button">Add Order</button>
            <button class ="modal-button" id="add_product_button">Add Product</button>
        </div>
        <table>
            <tr>
                <th>Item</th>
                <th>Category</th>
                <th>Unit Price</th>
                <th>Unit Cost</th>
                <th>In Stock</th>
            </tr>
            <?php
            $conn = get_db();
            $query = "SELECT count(`resources`.`product_id`) AS quantity, product, category, resources.price AS price, resources.cost AS cost, resources.product_id FROM products
                            INNER JOIN resources ON `resources`.`product_id` = `products`.`product_id`
                            WHERE `resources`.`wo_id` IS NULL
                            GROUP BY resources.product_id;";
            $result = mysqli_query($conn, $query) or die ("Could not get products!" . $conn->error);
            while($row = mysqli_fetch_array($result)){
                echo "<tr>
                                    <td>{$row['product']}</td>
                                    <td>{$row['category']}</td>
                                    <td>{$row['price']}</td>
                                    <td>{$row['cost']}</td>
                                    <td>{$row['quantity']}</td>
                                </tr>";
            }
            ?>

        </table>
    </div>
    <div id="add_order_modal" class="modal">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <h3 class="h3_heading">Add Order</h3>
            <span class="close" >&times;</span>
            <!-- Insert form below -->
                <label for="product_id">Item</label><br>
                <select id="product_id" name="product_id">
                    <?php
                    $query = "SELECT product_id, product, `sub-category` FROM products;";
                    $conn = get_db();
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value='".$row['product_id']."'>{$row['product']} - {$row['sub-category']}</option>";
                    }
                    ?>
                </select><br><br>
                <label for="wo_id">Workorder</label><br>
                <select id="wo_id" name="wo_id">
                    <?php
                    $query = "SELECT wo_id, title FROM workorders WHERE status != 'completed' AND status != 'cancelled';";
                    $conn = get_db();
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        if(empty($row['title'])) {
                            echo "<option value='". $row['wo_id'] ."'>Workorder - ". $row['wo_id'] ."</option>";
                        }else{
                            echo "<option value='".$row['wo_id']."'>".$row['title']."</option>";
                        }

                    }
                    ?>
                </select><br><br>

                <label for="quantity">Quantity</label><br>
                <input type="number" id="quantity" name="quantity"><br>

                <input type="submit" name="add_order" value="Add Order">
            <!-- Insert form above -->
            <?php
            if(isset($_REQUEST['add_order'])){
                $product_id = $_REQUEST['product_id'];
                $wo_id = $_REQUEST['wo_id'];
                $quantity = $_REQUEST['quantity'];
                $query = "INSERT INTO orders (product_id, wo_id, ordered_by, quantity) VALUES ('$product_id', '$wo_id', '{$_SESSION['logged_in']}', '$quantity');";
                $conn = get_db();
                $result = mysqli_query($conn, $query) or die ("Could not add order!" . $conn->error);
                mysqli_close($conn);
                echo "<script>
                           alert('Order added successfully!');
                           window.location.href = 'orders.php';
                       </script>";
            }
            ?>

        </form>
    </div>
    <div id="add_product_modal" class="modal">
        <h3 class="h3_heading">Add Product</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="modal-content">
            <span class="close">&times;</span>
            <!-- Insert form below -->
                <label for="product">Product Name</label><br>
                <input type="text" name="product_name" id="product_name" required><br>

                <label for="category">Category</label><br>
                <input type="text" name="category" id="category" required><br>

                <label for="sub-category">Sub-category</label><br>
                <input type="text" name="sub-category" id="sub-category"><br>

                <label for="vendor">Vendor</label><br>
                <input type="text" name="vendor" id="vendor"><br>

                <input type="submit" value="Add Product">
            <!-- Insert form above -->
            <?php
            if(isset($_REQUEST['product_name'])){
                $product_name = $_REQUEST['product_name'];
                $category = $_REQUEST['category'];
                $sub_category = $_REQUEST['sub-category'];
                $sub_category = $_REQUEST['sub-category'];
                $vendor = $_REQUEST['vendor'];
                $query = "INSERT INTO products (product, category, `sub-category`, vendor) VALUES ('$product_name', '$category', '$sub_category', '$vendor');";
                $conn = get_db();
                $result = mysqli_query($conn, $query) OR die ("Could not add product!" . $conn->error);
                mysqli_close($conn);
                echo "<script>
                           alert('Product added successfully!');
                           window.location.href = 'inventory.php';
                       </script>";
            }
            ?>

        </form>
    </div>
    <footer style="padding-bottom: 32px;">
        <div class="container my-auto">
            <div class="text-center my-auto copyright"><span>Copyright © Wood Street Academy; Powered by Core Group</span></div>
        </div>
    </footer>
    <script>
        // Get the modal
        var modal = document.getElementById("add_order_modal");

        // Get the button that opens the modal
        var btn = document.getElementById("add_order_button");

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

         // Get the modal
         var modal2 = document.getElementById("add_product_modal");

        // Get the button that opens the modal
        var btn2 = document.getElementById("add_product_button");

        // Get the <span> element that closes the modal
        var span2 = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }
        
        // When the user clicks anywhere outside the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }else if(event.target == modal2) {
                modal2.style.display = "none";
            }
        }
    </script>
    <script src="<?php echo $host.'/SysDev/CoreGroup/assets/js/app.js';?>"></script>
</body>



</html>