<?php
function getOrders(){
    $conn = get_db();
    $role = $_SESSION['role'];
    $username = $_SESSION['username'];
    if($role == 'ADMINISTRATOR' || $role == 'RECEPTIONIST'){
        $query = "SELECT orders.*, products.product AS product, employees.username AS username FROM `orders` as orders
                LEFT JOIN employees ON orders.ordered_by = employees.employee_id
                JOIN products ON orders.product_id = products.product_id;";
    }elseif($role == 'TECHNICIAN') {
        $query = "SELECT orders.*, products.product AS product, employees.username AS username FROM `orders` as orders
                LEFT JOIN employees ON orders.ordered_by = employees.employee_id
                JOIN products ON orders.product_id = products.product_id
                WHERE username = '$username' ;";
    }

    $result = mysqli_query($conn, $query) or die("Could not get orders! Contact admin for assistance: " . $conn->error);
    $list = "<tr>
            <th>Item:</th>
            <th>Ordered by:</th>
            <th>Date Ordered:</th>
            <th>WorkOrder Id:</th>
            <th>Quantity:</th>
            <th>Cost:</th>
            <th>Order Status:</th>
            <th>Date Collected:</th>
            <th>Collected/Not Collected:</th>
            <th>Delete</th>
            </tr>
            <tr>";
    while($row = mysqli_fetch_array($result)){
        if(strlen($row['date_collected']) < 4){
            $date_collected = "Not Collected";
        }else{
            $date_collected = date('D d M Y', strtotime($row['date_collected']));
        }
        if($row['order_status'] == 0){
            $order_status = 'Unfullfilled';
        }else{
            $order_status = 'Fullfilled';
        }
        $date_ordered = date('D d M Y', strtotime($row['date_ordered']));
        $list .= "
                <td>{$row['product']}</td>
                <td>{$row['username']}</td>
                <td>$date_ordered</td>
                <td>{$row['wo_id']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['cost']}</td>
                <td>$order_status</td>
                <td>$date_collected</td>
                <td>
                <form method=\"POST\" class=\"update_collection\">
                        <input type=\"hidden\" name=\"order_id\" value=\"{$row['order_id']}\">
                        <input type=\"submit\" name=\"update_collection_status\" value=\"Not Collected\">
                    </form>
                </td>
                <td>";
        $list .=  "<form method=\"POST\" class=\"update_collection\">
                        <input type=\"hidden\" name=\"order_id\" value=\"{$row['order_id']}\">
                        <input type=\"submit\" name=\"delete_order\" value=\"Delete Order\" id=\"delete_order\" style= 'background-color: red'>
                    </form>
                </td>
            </tr>";
    }
    mysqli_close($conn);
    return $list;
}
