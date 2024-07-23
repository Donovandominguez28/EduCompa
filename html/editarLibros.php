<?php
include '../php/conexion.php';

$idBiblioteca = $_GET['idBiblioteca'];
$sql = "SELECT * FROM biblioteca WHERE idBiblioteca='$idBiblioteca'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
        <h1 class="h1">Editar Libro</h1>

            <form action="../php/editar_libro.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idBiblioteca" value="<?php echo $row['idBiblioteca']; ?>">
                <div class="inputBox1">
                    <input type="number" name="idLibro" value="<?php echo $row['idLibro']; ?>" >
                    <span>ID Libro</span>
                </div>
                <div class="inputBox1">
                    <input type="file" name="libroimg">
                    <span>Imagen</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="titulo" value="<?php echo $row['titulo']; ?>">
                    <span>Título</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>" >
                    <span>Descripción</span>
                </div>
                <div class="inputBox1">
                    <input type="url" name="link" value="<?php echo $row['link']; ?>"   >
                    <span>Link</span>
                </div>
                <button class="save" type="submit">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>
