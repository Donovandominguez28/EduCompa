<?php
include "../php/conexion.php";
include "../php/datos_usuario.php";
include "../html/header.php";
include "../html/sidebar.php";
?>

<body>

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
