<?php

class Workorder
{
    public array $properties;

    public function __construct() {
        $this->properties = array();
    }

    function getByWorkorderId($wo_id){
        $conn = get_db();
        $query = "SELECT `workorders`.*, `devices`.`device_name` AS device_name, `clients`.`first_name` AS first_name, `clients`.`last_name` AS last_name 
                        FROM workorders 
                            LEFT JOIN clients ON clients.client_id = workorders.client_id
                            JOIN devices ON workorders.device_id = devices.device_id 
                        WHERE wo_id = $wo_id;";
        $result = mysqli_query($conn, $query) or die("Could not query for workorder with id number:$wo_id! Contact admin for assistance: " . $conn->error);
        if ($row = mysqli_fetch_array($result)) {
            if(strlen($row['date_started']) < 4){
                $date = "Not Started";
            }else{
                $date = date('D d M Y', strtotime($row['date_started']));
            }
            $dropOffDate = date('D d M Y', strtotime($row['dropoff_date']));

            $techs = $this->getAssignedTechnicians($wo_id);
            $cost = $this->getCost($wo_id);
            $client_name = "{$row['first_name']} {$row['last_name']}";
            $workOrder = array(
                'status' => $row['status'],
                'priority' => $row['priority'],
                'requested_by' => $row['requested_by'],
                'client_id' => $row['client_id'],
                'client_name' => $client_name,
                'request_type' => $row['request_type'],
                'dropoff_date' => $dropOffDate,
                'date_started' => $date,
                'date_completed' => $row['date_completed'],
                'dispatch_method' => $row['dispatch_method'],
                'dispatch_status' => $row['dispatch_status'],
                'dispatch_date' => $row['dispatch_date'],
                'device_id'=> $row['device_id'],
                'client_comments'=> $row['client_comments'],
                'techs'=> $techs,
                'cost' => $cost
            );
            return $workOrder;
        } else {
            return false;
        }

    }
    protected function getAssignedTechnicians($workorder_id){
        $conn = get_db();
        $query = "SELECT employees.username, assigned_technicians.employee_id AS id FROM employees 
    JOIN assigned_technicians ON assigned_technicians.employee_id = employees.employee_id
    WHERE assigned_technicians.wo_id = $workorder_id;";
        $result = mysqli_query($conn, $query) or die("Could not query for workorder with id number:$workorder_id! Contact admin for assistance: " . $conn->error);
        $list = "";
        while($row = mysqli_fetch_array($result)){
            $list .= "<a href=\"employee_profile.php?employee_id={$row['id']}\"><li>{$row['username']}</li></a>";
        }
        $techs = "<button class='accordion'>Assigned Technicians</button>
                    <div class='panel'>
                    <ul>$list</ul>
                    </div>";
        return $techs;
    }

    protected function getCost($wo_id){
        return "0.00";
    }

    //Trying to make invididual status cells relevant to their each own status colour
    

}