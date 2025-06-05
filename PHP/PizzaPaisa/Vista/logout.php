<?php
session_start();
//session_unset();
unset($_SESSION['username']);
session_destroy();
echo "se cerro la sesion";
header("Location: inciarSesion.php");
//i
?>
