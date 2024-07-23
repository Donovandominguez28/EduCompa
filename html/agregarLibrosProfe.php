<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
        <h1 class="h1">Agregar Libro</h1>

            <form action="../php/agregar_libroprofe.php" method="POST" enctype="multipart/form-data">
                <div class="inputBox1">
                    <input type="number" name="idLibro" required="required">
                    <span>ID Libro</span>
                </div>
                <div class="inputBox1">
                    <input type="file" name="libroimg" required="required">
                    <span>Imagen</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="titulo" required="required">
                    <span>Título</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" required="required">
                    <span>Descripción</span>
                </div>
                <div class="inputBox1">
                    <input type="url" name="link" required="required">
                    <span>Link</span>
                </div>
                <button class="save" type="submit">Guardar</button>
            </form>
        </div>
    </div>
</body>
</html>
