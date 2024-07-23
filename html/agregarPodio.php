<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar al podio</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Agregar estudiante al podio</h1>
            <form action="../php/agregar_podio.php" method="POST" enctype="multipart/form-data">
            <div class="inputBox1">
                    <input type="file" name="foto" required accept="image/*">
                    <span>Foto de perfil</span>
                </div>
                <div class="inputBox1">
                    <input type="number" name="top" required>
                    <span>Posición en el podio</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreApellido" required>
                    <span>Nombre y Apellido</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" required></input>
                    <span>Descripción</span>
                </div>
                <button class="save" type="submit">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html>
