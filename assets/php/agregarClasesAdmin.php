<?php
include "../php/session_check3.php";
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClase = $_POST['idClase'];
    $descripcion = $_POST['descripcion'];
    $materia = $_POST['materia'];
    $nombreProfesor = $_POST['nombreProfesor'];
    $titulo = $_POST['titulo'];
    $imagenClase = $_FILES['imagenClase'];
    $carnet7 = $_POST['carnet7']; // Asignar a estudiante

    // Validaciones
    if (empty($idClase) || empty($descripcion) || empty($materia) || empty($nombreProfesor) || empty($titulo) || empty($carnet7)) {
        echo "<script>alert('Por favor, complete todos los campos obligatorios.'); window.history.back();</script>";
        exit();
    }

    if (strlen($descripcion) > 1000) {
        echo "<script>alert('La descripción no debe exceder 1000 caracteres.'); window.history.back();</script>";
        exit();
    }

    // Manejo de la carga de imagen
    $imagenClaseContent = null;
    if ($imagenClase['tmp_name']) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($imagenClase['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($imagenClase['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $imagenClaseContent = file_get_contents($imagenClase['tmp_name']);
        if ($imagenClaseContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO clases (idClase, titulo, descripcion, materia, nombreProfesor, imagenClase, carnet7) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        error_log("Error al preparar la consulta: " . $conn->error);
        echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
        exit();
    }

    // Vincular parámetros
    $stmt->bind_param('isssssi', $idClase, $titulo, $descripcion, $materia, $nombreProfesor, $imagenClaseContent, $carnet7);

    // Enviar el dato largo de la imagen si está presente
    if ($imagenClaseContent !== null) {
        $stmt->send_long_data(5, $imagenClaseContent); // 5 es el índice del parámetro imagenClase en la consulta
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<script>alert('Clase agregada correctamente.'); window.location.href='../html/clasesAdmin.php';</script>";
    } else {
        echo "<script>alert('Ha ocurrido un error al agregar la clase. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
