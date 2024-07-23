<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleadmin.css">
    <title>Editar Estudiante</title>
</head>
<body>
    <br>
    <br>
    <?php
    // Verificar si se ha pasado un parámetro de carné
    if (isset($_GET['carnet'])) {
        // Conectar a la base de datos
        include "../php/conexion.php";
        // Obtener el carné del estudiante a editar
        $carnet = $_GET['carnet'];
        
        // Consulta SQL para obtener los datos del estudiante
        $query = "SELECT * FROM estudiantes WHERE carnet = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $carnet);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    
<div class="containerform">
    <div class="cardform">
    <h1 class="h1" >Actualiza los datos de este usuario</h1>

        <form action="../php/editar_estudiante.php" method="POST">
            <input type="hidden" name="carnet" value="<?php echo $row['carnet']; ?>">

            <div class="inputBox1">
                <input type="text" name="usuario" value="<?php echo $row['usuario']; ?>" required="required">
                <span>Usuario</span>
            </div>

            <div class="inputBox1">
                <input type="text" name="nombreCompleto" value="<?php echo $row['nombreCompleto']; ?>" required="required">
                <span>Nombre Completo</span>
            </div>

            <div class="inputBox1">
                <input type="number" name="añoBachi" value="<?php echo $row['añoBachi']; ?>" required="required">
                <span>Año de Bachillerato</span>
            </div>

            <div class="inputBox1">
                <input type="text" name="seccion" value="<?php echo $row['seccion']; ?>" required="required">
                <span>Sección</span>
            </div>

            <div class="inputBox1">
                <input type="text" name="especialidad" value="<?php echo $row['especialidad']; ?>" required="required">
                <span>Especialidad</span>
            </div>

            <div class="inputBox1">
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required="required">
                <span>Email</span>
            </div>

            <div class="inputBox1">
                <input type="password" name="contrasena" value="<?php echo $row['contrasena']; ?>" required="required">
                <span>Contraseña</span>
            </div>

            <button class="save" type="submit">Actualizar</button>
        </form>
    </div>
</div>

    <?php
        } else {
            echo "No se encontró ningún estudiante con ese carné.";
        }
        
        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo "No se ha especificado el carné del estudiante a editar.";
    }
    ?>
</body>
</html>
