<?php
if (isset($_SESSION['carnet'])) {
    include_once "../php/conexion.php";
    
    $outgoing_id = $_SESSION['carnet'];

    // Consulta para obtener los datos del usuario
    $sql = "SELECT * FROM estudiantes WHERE carnet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $outgoing_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fotoPerfil = $row['fotoPerfil'];
        $nombreCompleto = $row['nombreCompleto'];
        $usuario = $row['usuario'];
        $añoBachi = $row['añoBachi'];
        $seccion = $row['seccion'];
        $especialidad = $row['especialidad'];
        $banner = $row['banner'];


    } else {
        // Manejo de error si el usuario no se encuentra
        $fotoPerfil = '../images/userrr.png'; // Puedes asignar una imagen predeterminada aquí si lo deseas
        $nombreCompleto = 'Usuario no encontrado';
        $usuario = '';
        $banner ='../images/defaultBanner.jpg';
    }
    $stmt->close();
} else {
    // Manejo de error si no hay sesión iniciada
    $fotoPerfil = '../images/userrr.png'; // Puedes asignar una imagen predeterminada aquí si lo deseas
    $nombreCompleto = 'Usuario no encontrado';
    $usuario = '';
}


?>