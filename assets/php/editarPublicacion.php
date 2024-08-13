<?php
include '../php/conexion.php';
session_start();

$idMural = $_POST['idMural'];
$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
$descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

if (empty($titulo) || strlen($titulo) > 50 || empty($descripcion) || strlen($descripcion) > 255) {
    echo json_encode(['status' => 'error', 'message' => 'El título o la descripción no cumplen con los requisitos.']);
    exit();
}

$imagen = '';
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = uniqid('', true) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
    $rutaArchivo = '../img/img-mural/' . $nombreArchivo;
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
        $imagen = $nombreArchivo;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen.']);
        exit();
    }
}

$sql = "UPDATE mural SET titulo='$titulo', descripcion='$descripcion'";
if ($imagen !== '') {
    $sql .= ", imagen='$imagen'";
}
$sql .= " WHERE idMural=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMural);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al editar la publicación.']);
}
?>
