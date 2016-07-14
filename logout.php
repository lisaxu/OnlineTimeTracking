<?php 
session_start();
session_unset();
//unset($_SESSION['username']);
//echo $_SESSION['username'];
header('Location: index.php');
?>


