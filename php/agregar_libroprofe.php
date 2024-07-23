<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idLibro = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $link = $_POST['link'];
    $libroimg = addslashes(file_get_contents($_FILES['libroimg']['tmp_name']));

    $sql = "INSERT INTO biblioteca (idLibro, libroimg, titulo, descripcion, link) VALUES ('$idLibro', '$libroimg', '$titulo', '$descripcion', '$link')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../html/bibliotecaProfe.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
