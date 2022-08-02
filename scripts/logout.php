<?php
    session_start();
    if(session_unset() && session_destroy()){
        header("location: ../index.php");
        //header("location: /SysDev/CoreGroup/index.php");
    }else{
        header("location: logout.php");
        //header("location: /SysDev/CoreGroup/scripts/logout.php");
    }
?>