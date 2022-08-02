<?php
    session_start();
    if(session_unset() && session_destroy()){
        header("location: /SysDev/CoreGroup/index.php");
    }else{
        header("location: /SysDev/CoreGroup/scripts/logout.php");
    }
?>