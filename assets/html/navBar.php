<?php
include "../php/conexion.php";

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['carnet'])) {
    $carnet = $_SESSION['carnet'];

    // Obtener la información del usuario desde la base de datos
    $sql = "SELECT fotoPerfil, usuario FROM estudiantes WHERE carnet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carnet);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fotoPerfil, $usuario);

    // Verificar si se ha encontrado el registro
    if ($stmt->num_rows > 0) {
        $stmt->fetch();

        // Obtener el mime type de la imagen
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($fotoPerfil);
    }
    
    $stmt->close();
}
?>
<style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        body{
            background-color: white;
        }
    </style>
    
<header class="header" data-header>
    <div class="container">

        <h1>
            <a href="../html/index.php" class="logo">EduCompa<span class="span">.</span></a>
        </h1>

        <nav class="navbar" data-navbar>
            <ul class="navbar-list">
            <?php 
            
if (isLoggedIn()) {
    echo '<li class="nav-item">
        <a href="../html/perfilUsuario.php" class="navbar-link" data-nav-link><i class="bi bi-people"></i> Perfil</a>
    </li>
    <li class="nav-item">
        <a href="../html/aulaVirtual.php" class="navbar-link" data-nav-link><i class="bi bi-backpack3"></i> Aula Virtual</a>
    </li>
    <li class="nav-item">
        <a href="../html/biblioteca.php" class="navbar-link" data-nav-link><i class="bi bi-book"></i> Biblioteca</a>
    </li>
    <li class="nav-item">
        <a href="../html/users.php" class="navbar-link" data-nav-link><i class="bi bi-chat-dots-fill"></i> Chats</a>
    </li>
    <li class="nav-item">
        <a href="../html/refuerzoAvanzo.php" class="navbar-link" data-nav-link><i class="bi bi-pen"></i> Refuerzo Avanzo</a>
    </li>
    <li class="nav-item">
                    <a href="../html/Juegos.php" class="navbar-link" data-nav-link><i class="bi bi-controller"></i> Juegos</a>
                </li>';
}
?>
                
                
                
                <?php if (isset($_SESSION['carnet'])): ?>
                    <li class="nav-item profile-section">
                        <img src="data:<?php echo $mimeType; ?>;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Foto de perfil" class="profile-pic">
                        <span class="navbar-link"><?php echo htmlspecialchars($usuario); ?></span>
                        <a href="../php/cerrar_sesion.php" class="navbar-link logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="../html/login.html" class="navbar-link" data-nav-link><i class="bi bi-person"></i> Inicia sesión/Regístrate</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="header-btn-group">

            <button class="nav-toggle-btn" aria-label="Toggle Menu" data-menu-toggle-btn>
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line bottom"></span>
            </button>
        </div>

    </div>
</header>
