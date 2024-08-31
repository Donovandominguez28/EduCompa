<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carnet = $_POST['carnet'];

    $sql = "DELETE FROM estudiantes WHERE carnet=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $carnet);

    if ($stmt->execute()) {
        echo "<script>alert('Estudiante eliminado correctamente'); window.location.href='../html/estudiantesAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar estudiante');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
