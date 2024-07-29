<?php
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idContenido = $_POST['idContenido'];
    $idClase2 = $_POST['idClase2'];
    $contenido = $_POST['contenido'];
    $link = $_POST['link'];

    // Verificar si se envió un nuevo archivo multimedia
    if ($_FILES['multimedia']['size'] > 0) {
        $multimedia = addslashes(file_get_contents($_FILES['multimedia']['tmp_name']));
        $sql = "UPDATE contenidoClases SET idClase2 = '$idClase2', contenido = '$contenido', multimedia = '$multimedia', link = '$link' WHERE idContenido = $idContenido";
    } else {
        // Si no se envió un nuevo archivo multimedia, actualizar solo los otros campos
        $sql = "UPDATE contenidoClases SET idClase2 = '$idClase2', contenido = '$contenido', link = '$link' WHERE idContenido = $idContenido";
    }

    if ($conn->query($sql) === TRUE) {
        header ('Location: ../html/verClaseAdmin.php');
    } else {
        echo "Error al actualizar el contenido: " . $conn->error;
    }
} else {
    echo "Acceso no autorizado.";
}

$conn->close();
?>
