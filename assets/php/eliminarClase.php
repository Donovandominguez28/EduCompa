<?php
include '../php/session_check3.php';
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClase = $_POST['idClase'];

    // Mostrar valor de idClase para depuración
    error_log("ID de clase: " . $idClase);

    // Preparar la consulta SQL
    $sql = "DELETE FROM clases WHERE idClase = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Error al preparar la consulta: " . $conn->error);
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Vincular parámetros
    $stmt->bind_param("i", $idClase);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Clase eliminada correctamente.'); window.location.href='../html/clasesAdmin.php';</script>";
    } else {
        error_log("Error al ejecutar la consulta: " . $stmt->error);
        echo "<script>alert('Ha ocurrido un error al eliminar la clase. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
