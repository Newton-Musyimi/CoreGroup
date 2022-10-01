<?php
$host = "http://".$_SERVER['HTTP_HOST'];
$dashboard = "<li><a href=\"$host/SysDev/CoreGroup/dashboard.php\" class=\"nav-item\"><button id=\"dashboard_button\">Admin</button></a> </li>";
$test = "<li><a href=\"$host/SysDev/CoreGroup/test.php\" class=\"nav-item\"><button id=\"test_button\">Test</button></a> </li>";
$workorders = "<li><a href=\"$host/SysDev/CoreGroup/workorders.php\" class=\"nav-item\"><button id=\"workorders_button\">Workorders</button></a> </li>";
$login = "<li><a href=\"$host/SysDev/CoreGroup/security/login.php\" class=\"nav-item\"><button id=\"login_button\">Login</button></a> </li>";
$logout = "<li><a href=\"$host/SysDev/CoreGroup/security/logout.php\" class=\"nav-item\"><button id=\"logout_button\">Logout</button></a> </li>";
$signup = "<li><a href=\"$host/SysDev/CoreGroup/security/signup.php\" class=\"nav-item\"><button id=\"signup_button\">Signup</button></a> </li>";
$ticketing = "<li><a href=\"$host/SysDev/CoreGroup/ticketing.php\" class=\"nav-item\"><button id=\"ticketing_button\">Create Ticket</button></a> </li>";
$helpdesk = "<li><a href=\"$host/SysDev/CoreGroup/helpdesk.php\" class=\"nav-item\"><button id=\"helpdesk_button\">Helpdesk</button></a> </li>";
$home = "<li id=\"home_button\"><a href=\"$host/SysDev/CoreGroup/\" class=\"nav-item\"><button id=\"home_button\">Home</button></a> </li>";
$profile = "<li><a href=\"$host/SysDev/CoreGroup/profile.php\" class=\"nav-item\"><button id=\"profile_button\">Profile</button></a> </li>";
$employees = "<li><a href=\"$host/SysDev/CoreGroup/employees.php\" class=\"nav-item\"><button id=\"employees_button\">Employees</button></a> </li>";
$inventory = "<li><a href=\"$host/SysDev/CoreGroup/inventory.php\" class=\"nav-item\"><button id=\"inventory_button\">Inventory</button></a> </li>";
$devices = "<li><a href=\"$host/SysDev/CoreGroup/devices.php\" class=\"nav-item\"><button id=\"devices_button\">Devices</button></a> </li>";
$orders = "<li><a href=\"$host/SysDev/CoreGroup/orders.php\" class=\"nav-item\"><button id=\"orders_button\">Orders</button></a> </li>";
$chatroom= "<li><a href=\"$host/SysDev/CoreGroup/messaging2.php\" class=\"nav-item\"><button id=\"chatroom_button\">Chat to a technician</button></a> </li>";

$links = array(
    'dashboard' => $dashboard,
    'test' => $test,
    'workorders' => $workorders,
    'login' => $login,
    'logout' => $logout,
    'signup' => $signup,
    'helpdesk' => $helpdesk,
    'home' => $home,
    'profile' => $profile,
    'employees' => $employees,
    'ticketing' => $ticketing,
    'inventory'=> $inventory,
    'devices'=> $devices,
    'orders'=> $orders,
    'chatroom'=> $chatroom
);
/*
function getCommon(): string
{
    global $links;
    return "<div class=\"navbar\">
<nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['dashboard']}
            {$links['test']}
            {$links['helpdesk']}
            {$links['profile']}
            {$links['employees']}
            {$links['workorders']}
            {$links['login']}
            {$links['signup']}
            {$links['logout']}
            
        </ul>
    </nav>
    </div>";
}
*/
function getAdminHeader($role): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE  THIS  HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}           
            {$links['ticketing']}            
            {$links['dashboard']}            
            {$links['employees']}            
            {$links['workorders']}           
            {$links['profile']}
            {$links['devices']}
            {$links['orders']}
            {$links['inventory']}            
            {$links['logout']}
            <li class='nav-title nav-item'><p>Welcome, {$_SESSION['username']}<br>You are an $role</p></li>
            
        </ul>
        
    </nav>
    
    
</div>";
}

function getReceptionistHeader($role): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE  THIS  HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['helpdesk']}
            {$links['ticketing']}
            {$links['employees']}
            {$links['workorders']}
            {$links['devices']}
            {$links['orders']}
            {$links['profile']}
            {$links['inventory']}
            {$links['logout']}
            <li class='nav-title nav-item'><p>Welcome, {$_SESSION['username']}<br>You are a $role</p></li>
        </ul>
    </nav>
</div>";

}

function getClientHeader($role): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE THIS HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['ticketing']}
            {$links['workorders']}
            {$links['devices']}
            {$links['profile']}
            {$links['chatroom']}
            {$links['logout']}
            <li class='nav-title nav-item'><p>Welcome, {$_SESSION['username']}<br>You are a $role</p></li>
        </ul>
    </nav>
    
</div>";
}
function getEmployeeHeader($role): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE THIS HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['ticketing']}
            {$links['workorders']}
            {$links['profile']}
            {$links['devices']}
            {$links['orders']}
            {$links['inventory']}
            {$links['logout']}
            <li class='nav-title nav-item'><p>Welcome, {$_SESSION['username']}<br>You are an $role</p></li>
        </ul>
    </nav>

    </div>";
}
function getHeader(): void
{
    global $links;
    if(isset($_SESSION['logged_in'])){
        $role = $_SESSION['role'];

        if($role == 'ADMINISTRATOR'){
            $role = strtolower($role);
            getAdminHeader($role);
        }elseif($role == 'RECEPTIONIST'){
            $role = strtolower($role);
            getReceptionistHeader($role);
        }elseif($role == 'CLIENT'){
            $role = strtolower($role);
            getClientHeader($role);
        }else{
            $role = strtolower($role);
            getEmployeeHeader($role);
        }
        //echo getCommon();
    }else{
        echo "<div class=\"navbar\">
        <!-- //MOVE  THIS HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['login']}
            {$links['signup']}
        </ul>
    </nav>
</div>";
        //echo getCommon();
    }
}