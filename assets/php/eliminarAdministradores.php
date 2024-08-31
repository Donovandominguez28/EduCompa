<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAdmin = $_POST['idAdmin'];

    if (empty($idAdmin)) {
        echo "<script>alert('ID Admin es obligatorio.'); window.history.back();</script>";
        exit();
    }

    $sql = "DELETE FROM administrador WHERE idAdmin=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idAdmin);

    if ($stmt->execute()) {
        echo "<script>alert('Administrador eliminado exitosamente.'); window.location.href='../html/administradoresAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el administrador.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
