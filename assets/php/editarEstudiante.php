<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $carnet = $_POST['carnet'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $email = $_POST['email'];
    $añoBachi = $_POST['añoBachi'];
    $seccion = $_POST['seccion'];
    $especialidad = $_POST['especialidad'];
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
    $fotoPerfilTmpName = $_FILES['fotoPerfil']['tmp_name'];

    // Validaciones
    if (empty($carnet)) {
        echo "<script>alert('Carnet es obligatorio.'); window.history.back();</script>";
        exit();
    }

    if (!is_numeric($carnet) || $carnet < 1) {
        echo "<script>alert('Carnet inválido.'); window.history.back();</script>";
        exit();
    }

    if (!empty($añoBachi) && (!is_numeric($añoBachi) || $añoBachi < 1 || $añoBachi > 3)) {
        echo "<script>alert('El año de bachillerato debe ser un número entre 1 y 3.'); window.history.back();</script>";
        exit();
    }

    if (!preg_match("/^[A-Z]$/", $seccion)) {
        echo "<script>alert('La sección debe ser una sola letra mayúscula.'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El email proporcionado no es válido.'); window.history.back();</script>";
        exit();
    }

    if ($fotoPerfilTmpName) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['fotoPerfil']['type'], $allowedTypes)) {
            echo "<script>alert('Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF, etc.).'); window.history.back();</script>";
            exit();
        }

        $maxFileSize = 15 * 1024 * 1024; // 15MB
        if ($_FILES['fotoPerfil']['size'] > $maxFileSize) {
            echo "<script>alert('El tamaño del archivo de imagen no debe exceder 15MB.'); window.history.back();</script>";
            exit();
        }

        $fotoPerfilContent = file_get_contents($fotoPerfilTmpName);
        if ($fotoPerfilContent === false) {
            echo "<script>alert('Error al leer el archivo de imagen.'); window.history.back();</script>";
            exit();
        }
    } else {
        $fotoPerfilContent = null; // No change
    }

    // Obtener los datos actuales del estudiante
    $sqlSelect = "SELECT nombreCompleto, email, añoBachi, seccion, especialidad, contrasena, fotoPerfil FROM estudiantes WHERE carnet=?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param('s', $carnet);
    $stmtSelect->execute();
    $result = $stmtSelect->get_result();
    $currentData = $result->fetch_assoc();
    $stmtSelect->close();

    // Verificar los cambios y construir la consulta de actualización
    $sqlUpdate = "UPDATE estudiantes SET ";
    $params = [];
    $types = '';

    if (!empty($nombreCompleto) && $nombreCompleto !== $currentData['nombreCompleto']) {
        $sqlUpdate .= "nombreCompleto=?, ";
        $params[] = $nombreCompleto;
        $types .= 's';
    }

    if (!empty($email) && $email !== $currentData['email']) {
        $sqlUpdate .= "email=?, ";
        $params[] = $email;
        $types .= 's';
    }

    if (!empty($añoBachi) && $añoBachi !== $currentData['añoBachi']) {
        $sqlUpdate .= "añoBachi=?, ";
        $params[] = $añoBachi;
        $types .= 'i';
    }

    if (!empty($seccion) && $seccion !== $currentData['seccion']) {
        $sqlUpdate .= "seccion=?, ";
        $params[] = $seccion;
        $types .= 's';
    }

    if (!empty($especialidad) && $especialidad !== $currentData['especialidad']) {
        $sqlUpdate .= "especialidad=?, ";
        $params[] = $especialidad;
        $types .= 's';
    }

    if ($contrasena) {
        $sqlUpdate .= "contrasena=?, ";
        $params[] = $contrasena;
        $types .= 's';
    }

    if ($fotoPerfilContent !== null) {
        $sqlUpdate .= "fotoPerfil=?, ";
        $params[] = $fotoPerfilContent;
        $types .= 's';  
    }

    // Eliminar la última coma y espacio
    $sqlUpdate = rtrim($sqlUpdate, ', ') . " WHERE carnet=?";
    $params[] = $carnet;
    $types .= 's';

    // Ejecutar la consulta de actualización
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param($types, ...$params);

    if ($stmtUpdate->execute()) {
        echo "<script>alert('Estudiante actualizado correctamente'); window.location.href='../html/estudiantesAdmin.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar estudiante');</script>";
    }

    $stmtUpdate->close();
    $conn->close();
}
?>
