<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Editar Profesor</h1>
            <?php
            include "../php/conexion.php";

            $idProfesor = $_GET['idProfesor'];

            // Obtener los datos del profesor desde la base de datos
            $sql = "SELECT * FROM profesor WHERE idProfesor = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $idProfesor);
            $stmt->execute();
            $result = $stmt->get_result();
            $profesor = $result->fetch_assoc();

            // Verificar si se encontraron datos
            if ($profesor) {
                $fotoPerfil = $profesor['fotoPerfil'];
                $nombreCompleto = htmlspecialchars($profesor['nombreCompleto']);
                $materiaInpartida = htmlspecialchars($profesor['materiaInpartida']);
                $email = htmlspecialchars($profesor['email']);
                $contrasena = htmlspecialchars($profesor['contrasena']);
            } else {
                echo "<p>Profesor no encontrado.</p>";
                exit();
            }
            ?>
            <form action="../php/editar_profesor.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idProfesor" value="<?php echo $idProfesor; ?>">
                <div class="inputBox1">
                    <input type="file" name="fotoPerfil" accept="image/*">
                    <span>Foto de perfil</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreCompleto" value="<?php echo $nombreCompleto; ?>" required>
                    <span>Nombre Completo</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="materiaInpartida" value="<?php echo $materiaInpartida; ?>" required>
                    <span>Materia Impartida</span>
                </div>
                <div class="inputBox1">
                    <input type="email" name="email" value="<?php echo $email; ?>" required>
                    <span>Email</span>
                </div>
                <div class="inputBox1">
                    <input type="password" name="contrasena" value="<?php echo $contrasena; ?>" required>
                    <span>Contraseña</span>
                </div>
                <button class="save" type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>
</body>
</html>
