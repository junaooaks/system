<?php
 session_start();
 if(!isset($_COOKIE["dados"]) and !isset($_SESSION["dados"])){
        header("Location: login/index.html");
        header("Content-Length: 0");
        exit();
 }
 ?>