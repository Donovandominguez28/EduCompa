<?php
include "../php/conexion.php";

if (isset($_GET['idContenido'])) {
    $idContenido = $_GET['idContenido'];

    // Consulta para obtener los datos del contenido específico
    $sql = "SELECT * FROM contenidoClases WHERE idContenido = $idContenido";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idClase1 = $row['idClase1'];
        $contenido = $row['contenido'];
        $link = $row['link'];
    } else {
        echo "No se encontró el contenido.";
        exit();
    }
} else {
    echo "ID de contenido no especificado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contenido de Clase</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <header class="header">
        <section class="flex">
            <img class="logo" src="../img/educompalogo.jpg" alt="">
        </section>
    </header>

    <div class="side-bar">
        <br><br>
        <div class="profile">
            <h3 class="name">Carlos Munguia</h3>
            <p class="role">administrador</p>
            <br>
            <div class="btncenter">
                <button class="btncerrarsesion" onclick="window.location.href='../php/cerrar_sesion.php';">
                    <div class="sign">
                        <svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg>
                    </div>
                    <div class="text">Cerrar sesión</div>
                </button>
            </div>
        </div>
        <hr>
        <?php include "../html/navAdmin.php"; ?>
    </div>

    <section class="home-grid">
        <div class="containerform">
            <div class="cardform">
                <h1 class="h1">Editar Contenido de Clase</h1>
                <form action="../php/editar_contenido.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idContenido" value="<?php echo $idContenido; ?>">
                    <div class="inputBox1">
                        <input type="text" name="idClase1" value="<?php echo $idClase1; ?>" required>
                        <span>ID Clase</span>
                    </div>
                    <div class="inputBox1">
                        <input type="text" name="contenido" value="<?php echo $contenido; ?>" required>
                        <span>Contenido</span>
                    </div>
                    <div class="inputBox1">
                        <input type="file" name="multimedia" accept="image/*,video/*">
                        <span>Actualizar Multimedia</span>
                    </div>
                    <div class="inputBox1">
                        <input type="text" name="link" value="<?php echo $link; ?>" required>
                        <span>Link</span>
                    </div>
                    <button class="save" type="submit">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </section>
    <script src="../js/script.js"></script>
</body>
</html>
