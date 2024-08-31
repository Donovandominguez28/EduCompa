<?php
// Iniciar la sesión (si no está iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario está autenticado
function isLoggedIn() {
    return isset($_SESSION['carnet']); 
}


?>
