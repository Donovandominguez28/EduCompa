<?php
include "../php/datos_usuario.php";
include "../php/conexion.php";
include "../php/session_check.php";
// Verificar si el usuario no está autenticado y redirigir a la página de inicio de sesión
if (!isLoggedIn()) {
    header("Location: ../html/login.html");
    exit(); // Asegurarse de que el script se detenga después de la redirección
}

$carnetEstudiante = $_SESSION['carnet']; // Obtén el ID del estudiante desde la sesión


// Obtener publicaciones del estudiante actual
$sql = "SELECT idMural, imagenMural, titulo, informacion FROM mural WHERE carnet2 = $carnetEstudiante";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/sidebar2.css">
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="shortcut icon" href="../img/educompalogo.jpg" type="image/x-icon">

    <!-- Custom styles for this template -->
  </head>
  <?php
include "../html/sidebar.php";
?>
<body>

<!--==========================
=            html            =
===========================-->
<section class="perfil-usuario" style=".perfil-usuario {
    background: linear-gradient(#365b77, transparent);
    color: #333;
}">
    <div class="contenedor-perfil">
        <div class="portada-perfil" style="background-image: url('../img/banner.jpg');">
            <div class="sombra"></div>
            <div class="avatar-perfil">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="img">

            </div>
            <div class="datos-perfil">
            <h4>Nombre: <?php echo $nombreCompleto; ?></h4>
            <h4>Usuario: <?php echo $usuario; ?></h4>
            <h4><?php echo $añoBachi; ?> Año</h4>
            <h4>Seccion <?php echo $seccion; ?></h4>
            <h4>Especialidad: <?php echo $especialidad; ?></h4>
<br>
                <ul class="lista-perfil">
                    <li>35 Seguidores</li>
                    <li>7 Seguidos</li>
                </ul>
            </div>
            <div class="opcciones-perfil">
                <a type="../html/editarPerfil"><i class="fas fa-wrench"></i></a>
            </div>
        </div>
        <div class="menu-perfil">
            <ul>
                <li><a href="../html/publicacion.php" title=""><i class="icono-perfil fas fa-info-circle"></i> Publicacion</a></li>            
            
            </ul>
        </div>
    </div>
</section>
<br><br>
<h1>Mural del Conocimiento</h1>
<br>
<br>
<div class="containerr">
        <div class="inner-containerr">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='itemmm'>
                            <div class='cardmural'>
                                <img src='data:image/jpeg;base64," . base64_encode($row['imagenMural']) . "' alt='Imagen Mural' style='width: 100%; height: 100%; object-fit: cover;'>
                                <div class='card__content'>
                                    <p class='card__title'>{$row['titulo']}</p>
                                    <p class='card__description'>{$row['informacion']}</p>
                                </div>
                            </div>
                          </div>";
                }
            } else {
                    echo "<h1>No hay publicaciones en el mural.</h1>";
            }
            ?>
        </div>
    </div>
    <br>
    <br>
<!--====  End of html  ====-->
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
<script src="../js/script.js"></script>

</body>

</html>