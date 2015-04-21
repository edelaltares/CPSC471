<?php
session_start();
unset($_SESSION['patron']);  
header("Location: patron-login.php");
?>