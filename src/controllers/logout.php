<?php 

session_start();
unset($_SESSION["signInSuccess"]);
header("location: /");

?>