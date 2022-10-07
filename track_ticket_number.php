<?php
require_once('security/admin/config.php');

if(isset($_REQUEST["ticket_number"]) && (!empty($_REQUEST["ticket_number"]))) {
    $conn=get_db();
    $wo_id = $_REQUEST["ticket_number"];
    $error = "";
    if (!$wo_id) {
        $error .= "<p>The work order could not be retrieved !</p>";
    } else {
        $sel_query = "SELECT status FROM coregroup.workorders WHERE wo_id=$wo_id;";
        $result = mysqli_query($conn, $sel_query) or die(false);
        $row = mysqli_fetch_array($result);
        echo $row['status'];
        mysqli_close($conn);
    }

}
