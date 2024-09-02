<?php
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carnet = $_POST['carnet'];
    $fotoPerfil = $_FILES['fotoPerfil'];
    $nombreCompleto = $_POST['nombreCompleto'];
    $añoBachi = $_POST['añoBachi'];
    $seccion = $_POST['seccion'];
    $especialidad = $_POST['especialidad'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmarContrasena = $_POST['confirmarContrasena'];

    // Validaciones
    if (empty($carnet) || empty($fotoPerfil['tmp_name']) || empty($nombreCompleto) || empty($añoBachi) || empty($seccion) || empty($especialidad) || empty($usuario) || empty($email) || empty($contrasena) || empty($confirmarContrasena)) {
        echo json_encode(["status" => "error", "message" => "Por favor, complete todos los campos obligatorios."]);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "El correo electrónico ingresado no es válido. Por favor, revise y vuelva a intentarlo."]);
        return;
    }

    if (strlen($contrasena) < 6) {
        echo json_encode(["status" => "error", "message" => "La contraseña debe tener al menos 6 caracteres. Por favor, ingrese una contraseña más larga."]);
        return;
    }

    if ($contrasena !== $confirmarContrasena) {
        echo json_encode(["status" => "error", "message" => "Las contraseñas no coinciden. Por favor, verifique y vuelva a intentarlo."]);
        return;
    }


    if (!is_numeric($carnet) || $carnet < 1) {
        echo json_encode(["status" => "error", "message" => "Carnet inválido."]);
        return;
    }

    if (!preg_match("/^[A-Z]$/", $seccion)) {
        echo json_encode(["status" => "error", "message" => "La sección debe ser una sola letra mayúscula."]);
        return;
    }

    if (strlen($usuario) > 8 || strlen($usuario) < 4) {
        echo json_encode(["status" => "error", "message" => "El nombre de usuario debe tener entre 4 y 8 caracteres."]);
        return;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fotoPerfil['type'], $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF, etc.)."]);
        return;
    }

    $maxFileSize = 15 * 1024 * 1024; // Incrementa el límite a 15MB
    if ($fotoPerfil['size'] > $maxFileSize) {
        echo json_encode(["status" => "error", "message" => "El tamaño del archivo de imagen no debe exceder 15MB."]);
        return;
    }

    // Leer el contenido del archivo de imagen
    $fotoPerfilContent = file_get_contents($fotoPerfil['tmp_name']);
    if ($fotoPerfilContent === false) {
        echo json_encode(["status" => "error", "message" => "Error al leer el archivo de imagen."]);
        return;
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO estudiantes (carnet, fotoPerfil, nombreCompleto, añoBachi, seccion, especialidad, usuario, email, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo json_encode(["status" => "error", "message" => "Error al preparar la consulta."]);
        return;
    }

    // Usamos "b" para blob (datos binarios), "s" para cadenas de texto, y "i" para enteros
    $stmt->bind_param("issssssss", $carnet, $fotoPerfilContent, $nombreCompleto, $añoBachi, $seccion, $especialidad, $usuario, $email, $contrasena);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "redirect" => "../html/login.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Ha ocurrido un error al registrar los datos. Inténtelo nuevamente."]);
    }

    $stmt->close();
    $conn->close();
}
?>
