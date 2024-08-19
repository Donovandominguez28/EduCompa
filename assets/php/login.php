<?php
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    if (empty($email) || empty($contrasena)) {
        echo json_encode(["status" => "error", "message" => "Por favor, ingrese su email y contraseña."]);
        exit();
    }

    function verificarUsuario($conn, $email, $contrasena, $tabla, $idCampo, $contrasenaCampo, $redirect) {
        $sql = "SELECT * FROM $tabla WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($contrasena === $user[$contrasenaCampo]) {
                $_SESSION[$idCampo] = $user[$idCampo];
                if (isset($user['fotoPerfil'])) {
                    $_SESSION['fotoPerfil'] = base64_encode($user['fotoPerfil']);
                }
                echo json_encode(["status" => "success", "redirect" => $redirect]);
                exit();
            } else {
                echo json_encode(["status" => "error", "message" => "Email o contraseña incorrectos"]);
                exit();
            }
        }
    }

    // Verificar estudiantes
    verificarUsuario($conn, $email, $contrasena, "estudiantes", "carnet", "contrasena", "../html/index.php");

    // Verificar administradores
    verificarUsuario($conn, $email, $contrasena, "administrador", "idAdmin", "contrasena", "../html/indexAdmin.php");

    // Verificar profesores
    verificarUsuario($conn, $email, $contrasena, "profesor", "idProfesor", "contrasena", "../html/indexProfesor.php");

    // Si ninguna verificación tuvo éxito
    echo json_encode(["status" => "error", "message" => "Email o contraseña incorrectos"]);
}
?>
