<?php
include '../php/conexion.php';

// Verificar que los campos requeridos no estén vacíos
if (isset($_POST['idProfesor'], $_POST['nombreCompleto'], $_POST['email'], $_POST['materiaInpartida'], $_POST['contrasena'])) {
    $idProfesor = $_POST['idProfesor'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $email = $_POST['email'];
    $materiaInpartida = $_POST['materiaInpartida'];
    $contrasena = $_POST['contrasena'];

    // Validar datos
    if (empty($idProfesor) || empty($nombreCompleto) || empty($email) || empty($materiaInpartida) || empty($contrasena)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit();
    }

    // Subir la foto de perfil si se ha seleccionado
    $fotoPerfil = null;
    if (!empty($_FILES['fotoPerfil']['tmp_name'])) {
        $fotoPerfil = file_get_contents($_FILES['fotoPerfil']['tmp_name']);
    }

    $stmt = $conn->prepare("INSERT INTO profesor (idProfesor, nombreCompleto, fotoPerfil, email, materiaInpartida, contrasena) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $idProfesor, $nombreCompleto, $fotoPerfil, $email, $materiaInpartida, $contrasena);

    if ($stmt->execute()) {
        echo "<script>alert('Profesor agregado exitosamente.'); window.location.href = '../html/profesoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el profesor.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Error en el envío de datos.'); window.history.back();</script>";
}
?>
