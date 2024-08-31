<?php
include '../php/session_check4.php';
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLibro = $_POST['idLibro'];

    // Validación básica
    if (empty($idLibro)) {
        echo "<script>alert('ID de libro no proporcionado.'); window.history.back();</script>";
        exit();
    }

    // Prepare SQL query
    $sql = "DELETE FROM biblioteca WHERE idLibro = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Bind parameters
    $stmt->bind_param("i", $idLibro);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Libro eliminado correctamente.'); window.location.href='../html/bibliotecaProfesor.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al eliminar el libro. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
