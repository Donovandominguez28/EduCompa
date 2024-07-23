<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Profesor</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Agregar Profesor</h1>
            <form action="../php/agregar_profesor.php" method="POST" enctype="multipart/form-data">
                <div class="inputBox1">
                    <input type="number" name="idProfesor" required>
                    <span>ID Profesor</span>
                </div>
                <div class="inputBox1">
                    <input type="file" name="fotoPerfil" required accept="image/*">
                    <span>Foto de perfil</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreCompleto" required>
                    <span>Nombre Completo</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="materiaInpartida" required>
                    <span>Materia Impartida</span>
                </div>
                <div class="inputBox1">
                    <input type="email" name="email" required>
                    <span>Email</span>
                </div>
                <div class="inputBox1">
                    <input type="password" name="contrasena" required>
                    <span>Contraseña</span>
                </div>
                <button class="save" type="submit">Agregar</button>
            </form>
        </div>
    </div>
</body>
</html>
