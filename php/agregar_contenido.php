<?php
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener idClase desde el formulario
    $idClase = $_POST['idClase1'];
    $contenido = $_POST['contenido'];
    $link = $_POST['link'];

    // Procesamiento del archivo multimedia
    $multimedia = null;
    if (isset($_FILES['multimedia']) && $_FILES['multimedia']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['multimedia']['tmp_name'];
        $multimedia = file_get_contents($tmpName);
    }

    // Verificar si el idClase existe en la tabla clases
    $sql_verificar_clase = "SELECT idClase FROM clases WHERE idClase = ?";
    $stmt_verificar_clase = $conn->prepare($sql_verificar_clase);
    $stmt_verificar_clase->bind_param("i", $idClase);
    $stmt_verificar_clase->execute();
    $stmt_verificar_clase->store_result();

    if ($stmt_verificar_clase->num_rows == 0) {
        echo "Error: El idClase proporcionado no existe.";
        exit(); // Terminar el script si el idClase no existe
    }

    // Preparar la consulta SQL para insertar en contenidoClases
    $sql = "INSERT INTO contenidoClases (idClase2, contenido, multimedia, link) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $idClase, $contenido, $multimedia, $link);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Contenido agregado correctamente.";
        header('Location: ../html/verClaseAdmin.php'); // Redireccionar correctamente
        exit();
    } else {
        echo "Error al agregar contenido: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
