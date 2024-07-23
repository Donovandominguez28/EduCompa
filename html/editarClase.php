<?php
include '../php/conexion.php';

$idClase = $_GET['idClase'] ?? null;

if (!$idClase) {
    die('ID de la clase no proporcionado.');
}

$sql = "SELECT * FROM clases WHERE idClase='$idClase'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die('Clase no encontrada.');
}

$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Clase</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Editar Clase</h1>
            <form action="../php/editar_clase.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idClase" value="<?php echo htmlspecialchars($row['idClase'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="inputBox1">
                    <input type="file" name="imagenClase">
                    <span>Imagen (dejar en blanco para no cambiar)</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="titulo" value="<?php echo htmlspecialchars($row['titulo'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <span>Título</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreProfesor" value="<?php echo htmlspecialchars($row['nombreProfesor'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <span>Nombre del Profesor</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" value="<?php echo htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <span>Descripción</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="materia" value="<?php echo htmlspecialchars($row['materia'], ENT_QUOTES, 'UTF-8'); ?>" required>
                    <span>Materia</span>
                </div>
                
                <button class="save" type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>
</body>
</html>

