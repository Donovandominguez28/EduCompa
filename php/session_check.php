<?php
// Iniciar la sesión (si no está iniciada)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar si el usuario está autenticado
function isLoggedIn() {
    return isset($_SESSION['carnet']); // Cambia 'usuario_id' al nombre de tu clave de sesión    
}

// Verificar si el usuario no está autenticado y redirigir a la página de inicio de sesión


?>
