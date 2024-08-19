<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAdmin = $_POST['idAdmin'];
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $rol = !empty($_POST['rol']) ? $_POST['rol'] : null;
    $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : null;

    // Validar ID Admin
    if (empty($idAdmin)) {
        echo "<script>alert('ID Admin es obligatorio.'); window.history.back();</script>";
        exit();
    }

    // Obtener los datos actuales del administrador
    $sql = "SELECT * FROM administrador WHERE idAdmin=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idAdmin);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 0) {
        echo "<script>alert('Administrador no encontrado.'); window.history.back();</script>";
        exit();
    }

    $currentData = $result->fetch_assoc();
    
    // Usar los datos actuales si no se proporcionan nuevos valores
    $nombre = $nombre !== null ? $nombre : $currentData['nombre'];
    $email = $email !== null ? $email : $currentData['email'];
    $rol = $rol !== null ? $rol : $currentData['rol'];
    $contrasena = $contrasena !== null ? $contrasena : $currentData['contrasena'];

    // Actualizar los datos
    $sql = "UPDATE administrador SET nombre=?, email=?, rol=?, contrasena=? WHERE idAdmin=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nombre, $email, $rol, $contrasena, $idAdmin);

    if ($stmt->execute()) {
        echo "<script>alert('Administrador actualizado exitosamente.'); window.location.href='../html/administradoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el administrador.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
