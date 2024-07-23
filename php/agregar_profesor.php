<?php
include "../php/conexion.php";

// Validar que el ID del profesor esté definido y no sea vacío
if (empty($_POST['idProfesor'])) {
    die("El ID del profesor es obligatorio.");
}

$idProfesor = $_POST['idProfesor'];
$nombreCompleto = $_POST['nombreCompleto'];
$materiaInpartida = $_POST['materiaInpartida'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

// Verificar si el archivo fue subido correctamente
if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
    $fotoPerfil = addslashes(file_get_contents($_FILES['fotoPerfil']['tmp_name']));
} else {
    die("Error al subir la foto de perfil.");
}

// Consulta SQL con idProfesor proporcionado
$sql = "INSERT INTO profesor (idProfesor, fotoPerfil, nombreCompleto, materiaInpartida, email, contrasena) VALUES ('$idProfesor', '$fotoPerfil', '$nombreCompleto', '$materiaInpartida', '$email', '$contrasena')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../html/profesoradmin.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
