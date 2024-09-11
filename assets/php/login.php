<?php
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_usuario = $_POST['email'];  // Este campo ahora será tanto para email como para usuario
    $contrasena = $_POST['contrasena'];

    if (empty($email_or_usuario) || empty($contrasena)) {
        echo json_encode(["status" => "error", "message" => "Por favor, ingrese su email/usuario y contraseña."]);
        exit();
    }

    // Función para verificar al usuario ya sea con correo o con nombre de usuario
    function verificarUsuario($conn, $email_or_usuario, $contrasena, $tabla, $idCampo, $contrasenaCampo, $redirect) {
        // Modificamos la consulta para permitir tanto email como usuario
        $sql = "SELECT * FROM $tabla WHERE email = ? OR usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email_or_usuario, $email_or_usuario);  // Se envía el mismo valor dos veces (para email y usuario)
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
                echo json_encode(["status" => "error", "message" => "Email, usuario o contraseña incorrectos"]);
                exit();
            }
        }
    }

    // Verificar estudiantes
    verificarUsuario($conn, $email_or_usuario, $contrasena, "estudiantes", "carnet", "contrasena", "../html/index.php");

    // Verificar administradores
    verificarUsuario($conn, $email_or_usuario, $contrasena, "administrador", "idAdmin", "contrasena", "../html/indexAdmin.php");

    // Verificar profesores
    verificarUsuario($conn, $email_or_usuario, $contrasena, "profesor", "idProfesor", "contrasena", "../html/indexProfesor.php");

    // Si ninguna verificación tuvo éxito
    echo json_encode(["status" => "error", "message" => "Email, usuario o contraseña incorrectos"]);
}
?>
