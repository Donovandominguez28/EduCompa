<?php
session_start();
include_once "../php/conexion.php";

// Verifica si el usuario está autenticado
if (isset($_SESSION['carnet'])) {
    $outgoing_id = $_SESSION['carnet'];
    // Verifica si incoming_id está definido y no está vacío
    $incoming_id = isset($_GET['carnet']) ? mysqli_real_escape_string($conn, $_GET['carnet']) : '';
    if ($incoming_id) {
        // Obtener los datos del usuario de la base de datos
        $sql = "SELECT * FROM estudiantes WHERE carnet = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $incoming_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Verificar si se encontró el usuario
        if ($user) {
            $fotoPerfil = $user['fotoPerfil']; // Aquí asumes que fotoPerfil contiene los datos de la imagen en base64
        } else {
            // Manejo si el usuario no existe
            $fotoPerfil = ''; // O asigna un valor por defecto
        }
    } else {
        // Manejo si no se proporciona incoming_id
        $fotoPerfil = ''; // O asigna un valor por defecto
    }
} else {
    // Manejo si el usuario no está autenticado
    header("Location: ../html/login.php");
    exit;
}
?>
<?php include_once "../html/header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="../html/users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <?php if (isset($user)) : ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="img">
                    <div class="details">
                        <span><?php echo htmlspecialchars($user['nombreCompleto']); ?></span>
                    </div>
                <?php else : ?>
                    <div class="details">
                        <span>Usuario no encontrado</span>
                    </div>
                <?php endif; ?>
            </header>
            <div class="chat-box"></div>
            <form action="../php/insert-chat.php" class="typing-area">
                <input type="hidden" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($incoming_id); ?>">
                <input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
                <button type="submit"><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="../js/chat.js"></script>
</body>
</html>
