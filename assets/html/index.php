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
<div class=".body" ></div>
      <section class="hero reveal" id="home">
        <video autoplay muted loop id="bg-video">
          <source src="../images/videoFondo3.mp4" type="video/mp4">
        </video>
        <div class="container">
          <div class="hero-content">
            <p class="hero-subtitle reveal" style="color: white;" >¡Alcanza tus metas!</p>
            <?php if (isLoggedIn()) {
            echo '
            <h2 class="h1 hero-title reveal">¡Bienvenid@ ' . htmlspecialchars($usuario) . ' a EduCompa!</h2>
            ';
          }else{
          echo '
          <h2 class="h1 hero-title reveal">¡Bienvenid@ a EduCompa!</h2>
          ';
          } 
          ?>

            <p class="hero-text reveal">
              En nuestra red social educativa, creemos firmemente que cada estudiante tiene el potencial para alcanzar sus metas y sueños. Sabemos que el camino hacia el éxito académico puede estar lleno de desafíos, pero con las herramientas y el apoyo adecuados, todo es posible.
            </p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->
         <?php
// Check if the user is logged in
if (isLoggedIn()) {
    // Database connection (replace with your own connection details)
include '../php/conexion.php';
    // Query to get the top 3 students from the podio table
    $sql = "SELECT * FROM podio ORDER BY top ASC LIMIT 3";
    $result = $conn->query($sql);

    // Check if there are results
    if ($result->num_rows > 0) {
        echo '<section class="section section-divider white cta reveal" style="background-image: url(\'../images/fondoPodio2.jpg\')">
            <h1 class="h1 hero-title reveal" style="color: gold;">Podio de los mejores estudiantes</h1>
            <div class="containerp">';

        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Encode image to base64 if it's a BLOB
            $foto = $row['foto'];
            $fotoBase64 = base64_encode($foto);
            $fotoSrc = 'data:image/jpeg;base64,' . $fotoBase64;
            
            echo '<div class="colp">
                    <div class="cardp reveal">
                        <a href="#" class="card-thumb">
                            <img src="' . $fotoSrc . '" class="imgp" alt="Imagen de ' . htmlspecialchars($row['nombreApellido']) . '">
                            <div class="job-title">Top ' . htmlspecialchars($row['top']) . '</div>
                        </a>
                        <div class="card-content">
                            <h2>
                                <a href="#">' . htmlspecialchars($row['nombreApellido']) . '</a>
                            </h2>
                            <p>
                                <p href="#">' . htmlspecialchars($row['descripcion']) . '</p>
                            </p>
                            <div class="social-links">
                                <!-- Additional details can be placed here -->
                            </div>
                        </div>
                    </div>
                </div>';
        }

        echo '</div></section>';
    } else {
        echo '<section class="section section-divider white cta reveal" style="background-image: url(\'../images/fondoPodio2.jpg\')">
            <div class="containerp">
                <h1 class="h1 hero-title reveal" style="color: white;">No hay datos disponibles para mostrar en el podio.</h1>
            </div></section>';
    }

    // Close the connection
    $conn->close();
}
?>

<?php
include '../html/translate.php';
?>

     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/librito2.jpg')">
  <div class="container">
      <div class="cta-content">
          <h2 class="h2 section-title reveal">¡El Poder del Trabajo en Equipo!</h2>
          <p class="section-text reveal">
              En nuestra red social educativa, creemos que el trabajo en equipo es la clave para el éxito académico y personal. Sabemos que aprender juntos no solo hace el proceso más enriquecedor, sino que también fortalece las habilidades sociales y colaborativas que son esenciales para el futuro.
              <br><br>
              Juntos somos más fuertes. En nuestra plataforma, cada estudiante tiene algo valioso que aportar. Al compartir tus conocimientos y aprender de los demás, todos crecemos y mejoramos. Aquí, el esfuerzo colectivo supera cualquier desafío individual.
          </p>
      </div>
  </div>
</section>

<!-- Sección 2-->
<section class="section section-divider white cta reveal" style="background-image: url('../images/libros.jpg');">
  <div class="container">
      <div class="cta-content" style="float: right;">
          <h2 class="h2 section-title reveal">¡Exploración del Conocimiento!</h2>
          <p class="section-text reveal">
              En nuestra red social educativa, te invitamos a embarcarte en un viaje de descubrimiento y aprendizaje sin límites. La exploración del conocimiento es el corazón de nuestra comunidad, donde cada pregunta es una puerta hacia nuevas ideas y perspectivas.
              <br><br>
              Sumérgete en el mundo del aprendizaje. En nuestra plataforma, te ofrecemos un vasto océano de recursos y herramientas, listos para ser explorados. Desde artículos fascinantes hasta cursos interactivos, cada rincón está lleno de oportunidades para expandir tu mente y enriquecer tu vida académica.
          </p>
      </div>
  </div>
</section>

<!-- Sección 3 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/educacion5.jpg ');">
  <div class="container">
      <div class="cta-content" style="float: left;">
          <h2 class="h2 section-title reveal">¡Innovación Educativa!</h2>
          <p class="section-text reveal">
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
  
<?php include '../html/footer.php'; ?>
<?php 
include '../html/changesMode.php';
?>
          
  <!-- 
    - ionicon link
  -->

</body>

</html>
