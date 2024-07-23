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
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "El correo electrónico ingresado no es válido. Por favor, revise y vuelva a intentarlo."]);
        exit();
    }

    if (strlen($contrasena) < 6) {
        echo json_encode(["status" => "error", "message" => "La contraseña debe tener al menos 6 caracteres. Por favor, ingrese una contraseña más larga."]);
        exit();
    }

    if ($contrasena !== $confirmarContrasena) {
        echo json_encode(["status" => "error", "message" => "Las contraseñas no coinciden. Por favor, verifique y vuelva a intentarlo."]);
        exit();
    }

    // Validaciones adicionales
    if (!is_numeric($añoBachi) || $añoBachi < 1 || $añoBachi > 3) {
        echo json_encode(["status" => "error", "message" => "El año de bachillerato debe ser un número entre 1 y 3."]);
        exit();
    }
    if (!is_numeric($carnet) || $carnet < 1) {
        echo json_encode(["status" => "error", "message" => "Carnet Invalido."]);
        exit();
    }

    if (!preg_match("/^[A-Za-z]$/", $seccion)) {
        echo json_encode(["status" => "error", "message" => "La sección debe ser una sola letra."]);
        exit();
    }

    /*if (!is_numeric($especialidad) || $especialidad <= 0) {
        echo json_encode(["status" => "error", "message" => "Seleccione una especialidad válida."]);
        exit();
    }*/

    if (strlen($usuario) > 8 || $usuario < 4) {
        echo json_encode(["status" => "error", "message" => "El nombre de usuario no debe exceder los 8 caracteres."]);
        exit();
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fotoPerfil['type'], $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "Por favor, seleccione un archivo de imagen válido (JPEG, PNG, GIF, etc.)."]);
        exit();
    }

    $fotoPerfilContent = file_get_contents($fotoPerfil['tmp_name']);

    $sql = "INSERT INTO estudiantes (carnet, fotoPerfil, nombreCompleto, añoBachi, seccion, especialidad, usuario, email, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisisss", $carnet, $fotoPerfilContent, $nombreCompleto, $añoBachi, $seccion, $especialidad, $usuario, $email, $contrasena);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "redirect" => "../html/login.html"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Ha ocurrido un error al registrar los datos. Inténtelo nuevamente."]);
    }
    $stmt->close();
    $conn->close();
}
?>
