<?php
include '../php/conexion.php';

$idBiblioteca = $_GET['idBiblioteca'];

$sql = "DELETE FROM biblioteca WHERE idBiblioteca='$idBiblioteca'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../html/bibliotecaAdmin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
