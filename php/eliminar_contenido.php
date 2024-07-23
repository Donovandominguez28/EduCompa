<?php
include "../php/conexion.php";

if (isset($_GET['idContenido'])) {
    $idContenido = $_GET['idContenido'];

    // Eliminar el contenido de la clase de la tabla
    $sql = "DELETE FROM contenidoClases WHERE idContenido = $idContenido";

    if ($conn->query($sql) === TRUE) {
        echo "Contenido eliminado correctamente.";
        header('Location: ../html/verClaseAdmin.php'); // Redireccionar correctamente

    } else {
        echo "Error al eliminar el contenido: " . $conn->error;
    }
} else {
    echo "ID de contenido no especificado.";
}

$conn->close();
?>
