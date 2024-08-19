<?php
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carnet = $_POST['carnet'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $email = $_POST['email'];
    $añoBachi = $_POST['añoBachi'];
    $seccion = $_POST['seccion'];
    $especialidad = $_POST['especialidad'];
    $contrasena = $_POST['contrasena'];
    
    // Manejo de la foto de perfil
    $fotoPerfilTmpName = $_FILES['fotoPerfil']['tmp_name'];
    $fotoPerfilType = $_FILES['fotoPerfil']['type'];
    $fotoPerfilSize = $_FILES['fotoPerfil']['size'];

    // Validaciones
    if (empty($carnet) || empty($nombreCompleto) || empty($email) || empty($añoBachi) || empty($seccion) || empty($especialidad)) {
        echo "<script>alert('Por favor, complete todos los campos obligatorios.'); window.history.back();</script>";
        exit();
    }

    if (!is_numeric($carnet) || $carnet < 1) {
        echo "<script>alert('Carnet inválido.'); window.history.back();</script>";
        exit();
    }

    if (!is_numeric($añoBachi) || $añoBachi < 1 || $añoBachi > 3) {
        echo "<script>alert('El año de bachillerato debe ser un número entre 1 y 3.'); window.history.back();</script>";
        exit();
    }

    if (!preg_match("/^[A-Z]$/", $seccion)) {
        echo "<script>alert('La sección debe ser una sola letra mayúscula.'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El email proporcionado no es válido.'); window.history.back();</script>";
        exit();
    }

    if ($fotoPerfilTmpName) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fotoPerfilType, $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($fotoPerfilSize > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $fotoPerfilContent = file_get_contents($fotoPerfilTmpName);
        if ($fotoPerfilContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    } else {
        $fotoPerfilContent = null; // No se proporciona una foto de perfil
    }

    $sql = "INSERT INTO estudiantes (carnet, nombreCompleto, fotoPerfil, email, añoBachi, seccion, especialidad, contrasena)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters. Use 'b' for binary data (fotoPerfilContent)
        $stmt->bind_param("isssssss", $carnet, $nombreCompleto, $fotoPerfilContent, $email, $añoBachi, $seccion, $especialidad, $contrasena);
        if ($stmt->execute()) {
            echo "<script>alert('Estudiante agregado correctamente'); window.location.href='../html/estudiantesAdmin.php';</script>";
        } else {
            echo "<script>alert('Error al agregar estudiante');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error al preparar la consulta: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>
