<?php
session_start(); // Iniciar la sesión si aún no se ha iniciado

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión
header("Location: ../html/login.html");
exit();
?>
