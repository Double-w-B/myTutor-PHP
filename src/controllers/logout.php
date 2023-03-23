<?php 

session_start();
unset($_SESSION["signInSuccess"]);
header("Location: sign-in.php");

?>