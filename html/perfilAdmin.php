<?php
session_start();
include "../php/conexion.php";

// Verificar si la sesión del administrador está activa
if (isset($_SESSION['idAdmin'])) {
    $admin_id = $_SESSION['idAdmin'];

    // Obtener datos del administrador desde la base de datos
    $sql = "SELECT nombre, rol FROM administrador WHERE idAdmin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin_data = $result->fetch_assoc();

    // Asignar los datos obtenidos a las variables
    if ($admin_data) {
        $nombre = htmlspecialchars($admin_data['nombre']);
        $rol = htmlspecialchars($admin_data['rol']);
    } else {
        // Manejo de caso en que no se encuentre el administrador   
        header("Location: ../html/login.html");
        exit();
    }

} else {
    // Redirigir al inicio de sesión si no hay una sesión activa
    header("Location: ../html/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Administrador</title>
</head>
<body>
    <div class="profile">
        <h3 class="name"><?php echo $nombre; ?></h3>
        <p class="role"><?php echo $rol; ?></p>
        <br>
        <div class="btncenter">
            <button class="btncerrarsesion" onclick="window.location.href='../php/cerrar_sesion.php';">
                <div class="sign">
                    <svg viewBox="0 0 512 512">
                        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                    </svg>
                </div>
                <div class="text">Cerrar sesión</div>
            </button>
        </div>
    </div>
</body>
</html>
