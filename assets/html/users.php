<?php
session_start();
include "../php/conexion.php";
include "../php/session_check2.php";

if (!isset($_SESSION['carnet'])) {
    // Manejo de error si no hay sesión iniciada
    header("location: login.php");
    exit();
}

$outgoing_id = $_SESSION['carnet'];

// Consulta para obtener los datos del usuario
$sql = "SELECT * FROM estudiantes WHERE carnet = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $outgoing_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fotoPerfil = $row['fotoPerfil'];
    $nombreCompleto = $row['nombreCompleto'];
    $usuario = $row['usuario'];
    $añoBachi = $row['añoBachi'];
    $seccion = $row['seccion'];
    $especialidad = $row['especialidad'];
} else {
    // Manejo de error si el usuario no se encuentra
    $fotoPerfil = ''; // Puedes asignar una imagen predeterminada aquí si lo deseas
    $nombreCompleto = 'Usuario no encontrado';
    $usuario = '';
}

$stmt->close();
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">    


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylechat2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Perfil del Usuario</title>
</head>
<body>
    <a href="../html/index.php"><img src="../images/educompalogo.jpg" alt="logo" class="logoEduCompa"></a>

    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img id="user_avatar" src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Avatar del usuario">
                    <div class="details">
                        <span><?php echo htmlspecialchars($nombreCompleto); ?></span>
                        <p><?php echo htmlspecialchars($usuario); ?></p>
                    </div>
                </div>
            </header>
            <div class="search">
                <span class="text">Selecciona un usuario para iniciar el chat</span>
                <input type="text" placeholder="Digite el nombre del estudiante...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                <!-- Aquí se cargará la lista de usuarios mediante JavaScript -->
            </div>
        </section>
    </div>

    <script src="../js/users.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
<?php 
    include '../html/btnCmT.php';
?>

<?php if (isLoggedIn()) {
    include '../html/compaBot.php';
} else {
    echo'';
}
?>