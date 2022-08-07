<?php
/*
function getHeader($role){
    echo "<h1>$role header here</h1>";
}
function getAdminHeader(){
    echo '<h1>admin header here</h1>';
}

function getReceptionistHeader(){

}
 */
session_start();
function getHeader(){
    if(isset($_SESSION['logged_in'])){
        echo "<nav class=\"top-nav\">
    <ul>
        <li><a href=\"/SysDev/CoreGroup/admin.php\">Admin</a> </li>
        <li><a href=\"/SysDev/CoreGroup/test.php\">Test</a> </li>
        <li><a href=\"/SysDev/CoreGroup/scripts/logout.php\">Log Out</a> </li>
    </ul>
</nav>";
    }else{
        echo "<nav class=\"top-nav\">
    <ul>
        <li><a href=\"/SysDev/CoreGroup/admin.php\">Admin</a> </li>
        <li><a href=\"/SysDev/CoreGroup/test.php\">Test</a> </li>
        <li><a href=\"/SysDev/CoreGroup/login.php\">Log In</a> </li>
    </ul>
</nav>";
    }
}