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
    'ticketing' => $ticketing
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
function getAdminHeader(): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE  THIS  HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            <hr>
            {$links['ticketing']}
            <hr>
            {$links['dashboard']}
            <hr>
            {$links['employees']}
            <hr>
            {$links['workorders']}
            <hr>
            {$links['profile']}
            <hr>
            {$links['logout']}
        </ul>
    </nav>
</div>";
}

function getReceptionistHeader(): void
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
            {$links['profile']}
            {$links['logout']}
        </ul>
    </nav>
</div>";

}

function getClientHeader(): void
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
            {$links['logout']}
        </ul>
    </nav>
</div>";
}
function getEmployeeHeader(): void
{
    global $links;
    echo "<div class=\"navbar\">
    <!-- //MOVE THIS HERE -->
    <nav class=\"top-nav\">
        <ul>
            {$links['home']}
            {$links['workorders']}
            {$links['profile']}
            {$links['logout']}
        </ul>
    </nav>
    </div>";
}
function getHeader(): void
{
    global $links;
    if(isset($_SESSION['logged_in'])){
        $role = $_SESSION['role'];
        echo "You are a(n) $role<br>";
        if($role == 'ADMINISTRATOR'){
            getAdminHeader();
        }elseif($role == 'RECEPTIONIST'){
            getReceptionistHeader();
        }elseif($role == 'CLIENT'){
            getClientHeader();
        }else{
            getEmployeeHeader();
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