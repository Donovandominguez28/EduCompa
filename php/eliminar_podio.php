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
        echo '<script>
                alert("Registro eliminado correctamente.");
                window.location.href = "../html/podio.php";
              </script>';
    } else {
        echo '<script>
                alert("Error al eliminar el registro: ' . $conn->error . '");
              </script>';
    }

    $stmt->close();
    $conn->close();
    exit();
} else {
    echo '<script>
            alert("Acceso no autorizado.");
          </script>';
}
?>
