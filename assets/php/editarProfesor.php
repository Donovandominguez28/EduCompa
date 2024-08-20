<?php
include '../php/conexion.php';

// Verificar que el ID del profesor esté presente
if (isset($_POST['idProfesor'])) {
    $idProfesor = $_POST['idProfesor'];

    // Obtener los datos actuales del profesor
    $stmt = $conn->prepare("SELECT nombreCompleto, fotoPerfil, email, materiaInpartida, contrasena FROM profesor WHERE idProfesor = ?");
    $stmt->bind_param("i", $idProfesor);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentData = $result->fetch_assoc();
    $stmt->close();

    // Verificar que los campos requeridos no estén vacíos
    $nombreCompleto = !empty($_POST['nombreCompleto']) ? $_POST['nombreCompleto'] : $currentData['nombreCompleto'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $currentData['email'];
    $materiaInpartida = !empty($_POST['materiaInpartida']) ? $_POST['materiaInpartida'] : $currentData['materiaInpartida'];
    $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : $currentData['contrasena'];

    // Subir la foto de perfil si se ha seleccionado
    $fotoPerfil = $currentData['fotoPerfil']; // Mantener foto actual por defecto
    if (!empty($_FILES['fotoPerfil']['tmp_name'])) {
        $fotoPerfil = file_get_contents($_FILES['fotoPerfil']['tmp_name']);
    }

    // Preparar y ejecutar la actualización
    $stmt = $conn->prepare("UPDATE profesor SET nombreCompleto = ?, fotoPerfil = ?, email = ?, materiaInpartida = ?, contrasena = ? WHERE idProfesor = ?");
    $stmt->bind_param("sssssi", $nombreCompleto, $fotoPerfil, $email, $materiaInpartida, $contrasena, $idProfesor);
    if ($stmt->execute()) {
        echo "<script>alert('Profesor actualizado exitosamente.'); window.location.href = '../html/profesoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el profesor.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Error en el envío de datos.'); window.history.back();</script>";
}
?>
