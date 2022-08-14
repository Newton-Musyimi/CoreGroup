<?php
$host = "http://".$_SERVER['HTTP_HOST'];
function getAdminHeader(){
    global $host;
    echo "<div class=\"navbar\">
    <nav class=\"top-nav\">
        <ul>
            <li><a href=\"$host/SysDev/CoreGroup/admin.php\"  class=\"nav-item\">Admin</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/test.php\"  class=\"nav-item\">Test</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/employees.php\"  class=\"nav-item\">Employees</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/workorders.php\"  class=\"nav-item\">Workorders</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/scripts/logout.php\"  class=\"nav-item\">Log Out</a> </li>
        </ul>
    </nav>
</div>";
}

function getReceptionistHeader(){
    global $host;
    echo "<div class=\"navbar\"
<nav class=\"top-nav\">
    <ul>
        <li><a href=\"$host/SysDev/CoreGroup/workorders.php\"  class=\"nav-item\">Admin</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/helpdesk.php\"  class=\"nav-item\">Test</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/employees.php\"  class=\"nav-item\">Employees</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/workorders.php\"  class=\"nav-item\">Workorders</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/scripts/logout.php\"  class=\"nav-item\">Log Out</a> </li>
    </ul>
</nav>
</div>";

}

function getClientHeader(){
    global $host;
    echo "<div class=\"navbar\"
<nav class=\"top-nav\">
    <ul>
        <li><a href=\"$host/SysDev/CoreGroup/workorders.php\"  class=\"nav-item\">Workorders</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/devices.php\"  class=\"nav-item\">Devices</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/scripts/logout.php\"  class=\"nav-item\">Log Out</a> </li>
    </ul>
</nav>
</div>";
}
function getEmployeeHeader(){
    global $host;
    echo "<div class=\"navbar\"
    <nav class=\"top-nav\">
        <ul>
            <li><a href=\"$host/SysDev/CoreGroup/workorders.php\"  class=\"nav-item\">Workorders</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/devices.php\"  class=\"nav-item\">Devices</a> </li>
            <li><a href=\"$host/SysDev/CoreGroup/scripts/logout.php\"  class=\"nav-item\">Log Out</a> </li>
        </ul>
    </nav>
    </div>";
}
function getHeader(){
    global $host;
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
            echo '<h1>employee header here</h1>';
        }
    }else{
        echo "<div class=\"navbar\"
<nav class=\"top-nav\">
    <ul>
        <li><a href=\"$host/SysDev/CoreGroup/admin.php\">Admin</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/test.php\">Test</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/login.php\">Log In</a> </li>
        <li><a href=\"$host/SysDev/CoreGroup/signup.php\">Sign Up</a> </li>
    </ul>
</nav>
</div>";
    }
}