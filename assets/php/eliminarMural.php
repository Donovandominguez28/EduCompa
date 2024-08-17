<?php
include '../php/session_check2.php';
include '../php/conexion.php';

$idMural = $_GET['idMural'] ?? null;

if (!$idMural) {
    echo "<script>alert('ID de mural no proporcionado.'); window.history.back();</script>";
    exit();
}

$sql = "DELETE FROM mural WHERE idMural = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMural);

if ($stmt->execute()) {
    echo "<script>alert('Mural eliminado con éxito.'); window.location.href='../html/perfilUsuario.php';</script>";
} else {
    echo "<script>alert('Error al eliminar el mural.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
