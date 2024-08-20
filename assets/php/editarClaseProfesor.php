<?php
include "../php/session_check4.php";
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClase = $_POST['idClase'];
    $titulo = $_POST['titulo'];
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];
    $nombreProfesor = $_POST['nombreProfesor'];
    $carnet7 = $_POST['carnet7'];

    // Verificar si se ha subido una nueva imagen
    $imagenClaseContent = null;
    if (isset($_FILES['imagenClase']) && $_FILES['imagenClase']['size'] > 0) {
        $imagenClase = $_FILES['imagenClase'];
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

    // Recuperar la foto del profesor actual
    $sqlProfesor = "SELECT fotoPerfil FROM profesor WHERE idProfesor = ?";
    $stmtProfesor = $conn->prepare($sqlProfesor);
    if ($stmtProfesor === false) {
        echo "<script>alert('Error al preparar la consulta para la foto del profesor.'); window.history.back();</script>";
        exit();
    }
    $stmtProfesor->bind_param('i', $carnet7);
    $stmtProfesor->execute();
    $stmtProfesor->bind_result($fotoProfesor);
    $stmtProfesor->fetch();
    $stmtProfesor->close();

    // Si no hay foto del profesor en la base de datos, usar una imagen predeterminada
    $fotoProfesorContent = $fotoProfesor ? $fotoProfesor : file_get_contents('../images/userrr.png');

    if ($idClase) {
        // Recuperar los valores actuales de la base de datos
        $sql = "SELECT titulo, materia, descripcion, nombreProfesor, carnet7, imagenClase FROM clases WHERE idClase = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idClase);
        $stmt->execute();
        $stmt->bind_result($currentTitulo, $currentMateria, $currentDescripcion, $currentNombreProfesor, $currentCarnet7, $currentImagenClase);
        $stmt->fetch();
        $stmt->close();

        // Si un campo está vacío, mantener el valor actual
        $titulo = !empty($titulo) ? $titulo : $currentTitulo;
        $materia = !empty($materia) ? $materia : $currentMateria;
        $descripcion = !empty($descripcion) ? $descripcion : $currentDescripcion;
        $nombreProfesor = !empty($nombreProfesor) ? $nombreProfesor : $currentNombreProfesor;
        $carnet7 = !empty($carnet7) ? $carnet7 : $currentCarnet7;
        $imagenClaseContent = $imagenClaseContent !== null ? $imagenClaseContent : $currentImagenClase;

        // Preparar la consulta de actualización
        $sql = "UPDATE clases SET titulo = ?, materia = ?, descripcion = ?, nombreProfesor = ?, carnet7 = ?, imagenClase = ?, fotoProfesor = ? WHERE idClase = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
            exit();
        }

        // Vincular parámetros
        $stmt->bind_param("ssssissi", $titulo, $materia, $descripcion, $nombreProfesor, $carnet7, $imagenClaseContent, $fotoProfesorContent, $idClase);

        // Enviar los datos largos de la imagen y la foto del profesor si están presentes
        if ($imagenClaseContent !== null) {
            $stmt->send_long_data(5, $imagenClaseContent); // 5 es el índice del parámetro imagenClase en la consulta
        }
        if ($fotoProfesorContent !== null) {
            $stmt->send_long_data(6, $fotoProfesorContent); // 6 es el índice del parámetro fotoProfesor en la consulta
        }

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Clase actualizada exitosamente'); window.location.href = '../html/clasesProfesor.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar la clase'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('ID de clase no válido'); window.history.back();</script>";
    }
}

// Cerrar la conexión
$conn->close();
?>
