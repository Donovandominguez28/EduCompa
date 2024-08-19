<?php
include "../php/session_check3.php";
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClase = $_POST['idClase'];
    $titulo = $_POST['titulo'];
    $materia = $_POST['materia'];
    $descripcion = $_POST['descripcion'];
    $nombreProfesor = $_POST['nombreProfesor'];
    $carnet7 = $_POST['carnet7'];

    // Verificar si se ha subido una nueva imagen
    $imagenClase = null;
    if (isset($_FILES['imagenClase']) && $_FILES['imagenClase']['size'] > 0) {
        $imagenClase = file_get_contents($_FILES['imagenClase']['tmp_name']);
    }

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
        $imagenClase = $imagenClase !== null ? $imagenClase : $currentImagenClase;

        // Preparar la consulta de actualización
        $sql = "UPDATE clases SET titulo = ?, materia = ?, descripcion = ?, nombreProfesor = ?, carnet7 = ?, imagenClase = ? WHERE idClase = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo "<script>alert('Error al preparar la consulta.'); window.history.back();</script>";
            exit();
        }

        $stmt->bind_param("ssssibi", $titulo, $materia, $descripcion, $nombreProfesor, $carnet7, $imagenClase, $idClase);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Clase actualizada exitosamente'); window.location.href = '../html/clasesAdmin.php';</script>";
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
