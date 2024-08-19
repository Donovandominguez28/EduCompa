<?php
include "../php/session_check3.php";
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLibro = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $libroimg = $_FILES['libroimg'];
    $link = $_POST['link'];
    $carnet6 = $_POST['carnet6'];

    // Validaciones básicas
    if (empty($idLibro) || empty($titulo) || empty($descripcion) || empty($carnet6)) {
        echo "<script>alert('Por favor, complete todos los campos obligatorios.'); window.history.back();</script>";
        exit();
    }

    // Obtener los valores actuales del libro para conservarlos si algún campo se deja vacío
    $sql = "SELECT titulo, descripcion, link, carnet6, libroimg FROM biblioteca WHERE idLibro = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta para obtener los datos actuales.'); window.history.back();</script>";
        exit();
    }
    $stmt->bind_param("i", $idLibro);
    $stmt->execute();
    $stmt->bind_result($currentTitulo, $currentDescripcion, $currentLink, $currentCarnet6, $currentLibroimg);
    $stmt->fetch();
    $stmt->close();

    // Si los campos están vacíos, conservar los valores anteriores
    if (empty($titulo)) {
        $titulo = $currentTitulo;
    }

    if (empty($descripcion)) {
        $descripcion = $currentDescripcion;
    }

    if (empty($link)) {
        $link = $currentLink;
    }

    if (empty($carnet6)) {
        $carnet6 = $currentCarnet6;
    }

    // Manejo de la imagen y actualización condicional
    $updateImgQuery = "";
    $libroimgContent = null;
    $params = [];

    if (!empty($libroimg['tmp_name'])) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($libroimg['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($libroimg['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $libroimgContent = file_get_contents($libroimg['tmp_name']);
        if ($libroimgContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }

        // Incluir el campo de la imagen en la consulta SQL si se subió una nueva imagen
        $updateImgQuery = ", libroimg = ?";
        $params[] = $libroimgContent;
    }

    // Preparar la consulta SQL
    $sql = "UPDATE biblioteca SET titulo = ?, descripcion = ?, link = ?, carnet6 = ? $updateImgQuery WHERE idLibro = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Asignar los parámetros de la consulta
    $types = "ssssi";
    if (!empty($updateImgQuery)) {
        $types .= "b"; // Agregar tipo 'b' para el campo blob si se actualiza la imagen
    }

    $params = array_merge([$titulo, $descripcion, $link, $carnet6], $params, [$idLibro]);
    $stmt->bind_param($types, ...$params);

    // Enviar la imagen en caso de que haya sido actualizada
    if ($libroimgContent !== null) {
        $stmt->send_long_data(4, $libroimgContent); // 4 es la posición del parámetro 'libroimg' cuando se incluye
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Libro actualizado correctamente.'); window.location.href='../html/bibliotecaAdmin.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al actualizar el libro. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
