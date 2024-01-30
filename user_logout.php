<?php
session_start();
$_SESSION["user_u_id"]=array();
$_SESSION["type"]=array();
session_destroy();
header('Location:login.php');
?>