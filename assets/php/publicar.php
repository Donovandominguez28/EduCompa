<?php
include '../php/conexion.php';
session_start();

$carnet = $_SESSION['carnet'];
$titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
$descripcion = mysqli_real_escape_string($conn, $_POST['informacion']);

// Validate title and description
if (empty($titulo) || strlen($titulo) > 100 || empty($descripcion) || strlen($descripcion) > 1000) {
    echo json_encode(['status' => 'error', 'message' => 'El título o la descripción no cumplen con los requisitos.']);
    exit();
}

$imagen = '';
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $imagenContenido = file_get_contents($_FILES['imagen']['tmp_name']);
    $imagenContenido = mysqli_real_escape_string($conn, $imagenContenido);
}

$sql = "INSERT INTO mural (carnet2, titulo, informacion, imagenMural) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $carnet, $titulo, $descripcion, $imagenContenido);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Publicación realizada con éxito.', 'redirect' => '../html/perfilUsuario.php']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al realizar la publicación.']);
}

$stmt->close();
$conn->close();
?>
