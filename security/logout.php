<?php
    session_start();
    $root = "http://{$_SERVER['HTTP_HOST']}/SysDev/CoreGroup";
    if(session_unset() && session_destroy()){
        header("location: $root/");
        //header("location: /SysDev/CoreGroup/");
    }else{
        header("location: $root/scripts/logout.php");
        //header("location: /SysDev/CoreGroup/scripts/logout.php");
    }