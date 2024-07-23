<?php
include "../php/conexion.php";

$idProfesor = $_GET['idProfesor'];

// Preparar la consulta SQL para eliminar el profesor
$sql = "DELETE FROM profesor WHERE idProfesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idProfesor);

if ($stmt->execute()) {
    header("Location: ../html/profesoradmin.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
