<?php include "../php/session_check.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduCompa</title>
  <!-- 
    - favicon
  -->
  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">    

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

<?php
include '../html/navBar.php';
?>


  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero reveal" id="home">
        <video autoplay muted loop id="bg-video">
          <source src="../images/videoFondo3.mp4" type="video/mp4">
        </video>
        <div class="container reveal">
          <div class="hero-content reveal">
            <p class="hero-subtitle" style="color: white;" >¡Alcanza tus metas!</p>
            <h2 class="h1 hero-title">¡Bienvenid@ usuario a EduCompa!</h2>
            <p class="hero-text">
              En nuestra red social educativa, creemos firmemente que cada estudiante tiene el potencial para alcanzar sus metas y sueños. Sabemos que el camino hacia el éxito académico puede estar lleno de desafíos, pero con las herramientas y el apoyo adecuados, todo es posible.
            </p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->
         <?php if (isLoggedIn()) {
    echo '<section class="section section-divider white cta reveal" style="background-image: url(\'../images/fondoPodio2.jpg\')">
        <h1 class="h1 hero-title" style="color: gold;">Podio de los mejores estudiantes</h1>
        <div class="containerp reveal">
            <div class="colp">
                <div class="cardp">
                    <a href="#" class="card-thumb">
                        <img src="../images/maria.jpg" class="imgp" alt="Imagen de Laura Sánchez">
                        <div class="job-title">Top 1 - Matemáticas</div>
                    </a>
                    <div class="card-content">
                        <h2>
                            <a href="#">Laura Sánchez</a>
                        </h2>
                        <p>
                            Laura ha demostrado un talento excepcional en matemáticas, alcanzando el primer lugar en el podio de la Olimpiada Nacional de Matemáticas. Su capacidad para resolver problemas complejos y su dedicación la han convertido en una referente para sus compañeros.
                        </p>
                        <div class="social-links">
                            Laura es conocida por su pasión por los números y su voluntad de ayudar a otros a entender conceptos difíciles. Planea estudiar Ingeniería en el futuro para continuar desarrollando sus habilidades analíticas.
                        </div>
                    </div>
                </div>
            </div>
            <div class="colp">
                <div class="cardp">
                    <a href="#" class="card-thumb">
                        <img src="../images/juan.jpg" class="imgp" alt="Imagen de Miguel Pérez">
                        <div class="job-title">Top 2 - Ciencias</div>
                    </a>
                    <div class="card-content">
                        <h2>
                            <a href="#">Miguel Pérez</a>
                        </h2>
                        <p>
                            Miguel obtuvo el segundo lugar en la competencia de Ciencias a nivel nacional, destacándose por su profundo entendimiento de la biología y la química. Su enfoque meticuloso en el estudio y su curiosidad natural lo han hecho sobresalir en su campo.
                        </p>
                        <div class="social-links">
                            Además de su éxito en ciencias, Miguel es un estudiante que inspira a otros con su ética de trabajo y su amor por el aprendizaje. Planea seguir una carrera en Medicina, combinando su pasión por la ciencia con su deseo de ayudar a los demás.
                        </div>
                    </div>
                </div>
            </div>
            <div class="colp">
                <div class="cardp">
                    <a href="#" class="card-thumb">
                        <img src="../images/maria2.jpg" class="imgp" alt="Imagen de María González">
                        <div class="job-title">Top 3 - Literatura</div>
                    </a>
                    <div class="card-content">
                        <h2>
                            <a href="#">María González</a>
                        </h2>
                        <p>
                            María alcanzó el tercer lugar en el certamen de Literatura, siendo reconocida por su creatividad y profundidad en la escritura. Sus ensayos y relatos han capturado la atención de profesores y estudiantes por igual.
                        </p>
                        <div class="social-links">
                            María es una lectora ávida y escritora talentosa que aspira a estudiar Letras en la universidad. Su habilidad para expresar ideas de manera clara y conmovedora la ha convertido en una figura inspiradora dentro de su comunidad estudiantil.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>';
} ?>

       
     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/librito2.jpg')">
  <div class="container reveal">
      <div class="cta-content">
          <h2 class="h2 section-title">¡El Poder del Trabajo en Equipo!</h2>
          <p class="section-text">
              En nuestra red social educativa, creemos que el trabajo en equipo es la clave para el éxito académico y personal. Sabemos que aprender juntos no solo hace el proceso más enriquecedor, sino que también fortalece las habilidades sociales y colaborativas que son esenciales para el futuro.
              <br><br>
              Juntos somos más fuertes. En nuestra plataforma, cada estudiante tiene algo valioso que aportar. Al compartir tus conocimientos y aprender de los demás, todos crecemos y mejoramos. Aquí, el esfuerzo colectivo supera cualquier desafío individual.
          </p>
      </div>
  </div>
