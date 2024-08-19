<?php
include "../php/session_check4.php";
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idLibro = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $libroimg = $_FILES['libroimg'];
    $link = $_POST['link'];
    $carnet6 = $_POST['carnet6']; // Asignar a estudiante

    // Validations
    if (empty($idLibro) || empty($titulo) || empty($descripcion) || empty($carnet6)) {
        echo "<script>alert('Por favor, complete todos los campos obligatorios.'); window.history.back();</script>";
        exit();
    }

    if (strlen($titulo) > 100) {
        echo "<script>alert('El título no debe exceder 100 caracteres.'); window.history.back();</script>";
        exit();
    }

    if (strlen($descripcion) > 1000) {
        echo "<script>alert('La descripción no debe exceder 1000 caracteres.'); window.history.back();</script>";
        exit();
    }

    // Handle image upload
    $libroimgContent = null;
    if ($libroimg['tmp_name']) {
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
    }

    // Prepare SQL query
    $sql = "INSERT INTO biblioteca (idLibro, titulo, descripcion, libroimg, link, carnet6) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Bind parameters
    $stmt->bind_param("issssi", $idLibro, $titulo, $descripcion, $libroimgContent, $link, $carnet6);

    // Send image data in chunks if image is provided
    if ($libroimgContent !== null) {
        $stmt->send_long_data(3, $libroimgContent); // 3 is the position of the blob parameter in the SQL statement
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Libro agregado correctamente.'); window.location.href='../html/bibliotecaProfesor.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al agregar el libro. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
