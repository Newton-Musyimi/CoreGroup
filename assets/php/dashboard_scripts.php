<?php
require_once ('config.php');
$conn = get_db();
    $query = "SELECT request_type, COUNT(*) AS number FROM workorders GROUP BY request_type;";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    //$data = array();
    $string = "[[\"Request Type\" ,\"Number\"],";
    while($row = mysqli_fetch_array($result)){
        $string .= "[\"{$row['request_type']}\" , {$row['number']}],";
    }
    $string = rtrim($string, ",");
    $string .= "]";
    mysqli_close($conn);
    echo $string;