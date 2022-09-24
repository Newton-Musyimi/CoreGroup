<?php
require_once ('config.php');
$conn = get_db();


    if(isset($_REQUEST['ticket_by_type'])){
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
    }elseif (isset($_REQUEST['ticket_by_status'])) {
        $query = "SELECT status, COUNT(*) AS number FROM workorders GROUP BY status;";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        //$data = array();
        $string = "[[\"Status\" ,\"Number\"],";
        while ($row = mysqli_fetch_array($result)) {
            $string .= "[\"{$row['status']}\" , {$row['number']}],";
        }
        $string = rtrim($string, ",");
        $string .= "]";
        mysqli_close($conn);
        echo $string;
    }else{
        mysqli_close($conn);
    }