<?php
include "../php/conexion.php";

$idProfesor = $_POST['idProfesor'];
$fotoPerfil = !empty($_FILES['fotoPerfil']['tmp_name']) ? addslashes(file_get_contents($_FILES['fotoPerfil']['tmp_name'])) : null;
$nombreCompleto = $_POST['nombreCompleto'];
$materiaInpartida = $_POST['materiaInpartida'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Preparar la consulta SQL para actualizar los datos del profesor
$sql = "UPDATE profesor SET fotoPerfil = COALESCE(?, fotoPerfil), nombreCompleto = ?, materiaInpartida = ?, email = ?, contrasena = ? WHERE idProfesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $fotoPerfil, $nombreCompleto, $materiaInpartida, $email, $contrasena, $idProfesor);

if ($stmt->execute()) {
    header("Location: ../html/profesoradmin.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
