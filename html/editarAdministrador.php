<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Administrador</title>
    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <header class="header">
        <section class="flex">
           <img class="logo" src="../img/educompalogo.jpg" alt="Logo">
        </section>
    </header>

    <div class="side-bar">
        <br>
        <br>
        <?php include "../html/perfilAdmin.php"; ?>
        <hr>
        <?php include "../html/navAdmin.php"; ?>
    </div>

    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Editar Administrador</h1>
            <?php
            include "../php/conexion.php";

            if (isset($_GET['idAdmin'])) {
                $idAdmin = $_GET['idAdmin'];

                $sql = "SELECT * FROM administrador WHERE idAdmin = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $idAdmin);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    echo "No se encontró el administrador.";
                }

                $stmt->close();
            }
            ?>
            <form action="../php/editar_admin.php" method="post">
                <input type="hidden" name="idAdmin" value="<?php echo htmlspecialchars($row['idAdmin']); ?>">
                <input type="hidden" name="rol" value="<?php echo htmlspecialchars($row['rol']); ?>">
                <div class="inputBox1">
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
                    <span>Nombre</span>
                </div>
                <div class="inputBox1">
                    <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    <span>Email</span>
                </div>
                <div class="inputBox1">
                    <input type="password" name="contrasena" value="<?php echo htmlspecialchars($row['contrasena']); ?>" required>
                    <span>Contraseña</span>
                </div>
                <button class="save" type="submit">Actualizar</button>
            </form>
        </div>
    </div>

    <!-- Custom JS file link -->
    <script src="../js/script.js"></script>
</body>
</html>
