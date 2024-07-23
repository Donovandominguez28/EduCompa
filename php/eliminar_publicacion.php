<?php
include "../php/conexion.php";

if (isset($_GET['idMural'])) {
    $idMural = $_GET['idMural'];
    $sql = "DELETE FROM mural WHERE idMural = $idMural";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../html/publicacion.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    die("ID de publicación no especificado");
}
?>
