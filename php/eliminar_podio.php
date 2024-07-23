<?php
session_start();
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idPodio'])) {
    $idPodio = $_GET['idPodio'];

    // Eliminar el registro del podio
    $sql = "DELETE FROM podio WHERE idPodio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPodio);

    if ($stmt->execute()) {
        header("location: ../html/podio.php");
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>
