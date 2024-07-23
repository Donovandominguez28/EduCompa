<?php
include "../php/conexion.php";
include "../php/datos_usuario.php";
$idClase = $_GET['idClase'];

// Consulta para obtener los detalles de la clase, incluyendo la imagen
$sql_clase = "SELECT * FROM clases WHERE idClase='$idClase'";
$result_clase = $conn->query($sql_clase);
$row_clase = $result_clase->fetch_assoc();

// Consulta para obtener el contenido de la clase
$sql_contenido = "SELECT * FROM contenidoClases WHERE idClase2='$idClase'";
$result_contenido = $conn->query($sql_contenido);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Clase</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebar2.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../carousel/img/educompalogo.jpg" type="image/x-icon">

    <style>
        .background-container {
            position: relative;
            overflow: hidden;
            text-align: center;
            color: #fff;
        }
        
        .background-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('data:image/jpeg;base64,<?php echo base64_encode($row_clase['imagenClase']); ?>');
            background-size: cover;
            background-position: center;
            filter: brightness(50%);
            z-index: 1;
        }
        
        .background-container .content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <a href="../html/index.php"><img src="../img/educompalogo.jpg" alt="logo" class="logo"></a>
    <?php include "../html/sidebar.php"; ?>
    <main class="bodypage">
        <div class="background-container p-3 p-md-5">
            <div class="content col-md-6 p-lg-5 mx-auto my-5">
                <h1 class="display-3 fw-bold"><?php echo $row_clase['materia']; ?></h1>
                <h3>Prof.<?php echo $row_clase['nombreProfesor']; ?></h3>
            </div>
        </div>
        <div class="container">
            <!-- Sección de contenido de la clase -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <h1 style="color:#365b77">Contenido de la Clase:</h1>
                    <hr>
                    <?php
                    if ($result_contenido->num_rows > 0) {
                        while ($row_contenido = $result_contenido->fetch_assoc()) {
                            echo '<div class="contenido-clase">';
                            echo '<h2 style="color:red">Contenido: '. $row_contenido['contenido'] . '</h2>';
                            if (!empty($row_contenido['multimedia'])) {
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row_contenido['multimedia']) . '" alt="Multimedia de la clase" style="width:300px">';
                            }
                            echo '<br>';
                            echo '<h4 style="color:black">Link: <a href="' . $row_contenido['link'] . '">' . $row_contenido['link'] . '</a></h4>';
                            echo '</div>';
                            echo '<hr>';    
                        }
                    } else {
                        echo '<p>No hay contenido disponible para esta clase.</p>';
                    }
                    ?>
                </div>
            </div>
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
