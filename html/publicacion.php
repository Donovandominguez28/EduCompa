<?php
include "../php/datos_usuario.php";
include "../php/conexion.php";

// Verifica si la conexión se realizó correctamente
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$carnetEstudiante = $_SESSION['carnet']; // Obtén el ID del estudiante desde la sesión

// Obtener publicaciones del estudiante actual
$sql = "SELECT idMural, imagenMural, titulo, informacion FROM mural WHERE carnet2 = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("s", $carnetEstudiante);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}
include "../php/session_check.php";
// Verificar si el usuario no está autenticado y redirigir a la página de inicio de sesión
if (!isLoggedIn()) {
    header("Location: ../html/login.html");
    exit(); // Asegurarse de que el script se detenga después de la redirección
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicación</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/educompalogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/sidebar2.css">
    <link rel="stylesheet" href="../css/publicacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
</head>
<body>
    <?php include "../html/sidebar.php"; ?>
    <main class="bodypage">
        <h1>Publica en tu mural del conocimiento</h1>
        <div class="containerform">
            <form class="cardform" action="../php/procesar_publicacion.php" method="POST" enctype="multipart/form-data">
                <h1 class="h1">¡Publica algo :)!</h1>
                <input type="hidden" name="carnet2" value="<?php echo htmlspecialchars($carnetEstudiante, ENT_QUOTES, 'UTF-8'); ?>">
                <div class="inputBox1">
                    <input type="file" name="imagenMural" required="required">
                    <span>Imagen</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="titulo" required="required">
                    <span>Título</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="informacion" required="required">
                    <span>Descripción</span>
                </div>
                <button type="submit" class="save">Guardar</button>
            </form>
        </div>
        <br>
        <h1>Registro de tus publicaciones</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <th scope='row'>{$row['idMural']}</th>
                                <td><img src='data:image/jpeg;base64," . base64_encode($row['imagenMural']) . "' alt='Imagen'></td>
                                <td>{$row['titulo']}</td>
                                <td>{$row['informacion']}</td>
                                <td>
                                    <a href='editarPublicacion.php?idMural={$row['idMural']}' class='edit-button'>
                                        <svg class='edit-svgIcon' viewBox='0 0 512 512'>
                                            <path d='M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z'></path>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <a href='../php/eliminar_publicacion.php?idMural={$row['idMural']}' class='delete-button'>
                                        <svg class='delete-svgIcon' viewBox='0 0 448 512'>
                                            <path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay publicaciones registradas</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <br>
        <br>
    </main>

    <footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>Sobre Nosotros:</h3>
                <p>Somos una plataforma de educación en conjunto de red social de refuerzo académico, se busca que el estudiante mejore y tenga una competitividad sana a la hora del estudio.</p>
            </div>
            <div class="footer-column">
                <h3>Contactanos:</h3>
                <p>Email: educompa@gmail.com</p>
                <p>Phone: 503 7681-4348</p>
            </div>
            <div class="footer-column">
                <h3>Siguenos en nuestras redes sociales:</h3>
                <div class="icon-container">
                    <div class="icon">
                        <svg height="80" width="80">
                            <circle cx="40" cy="40" r="35" stroke="white" stroke-width="4" fill="none"></circle>
                        </svg>
                        <i class='bx bxl-instagram'></i>
                    </div>
                    <div class="icon">
                        <svg height="80" width="80">
                            <circle cx="40" cy="40" r="35" stroke="white" stroke-width="4" fill="none"></circle>
                        </svg>
                        <i class='bx bxl-facebook-circle'></i>
                    </div>
                    <div class="icon">
                        <svg height="80" width="80">
                            <circle cx="40" cy="40" r="35" stroke="white" stroke-width="4" fill="none"></circle>
                        </svg>
                        <i class='bx bxl-whatsapp'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>

