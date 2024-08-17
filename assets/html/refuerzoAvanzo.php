<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
?>
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

  <?php include '../html/navBar.php'; ?>



  
  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero reveal" id="home">
        <video autoplay muted loop id="bg-video">
          <source src="../images/refuerzo.mp4" type="video/mp4">
        </video>
        <div class="container reveal">
          <div class="hero-content reveal">
            <p class="hero-subtitle" style="color: white;" >¡Refuerza tus conocimientos!</p>
            <h2 class="h1 hero-title">¡Refuerzo prueba Avanzo!</h2>
            <p class="hero-text">
              ¡Prepárate para la 
              prueba Avanzo con nuestro 
              módulo de refuerzo! Diseñado 
              para fortalecer tus conocimientos 
              en Lenguaje, Matemáticas, Ciencias
               y Sociales, este programa te ofrece 
               ejercicios prácticos y simulacros de 
               examen. Con Refuerzo Avanzo, estarás 
               listo para enfrentar cualquier desafío académico. 
               ¡Empieza hoy!
              </p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->

     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/fondoAzul2.jpg')">
    <div class="wrapperavanzo reveal">
      <h1 class="h1 hero-title" style="color: white;"  >Pruebas Avanzo</h1>
      <br>
      <br>
        <div class="containeravanzo">
            <input type="radio" name="slide" id="c1" checked>
            <label for="c1" class="cardavanzo">
                <div class="rowavanzo">
                    <div class="iconnn">M</div>
                    <div class="descriptionavanzo">
                        <h4>Matemáticas</h4>
                        <p>Descubre la belleza de los números y las ecuaciones.</p>
                        <a href="../html/avanzoMate.php">Realiza la prueba</a>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c2">
            <label for="c2" class="cardavanzo">
                <div class="rowavanzo">
                    <div class="iconnn">L</div>
                    <div class="descriptionavanzo">
                        <h4>Lenguaje</h4>
                        <p>Explora el arte de la comunicación y la literatura.</p>
                        <a href="../html/avanzoLenguaje.php">Realiza la prueba</a>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c3">
            <label for="c3" class="cardavanzo">
                <div class="rowavanzo">
                    <div class="iconnn">S</div>
                    <div class="descriptionavanzo">
                        <h4>Sociales</h4>
                        <p>Comprende la historia y la sociedad que nos rodea.</p>
                        <a href="../html/avanzoSocales.php">Realiza la prueba</a>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c4">
            <label for="c4" class="cardavanzo">
                <div class="rowavanzo">
                    <div class="iconnn">C</div>
                    <div class="descriptionavanzo">
                        <h4>Ciencias</h4>
                        <p>Investiga los fenómenos naturales y sus leyes.</p>
                        <a href="../html/avanzoCiencias.php">Realiza la prueba</a>
                    </div>
                </div>
            </label>
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

          
  <!-- 
    - ionicon link
  -->

</body>

</html>
