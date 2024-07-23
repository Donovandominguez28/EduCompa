<?php
session_start();
include "../php/conexion.php";

// Verificar si la sesión del profesor está activa
if (isset($_SESSION['idProfesor'])) {
    $profesor_id = $_SESSION['idProfesor'];

    // Obtener datos del profesor desde la base de datos
    $sql = "SELECT fotoPerfil, nombreCompleto, materiaInpartida, rol FROM profesor WHERE idProfesor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $profesor_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $profesor_data = $result->fetch_assoc();

    // Asignar los datos obtenidos a las variables
    if ($profesor_data) {
        $fotoPerfil = $profesor_data['fotoPerfil'];
        $nombreCompleto = htmlspecialchars($profesor_data['nombreCompleto']);
        $materiaInpartida = htmlspecialchars($profesor_data['materiaInpartida']);
        $rol = htmlspecialchars($profesor_data['rol']);
    } else {
        // Manejo de caso en que no se encuentre el profesor
        $fotoPerfil = null;
        $nombreCompleto = "Nombre no disponible";
        $materiaInpartida = "Materia no especificada";
        $rol = "Rol no especificado";
    }

} else {
    // Redirigir al inicio de sesión si no hay una sesión activa
    header("Location: ../html/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil del Profesor</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="profile">
        <?php if ($fotoPerfil): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Foto de perfil" style="width: 80px; border-radius:100%;">
        <?php else: ?>
            <p>No hay foto de perfil disponible.</p>
        <?php endif; ?>
        <h3 class="name"><?php echo $nombreCompleto; ?></h3>
        <p class="subject"><?php echo $materiaInpartida; ?></p>
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
