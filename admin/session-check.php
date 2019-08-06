<?php

    session_start();
    if(!isset($_SESSION["email"]) || empty($_SESSION["email"])){
        session_unset();
        session_destroy();
        header("Location: https://findsellfulfill.com/app/");
        die();
    }


?>