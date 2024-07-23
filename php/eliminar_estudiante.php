<?php
// Conectar a la base de datos
include "../php/conexion.php";

// Obtener el carné del estudiante a eliminar
$carnet = $_GET['carnet'];

// Query SQL para eliminar el estudiante
$query = "DELETE FROM estudiantes WHERE carnet=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $carnet);

if ($stmt->execute()) {
    echo "Estudiante eliminado correctamente.";
    header("location: ../html/estudiantesadmin.php");
} else {
    echo "Error al eliminar estudiante: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
