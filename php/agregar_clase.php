<?php
include "../php/conexion.php";

$titulo = $_POST['titulo'];
$nombreProfesor = $_POST['nombreProfesor'];
$descripcion = $_POST['descripcion'];
$materia = $_POST['materia'];


$imagenClase = addslashes(file_get_contents($_FILES['imagenClase']['tmp_name']));

$sql = "INSERT INTO clases ( imagenClase, titulo, nombreProfesor, descripcion, materia) VALUES ( '$imagenClase', '$titulo', '$nombreProfesor', '$descripcion', '$materia')";

if ($conn->query($sql) === TRUE) {
    echo '<script>
                alert("Nueva clase agregada exitosamente.");
                window.location.href = "../html/clasesAdmin.php";
              </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
