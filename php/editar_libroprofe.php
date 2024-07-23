<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idBiblioteca = $_POST['idBiblioteca'];
    $idLibro = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $libroimg = addslashes(file_get_contents($_FILES['libroimg']['tmp_name']));

    $sql = "UPDATE biblioteca SET idLibro='$idLibro', libroimg='$libroimg', titulo='$titulo', descripcion='$descripcion', link='$link' WHERE idBiblioteca='$idBiblioteca'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../html/bibliotecaProfe.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
