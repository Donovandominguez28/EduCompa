<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Administrador</title>
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>

    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Agregar Administrador</h1>
            <form action="../php/agregarAdministrador.php" method="post">
                <div class="inputBox1">
                    <input type="text" name="idAdmin" required>
                    <span>ID</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombre" required>
                    <span>Nombre</span>
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

    <!-- Custom JS file link -->
    <script src="../js/script.js"></script>
</body>
</html>
    