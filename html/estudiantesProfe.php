
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- custom css file link -->
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
        <?php include "../html/perfilProfesor.php"; ?>
        <hr>
        <?php include "../html/navProfesor.php"; ?>
    </div>

    <section class="home-grid">
        <!-- Contenido principal con la tabla de estudiantes -->
        <h1 class="heading">Registro de los estudiantes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Carnet</th>
                    <th scope="col">Foto perfil</th>
                    <th scope="col">Nombre completo</th>
                    <th scope="col">Año bachillerato</th>
                    <th scope="col">Sección</th>
                    <th scope="col">Especialidad</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../php/conexion.php";

                // Obtener los datos de los estudiantes
                $sql = "SELECT * FROM estudiantes";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Error en la consulta: " . $conn->error);
                }
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <th scope='row'>{$row['carnet']}</th>
                                <td><img src='data:image/jpeg;base64," . base64_encode($row['fotoPerfil']) . "' alt='Foto perfil' width='50'></td>
                                <td>{$row['nombreCompleto']}</td>
                                <td>{$row['añoBachi']}</td>
                                <td>{$row['seccion']}</td>
                                <td>{$row['especialidad']}</td>
                                <td>{$row['usuario']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['contrasena']}</td>
                                <td>{$row['rol']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No hay estudiantes registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- custom js file link -->
    <script src="../js/script.js"></script>
</body>
</html>
