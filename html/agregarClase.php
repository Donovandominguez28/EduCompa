<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Clase</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
        <h1 class="h1">Agregar Clase</h1>

            <form action="../php/agregar_clase.php" method="POST" enctype="multipart/form-data">
               
                <div class="inputBox1">
                    <input type="file" name="imagenClase" required>
                    <span>Imagen</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="titulo" required>
                    <span>Título</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreProfesor" required>
                    <span>Nombre del Profesor</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" required>
                    <span>Descripción</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="materia" required>
                    <span>Materia</span>
                </div>
                
                <button class="save" type="submit">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html>
