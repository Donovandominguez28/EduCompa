<?php
include "../php/conexion.php";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $informacion = $_POST['informacion'];
    $carnet2 = $_POST['carnet2']; // ID del estudiante

    // Procesar la imagen
    $imagenMural = $_FILES['imagenMural']['tmp_name'];
    $imagenMuralContent = addslashes(file_get_contents($imagenMural));

    // Insertar publicación en la base de datos
    $sql = "INSERT INTO mural (imagenMural, titulo, informacion, carnet2) VALUES ('$imagenMuralContent', '$titulo', '$informacion', '$carnet2')";

    if ($conn->query($sql) === TRUE) {
        echo "Publicación guardada correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();

// Redireccionar de vuelta a index.php
header("Location: ../html/publicacion.php");
exit();
?>
