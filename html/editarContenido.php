<?php
include "../php/conexion.php";

if (isset($_GET['idContenido'])) {
    $idContenido = $_GET['idContenido'];

    // Consulta para obtener los datos del contenido específico
    $sql = "SELECT * FROM contenidoClases WHERE idContenido = $idContenido";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idClase2 = $row['idClase2'];
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
        <br>
        <br>
        <?php include "../html/perfilAdmin.php"; ?>
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
                        <input type="text" name="idClase1" value="<?php echo $idClase2; ?>" required>
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
