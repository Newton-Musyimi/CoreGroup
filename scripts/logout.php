<?php
    session_start();
    $root = $_SERVER['DOCUMENT_ROOT'].'/SysDev/CoreGroup/';
    if(session_unset() && session_destroy()){
        header("location: $root/index.php");
        //header("location: /SysDev/CoreGroup/index.php");
    }else{
        header("location: $root/scripts/logout.php");
        //header("location: /SysDev/CoreGroup/scripts/logout.php");
    }
?>