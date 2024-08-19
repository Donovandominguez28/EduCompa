<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPodio = $_POST['idPodio'];

    $stmt = $conn->prepare("DELETE FROM podio WHERE idPodio = ?");
    $stmt->bind_param("i", $idPodio);
    
    if ($stmt->execute()) {
        echo "<script>alert('Podio eliminado exitosamente.'); window.location.href='../html/podio.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar podio.'); window.location.href='../html/podio.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
