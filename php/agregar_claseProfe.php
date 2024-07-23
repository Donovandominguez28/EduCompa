<?php
include "../php/conexion.php";

// Iniciar sesión para obtener los datos del profesor y materia
session_start();

// Verificar si el ID del profesor está en la sesión
if (!isset($_SESSION['idProfesor'])) {
    die("Error: ID del profesor no encontrado.");
}

// Obtener datos del profesor basados en el ID del profesor
$idProfesor = $_SESSION['idProfesor'];
$sql = "SELECT nombreCompleto, materiaInpartida FROM profesor WHERE idProfesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idProfesor);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreProfesor = $row['nombreCompleto'];
    $materia = $row['materiaInpartida'];
} else {
    die("Error: Datos del profesor no encontrados.");
}

$stmt->close();

// Verificar si se enviaron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagenClase = $_FILES['imagenClase']['tmp_name']; // Ruta temporal del archivo

    // Subir imagen al servidor
    $imagenClaseContenido = file_get_contents($imagenClase);

    // Preparar la consulta SQL
    $sql = "INSERT INTO clases (titulo, descripcion, imagenClase, nombreProfesor, materia) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $titulo, $descripcion, $imagenClaseContenido, $nombreProfesor, $materia);

    if ($stmt->execute()) {
        header("Location: ../html/clasesProfesor.php");
        exit();
    } else {
        echo "Error al agregar clase: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
