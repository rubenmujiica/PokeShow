<?php
session_start();
session_destroy(); // Destruye todas las variables de sesión
header("Location: auth.php"); // Redirige al inicio de sesión
exit;
?>