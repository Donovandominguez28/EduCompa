<?php
include '../php/session_check2.php';
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carnet = $_POST['carnet'];
    $nombre = $_POST['nombreCompleto'];
    $usuario = $_POST['usuario'];
    $añoBachi = $_POST['añoBachi'];
    $seccion = $_POST['seccion'];
    $especialidad = $_POST['especialidad'];
    $fotoPerfil = $_FILES['fotoPerfil'];
    $banner = $_FILES['banner'];

    // Validaciones
    if (empty($carnet) || empty($nombre) || empty($añoBachi) || empty($seccion) || empty($especialidad) || empty($usuario)) {
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

    if (strlen($usuario) > 8 || strlen($usuario) < 4) {
        echo "<script>alert('El nombre de usuario debe tener entre 4 y 8 caracteres.'); window.history.back();</script>";
        exit();
    }

    if ($fotoPerfil['tmp_name']) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($fotoPerfil['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF, etc.).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($fotoPerfil['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $fotoPerfilContent = file_get_contents($fotoPerfil['tmp_name']);
        if ($fotoPerfilContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    } else {
        $fotoPerfilContent = null; // No change
    }

    if ($banner['tmp_name']) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($banner['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF, etc.).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($banner['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $bannerContent = file_get_contents($banner['tmp_name']);
        if ($bannerContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    } else {
        $bannerContent = null; // No change
    }

    // Prepare SQL query
    $sql = "UPDATE estudiantes SET nombreCompleto = ?, usuario = ?, añoBachi = ?, seccion = ?, especialidad = ?";

    if ($fotoPerfilContent !== null) {
        $sql .= ", fotoPerfil = ?";
    }

    if ($bannerContent !== null) {
        $sql .= ", banner = ?";
    }

    $sql .= " WHERE carnet = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Bind parameters
    if ($fotoPerfilContent !== null && $bannerContent !== null) {
        $stmt->bind_param("sssssssi", $nombre, $usuario, $añoBachi, $seccion, $especialidad, $fotoPerfilContent, $bannerContent, $carnet);
    } elseif ($fotoPerfilContent !== null) {
        $stmt->bind_param("ssssssi", $nombre, $usuario, $añoBachi, $seccion, $especialidad, $fotoPerfilContent, $carnet);
    } elseif ($bannerContent !== null) {
        $stmt->bind_param("ssssssi", $nombre, $usuario, $añoBachi, $seccion, $especialidad, $bannerContent, $carnet);
    } else {
        $stmt->bind_param("sssssi", $nombre, $usuario, $añoBachi, $seccion, $especialidad, $carnet);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Perfil actualizado correctamente.'); window.location.href='../html/perfilUsuario.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al actualizar el perfil. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
