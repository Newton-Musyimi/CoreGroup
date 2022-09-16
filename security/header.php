<?php
$host = "http://".$_SERVER['HTTP_HOST'];
$dashboard = "<li><a href=\"$host/SysDev/CoreGroup/dashboard.php\" class=\"nav-item\"><button>Admin</button></a> </li>";
$test = "<li><a href=\"$host/SysDev/CoreGroup/test.php\" class=\"nav-item\"><button>Test</button></a> </li>";
$workorders = "<li><a href=\"$host/SysDev/CoreGroup/workorders.php\" class=\"nav-item\"><button>Workorders</button></a> </li>";
$login = "<li><a href=\"$host/SysDev/CoreGroup/security/login.php\" class=\"nav-item\"><button>Login</button></a> </li>";
$logout = "<li><a href=\"$host/SysDev/CoreGroup/security/logout.php\" class=\"nav-item\"><button>Logout</button></a> </li>";
$signup = "<li><a href=\"$host/SysDev/CoreGroup/security/signup.php\" class=\"nav-item\"><button>Signup</button></a> </li>";
$helpdesk = "<li><a href=\"$host/SysDev/CoreGroup/helpdesk.php\" class=\"nav-item\"><button>Helpdesk</button></a> </li>";
$home = "<li><a href=\"$host/SysDev/CoreGroup/\" class=\"nav-item\"><button>Home</button></a> </li>";
$profile = "<li><a href=\"$host/SysDev/CoreGroup/profile.php\" class=\"nav-item\"><button>Profile</button></a> </li>";
$employees = "<li><a href=\"$host/SysDev/CoreGroup/employees.php\" class=\"nav-item\"><button>Employees</button></a> </li>";

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
    'employees' => $employees
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
            {$links['dashboard']}
            {$links['employees']}
            {$links['workorders']}
            {$links['profile']}
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
            {$links['helpdesk']}
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