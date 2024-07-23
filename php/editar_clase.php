<?php
include "../php/conexion.php";

$idClase = $_POST['idClase'];
$titulo = $_POST['titulo'];
$nombreProfesor = $_POST['nombreProfesor'];
$descripcion = $_POST['descripcion'];
$materia = $_POST['materia'];

$sql = "UPDATE clases SET titulo='$titulo', nombreProfesor='$nombreProfesor', descripcion='$descripcion', materia='$materia'";

if (!empty($_FILES['imagenClase']['tmp_name'])) {
    $imagenClase = addslashes(file_get_contents($_FILES['imagenClase']['tmp_name']));
    $sql .= ", imagenClase='$imagenClase'";
}



$sql .= " WHERE idClase='$idClase'";

if ($conn->query($sql) === TRUE) {
    echo "Clase actualizada exitosamente";
    header("Location: ../html/clasesAdmin.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
