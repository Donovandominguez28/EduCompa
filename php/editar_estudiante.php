<?php
// Conectar a la base de datos
include "../php/conexion.php";

// Obtener los datos del formulario
$carnet = $_POST['carnet'];
$usuario = $_POST['usuario'];
$nombreCompleto = $_POST['nombreCompleto'];
$añoBachi = $_POST['añoBachi'];
$seccion = $_POST['seccion'];
$especialidad = $_POST['especialidad'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Query SQL para actualizar los datos del estudiante
$query = "UPDATE estudiantes SET usuario=?, nombreCompleto=?, añoBachi=?, seccion=?, especialidad=?, email=?, contrasena=? WHERE carnet=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssissssi", $usuario, $nombreCompleto, $añoBachi, $seccion, $especialidad, $email, $contrasena, $carnet);

if ($stmt->execute()) {
    echo "Datos actualizados correctamente.";
    header("location:../html/estudiantesadmin.php");
} else {
    echo "Error al actualizar datos: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