</section>

<!-- Sección 2-->
<section class="section section-divider white cta reveal" style="background-image: url('../images/libros.jpg');">
  <div class="container reveal">
      <div class="cta-content" style="float: right;">
          <h2 class="h2 section-title">¡Exploración del Conocimiento!</h2>
          <p class="section-text">
              En nuestra red social educativa, te invitamos a embarcarte en un viaje de descubrimiento y aprendizaje sin límites. La exploración del conocimiento es el corazón de nuestra comunidad, donde cada pregunta es una puerta hacia nuevas ideas y perspectivas.
              <br><br>
              Sumérgete en el mundo del aprendizaje. En nuestra plataforma, te ofrecemos un vasto océano de recursos y herramientas, listos para ser explorados. Desde artículos fascinantes hasta cursos interactivos, cada rincón está lleno de oportunidades para expandir tu mente y enriquecer tu vida académica.
          </p>
      </div>
  </div>
</section>

<!-- Sección 3 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/educacion.jpg ');">
  <div class="container reveal">
      <div class="cta-content" style="float: left;">
          <h2 class="h2 section-title">¡Innovación Educativa!</h2>
          <p class="section-text">
              En nuestra red social educativa, fomentamos la innovación como motor del aprendizaje. Creemos en la capacidad de cada estudiante para generar ideas creativas y soluciones ingeniosas a los retos académicos y personales.
              <br><br>
              Nuestro compromiso es proporcionar un entorno donde la imaginación pueda florecer. Ofrecemos herramientas y recursos para que cada estudiante pueda experimentar y descubrir nuevas formas de aprender, enseñar y crecer. Aquí, la innovación no tiene límites y cada idea cuenta.
          </p>
      </div>
  </div>
</section>

      

    </article>
  </main>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to topx" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>

  <!-- 
    - custom js link
  -->
  <script src="../js/script.js" defer></script>
  
  <footer class="footer-distributed reveal">
    <div class="footer-left">
      <img src="../images/educompalogo.jpg" alt="" class="footer-logo">
      <p class="footer-links">
            <a href="../html/index.html"><i class="bi bi-house">Inicio</i></a>
            |
            <a href="../html/perfilUsuario.html"><i class="bi bi-people">Perfil</i></a>
            |
            <a href="#"><i class="bi bi-backpack3">Aula Virtual</i></a>
            |
            <br>
            <a href="#"><i class="bi bi-book">Biblioteca</i></a>
            |
            <a href="#"><i class="bi bi-chat-dots-fill">Chat</i></a>
            |
            <a href="../html/Juegos.html"><i class="bi bi-controller">Juegos</i></a>
            |
            <br>
            <a href="#"><i class="bi bi-pen">Refuerzo Avanzo</i></a>
        </p>

        <p class="footer-company-name">Copyright © 2024 <strong>EduCompa</strong> All rights reserved</p>
    </div>

    <div class="footer-center">
        <div>
            <i class="bi bi-map"></i>
            <p>Colegio Don Bosco</p>
        </div>

        <div>
            <i class="bi bi-phone"></i>
            <p>503 7681-4348</p>
        </div>
        <div>
            <i class="bi bi-envelope"></i>  
            <p><a href="">estudiante20230698@cdb.edu.sv
            </a></p>
        </div>
    </div>
    <div class="footer-right">
        <p class="footer-company-about">
            <span>Sobre Nosotros</span>
            <strong>EduCompa</strong>
            Es nuestra plataforma educativa
        </p>
        <div class="footer-icons">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
        </div>
    </div>
</footer>
          
  <!-- 
    - ionicon link
  -->

</body>

</html>
