<?php
include "../php/datos_usuario.php";
include '../php/conexion.php';

$sql = "SELECT * FROM clases";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula Virtual</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebar2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../carousel/img/educompalogo.jpg" type="image/x-icon">
</head>

<body>
    <?php include "../html/sidebar.php"; ?>
    <main class="bodypage">
        <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-body-tertiary">
            <div class="col-md-6 p-lg-5 mx-auto my-5">
                <h1 class="display-3 fw-bold">Aula Virtual</h1>
                <h3 style="color: whitesmoke;">Gestiona tus materias</h3>
            </div>
        </div>
        <div class="cards-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<div class="image">';
                    if (!empty($row['imagenClase'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagenClase']) . '" alt="Descripción de la imagen" class="imgmaterias">';
                    } else {
                        echo '<img src="../img/default.jpg" alt="Imagen por defecto" class="imgmaterias">';
                    }
                    echo '</div>';
                    echo '<div class="content">';
                    echo '<span class="h3">' . $row['titulo'] . '</span>';
                    echo '<br>';
                    echo '<span class="p">' . $row['materia'] . '</span>';
                    echo '<br>';
                    echo '<span class="p">Prof.' . $row['nombreProfesor'] . '</span>';
                    echo '<p class="desc">' . $row['descripcion'] . '</p>';
                    echo '<a class="action" href="../html/verClase.php?idClase=' . $row['idClase'] . '">Revisa la clase<span aria-hidden="true">→</span></a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay clases disponibles.</p>';
            }
            ?>
        </div>
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
    <script src="../js/script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
