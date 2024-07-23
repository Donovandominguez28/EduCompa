<?php
include "../php/conexion.php"; // Asegúrate de incluir correctamente tu archivo de conexión
include "../php/datos_usuario.php";
include "../php/session_check.php";

// Conexión a la base de datos y consulta SQL

$idPodio = 'idPodio';

$sql = "SELECT * FROM podio WHERE idPodio = $idPodio"; // Ajusta esta consulta según tus necesidades
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$row = $result->fetch_assoc(); // Obtener los datos de la fila

// Comprobación de la existencia de las claves en el array $row
$foto = isset($row['foto']) ? $row['foto'] : '';
$nombreApellido = isset($row['nombreApellido']) ? $row['nombreApellido'] : 'Nombre no disponible';
$top = isset($row['top']) ? $row['top'] : 'N/A';
$descripcion = isset($row['descripcion']) ? $row['descripcion'] : 'Descripción no disponible';
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/sidebar2.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../img/educompalogo.jpg" type="image/x-icon">
</head>
<body>
<?php if (isLoggedIn()) {
    include "../html/sidebar.php";
} ?>

<main class="bodypage">
  
<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../img/3.png" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption d-none d-md-block">
                <h1>Ten un refuerzo divertido.</h1>
                <?php if (!isLoggedIn()) { ?>
                <p><a class="btn btn-lg btn-primary" href="../html/login.html">Registrate o inicia sesión</a></p>
                <?php } ?>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/4.png" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption d-none d-md-block">
                <h1>¡Aprende por medio de juegos!</h1>
                <?php if (!isLoggedIn()) { ?>
                <p><a class="btn btn-lg btn-primary" href="../html/login.html">Registrate o inicia sesión</a></p>
                <?php } ?>
            </div>
        </div>
        <div class="carousel-item">
            <img src="../img/8.jpg" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption d-none d-md-block">
                <h1>Refuerzo prueba avanzo, para que seas el mejor.</h1>
                <?php if (!isLoggedIn()) { ?>
                <p><a class="btn btn-lg btn-primary" href="../html/login.html">Registrate o inicia sesión</a></p>
                <?php } ?>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Marketing messaging and featurettes -->
<div class="container marketing">
    <!-- Datos del estudiante -->
    <?php if (isLoggedIn()) { ?>
        <div class="row">
            <div class="col-lg-4">
                <?php if (!empty($foto)) { ?>
                    <img class="imgradius" src="data:image/jpeg;base64,<?= base64_encode($foto) ?>" alt="<?= $nombreApellido ?>">
                    <h2 class="fw-normal">#<?= $top ?> <?= $nombreApellido ?></h2>
                    <p class="lead"><?= $descripcion ?></p>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <!-- Características adicionales -->
    <hr class="featurette-divider">
    <div class="row featurette" data-bs-ride="fade">
        <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">¡Alcanza tus Metas!</h2>
            <p class="lead">
                En nuestra red social educativa, creemos firmemente que cada estudiante tiene el potencial para alcanzar sus metas y sueños. Sabemos que el camino hacia el éxito académico puede estar lleno de desafíos, pero con las herramientas y el apoyo adecuados, todo es posible.
                <br><br>
                Recuerda: cada paso que das en tu educación es un paso hacia un futuro brillante. Utiliza esta plataforma para explorar, aprender y crecer. Tu éxito es nuestra misión, y juntos podemos lograr cosas extraordinarias.
            </p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid meet" focusable="false">
                <image href="../img/metas2.jpg" width="100%" height="100%" preserveAspectRatio="xMidYMid meet"/>
            </svg>
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette" data-bs-ride="fade">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading fw-normal lh-1">¡El Poder del Trabajo en Equipo!</h2>
            <p class="lead">
                En nuestra red social educativa, creemos que el trabajo en equipo es la clave para el éxito académico y personal. Sabemos que aprender juntos no solo hace el proceso más enriquecedor, sino que también fortalece las habilidades sociales y colaborativas que son esenciales para el futuro.
                <br><br>
                Juntos somos más fuertes. En nuestra plataforma, cada estudiante tiene algo valioso que aportar. Al compartir tus conocimientos y aprender de los demás, todos crecemos y mejoramos. Aquí, elesfuerzo colectivo supera cualquier desafío individual.
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid meet" focusable="false">
                <image href="../img/team.jpg" width="100%" height="100%" preserveAspectRatio="xMidYMid meet"/>
            </svg>
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="row featurette" data-bs-ride="fade">
        <div class="col-md-7">
            <h2 class="featurette-heading fw-normal lh-1">Exploración del Conocimiento</h2>
            <p class="lead">
                En nuestra red social educativa, te invitamos a embarcarte en un viaje de descubrimiento y aprendizaje sin límites. La exploración del conocimiento es el corazón de nuestra comunidad, donde cada pregunta es una puerta hacia nuevas ideas y perspectivas.
                <br><br>
                Sumérgete en el mundo del aprendizaje. En nuestra plataforma, te ofrecemos un vasto océano de recursos y herramientas, listos para ser explorados. Desde artículos fascinantes hasta cursos interactivos, cada rincón está lleno de oportunidades para expandir tu mente y enriquecer tu vida académica.
            </p>
        </div>
        <div class="col-md-5">
            <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid meet" focusable="false">
                <image href="../img/conocimiento.jpg" width="100%" height="100%" preserveAspectRatio="xMidYMid meet"/>
            </svg>
        </div>
    </div>
    <hr class="featurette-divider">
</div><!-- /.container -->

<!-- FOOTER -->
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
