<?php
include '../php/conexion.php';
session_start();

$idMural = $_POST['idMural'];

$sql = "DELETE FROM mural WHERE idMural=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMural);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la publicación.']);
}
?>
