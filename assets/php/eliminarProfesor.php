<?php
include '../php/conexion.php';

// Verificar que el ID del profesor esté presente
if (isset($_POST['idProfesor'])) {
    $idProfesor = $_POST['idProfesor'];

    // Validar que el ID no esté vacío
    if (empty($idProfesor)) {
        echo "<script>alert('ID del profesor no puede estar vacío.'); window.history.back();</script>";
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM profesor WHERE idProfesor = ?");
    $stmt->bind_param("i", $idProfesor);

    if ($stmt->execute()) {
        echo "<script>alert('Profesor eliminado exitosamente.'); window.location.href = '../html/profesoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el profesor.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Error en el envío de datos.'); window.history.back();</script>";
}
?>
