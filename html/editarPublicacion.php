<?php
include "../php/conexion.php";

if (isset($_GET['idMural'])) {
    $idMural = intval($_GET['idMural']); // Asegura que es un número entero
    $sql = "SELECT * FROM mural WHERE idMural = $idMural";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Publicación no encontrada");
    }
} else {
    die("ID de publicación no especificado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
<main class="bodypage">
    <h1>Editar Publicación</h1>
    <div class="containerform">
        <form class="cardform" action="../php/editar_publicacion.php?idMural=<?php echo $idMural; ?>" method="POST" enctype="multipart/form-data">
            <h1 class="h1">Edita tu publicación</h1>
            <div class="inputBox1">
                <input type="file" name="imagenMural">
                <span>Imagen</span>
            </div>
            <div class="inputBox1">
                <input type="text" name="titulo" required="required" value="<?php echo htmlspecialchars($row['titulo']); ?>">
                <span>Título</span>
            </div>
            <div class="inputBox1">
                <input type="text" name="informacion" required="required" value="<?php echo htmlspecialchars($row['informacion']); ?>">
                <span>Descripción</span>
            </div>
            <button type="submit" class="save">Guardar</button>
        </form>
    </div>
</main>
</body>
</html>
