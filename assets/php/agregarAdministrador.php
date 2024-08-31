<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAdmin = $_POST['idAdmin'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];
    $contrasena = $_POST['contrasena'];

    if (empty($idAdmin) || empty($nombre) || empty($email) || empty($contrasena)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO administrador (idAdmin, nombre, rol, email, contrasena) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $idAdmin, $nombre, $rol, $email, $contrasena);

    if ($stmt->execute()) {
        echo "<script>alert('Administrador agregado exitosamente.'); window.location.href='../html/administradoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al agregar el administrador.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
