<?php
function getTicketByType(): bool|string
{
    $query = "SELECT request_type, COUNT(*) AS number FROM workorders GROUP BY request_type";
    $result = mysqli_query($GLOBALS['conn'], $query);
    $data = array();
    $string = "";
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
        $string .= "['{$row['request_type']}' , {$row['number']}],";
    }
    return json_encode($string);
}