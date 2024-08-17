<?php
include '../php/session_check2.php';
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMural = $_POST['idMural'];
    $titulo = $_POST['titulo'];
    $informacion = $_POST['informacion'];
    $imagenMural = $_FILES['imagenMural'];

    // Validaciones
    if (empty($idMural) || empty($titulo) || empty($informacion)) {
        echo "<script>alert('Por favor, complete todos los campos obligatorios.'); window.history.back();</script>";
        exit();
    }

    if (strlen($titulo) > 100) {
        echo "<script>alert('El título no debe exceder 100 caracteres.'); window.history.back();</script>";
        exit();
    }

    if (strlen($informacion) > 1000) {
        echo "<script>alert('La información no debe exceder 1000 caracteres.'); window.history.back();</script>";
        exit();
    }

    if ($imagenMural['tmp_name']) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imagenMural['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($imagenMural['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $imagenMuralContent = file_get_contents($imagenMural['tmp_name']);
        if ($imagenMuralContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    } else {
        $imagenMuralContent = null; // No change
    }

    // Prepare SQL query
    $sql = "UPDATE mural SET titulo = ?, informacion = ?";

    if ($imagenMuralContent !== null) {
        $sql .= ", imagenMural = ?";
    }

    $sql .= " WHERE idMural = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Bind parameters
    if ($imagenMuralContent !== null) {
        $stmt->bind_param("sssi", $titulo, $informacion, $imagenMuralContent, $idMural);
    } else {
        $stmt->bind_param("ssi", $titulo, $informacion, $idMural);
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Publicación actualizada correctamente.'); window.location.href='../html/perfilUsuario.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al actualizar la publicación. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
