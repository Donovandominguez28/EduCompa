<?php
session_start();
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $idPodio = $_POST['idPodio'];
    $top = $_POST['top'];
    $nombreApellido = $_POST['nombreApellido'];
    $descripcion = $_POST['descripcion'];

    // Procesar la imagen si se ha proporcionado una nueva
    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = $_FILES['foto']['tmp_name'];
        $fotoContenido = addslashes(file_get_contents($foto));
        $sql = "UPDATE podio SET top = ?, foto = ?, nombreApellido = ?, descripcion = ? WHERE idPodio = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $top, $fotoContenido, $nombreApellido, $descripcion, $idPodio);
    } else {
        // Si no se proporciona una nueva imagen, actualizar sin cambiar la imagen
        $sql = "UPDATE podio SET top = ?, nombreApellido = ?, descripcion = ? WHERE idPodio = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $top, $nombreApellido, $descripcion, $idPodio);
    }

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        header("location: ../html/podio.php");
        echo "Datos actualizados correctamente.";
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }

    // Cerrar la declaración preparada y la conexión
    $stmt->close();
    $conn->close();
}
?>
