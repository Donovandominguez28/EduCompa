<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idContenido = $_POST['idContenido'];

    $sql = "DELETE FROM contenidoclases WHERE idContenido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idContenido);

    if ($stmt->execute()) {
        echo "<script>alert('Contenido eliminado exitosamente.'); window.location.href = '../html/revisarClase.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar contenido.'); window.location.href = '../html/revisarClase.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
