<?php
include "../php/conexion.php";

$idClase = $_GET['idClase'];

$sql = "DELETE FROM clases WHERE idClase='$idClase'";

if ($conn->query($sql) === TRUE) {
    echo "Clase eliminada exitosamente";
    header("Location: ../html/clasesAdmin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
