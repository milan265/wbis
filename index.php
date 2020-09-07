<?php
    define('APP_KEY', '12345678');
    if(!isset($_COOKIE['cookie'])){
        setcookie("cookie", 0, time()+86400, "/");
    }
    if(!isset($_COOKIE['prijavljen'])){
        setcookie("prijavljen", 0, time()+86400, "/");
        require_once './prijava.php';
    }else{
        if($_COOKIE['prijavljen']==0){
            require_once './prijava.php';
        }else{
            require_once './kernel.php';
        }
    }
?>
