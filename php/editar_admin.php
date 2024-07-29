<?php
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAdmin = $_POST['idAdmin'];
    $nombre = $_POST['nombre'];
    $rol = $_POST['rol'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "UPDATE administrador SET nombre = ?, rol = ?, email = ?, contrasena = ? WHERE idAdmin = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssi", $nombre, $rol, $email, $contrasena, $idAdmin);

    if ($stmt->execute()) {
        echo "Administrador actualizado exitosamente";
        header("Location: ../html/administradoresAdmin.php"); // Redirigir a la lista de administradores
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
