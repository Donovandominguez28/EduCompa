<?php
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idAdmin = $_POST['idAdmin'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO administrador (idAdmin, nombre, email, contrasena) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("isss", $idAdmin, $nombre, $email, $contrasena);

    if ($stmt->execute()) {
        header("Location: ../html/administradoresAdmin.php"); // Redirigir a la lista de administradores
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
