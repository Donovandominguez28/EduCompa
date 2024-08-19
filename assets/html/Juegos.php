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
          <source src="../images/juegosFondo.mp4" type="video/mp4">
        </video>
        <div class="container">
        
          <div class="hero-content">
            <p class="hero-subtitle reveal" style="color: white;" >¡Explora y Juega!</p>
            <h2 class="h1 hero-title reveal">¡Juegos EduCompa!</h2>
            <p class="hero-text reveal">
              Sumérgete en un mundo de diversión educativa con nuestros 
              juegos clásicos. ¡Desafía tus habilidades y aprende jugando!
            </p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
      -->

      <!-- Sección 1 -->
      <section class="section section-divider white cta reveal" style="background-image: url('../images/fondoAzul.jpg')">
        <h1 class="h1 hero-title reveal " style="color: white;">Juegos disponibles:</h1>
        <div class="cardj reveal">
          <img src="../images/chess.jpg" alt="Juego de Ajedrez">
          <div>
            <h2>Ajedrez Clásico</h2>
            <h3>Tipo: Juego de Estrategia</h3>
            <p>
              Pon a prueba tu mente y mejora tus habilidades estratégicas con nuestro juego de ajedrez clásico. Ideal para todos los niveles, desde principiantes hasta maestros.
            </p>
            <a href="../html/chess.php">¡Juega ahora!</a>
          </div>
        </div>
        <div class="cardj reveal">
          <img src="../images/letras.jpg" alt="Adivina la Letra">
          <div>
            <h2>Adivina la Letra</h2>
            <h3>Tipo: Juego Educativo</h3>
            <p>
              Mejora tu vocabulario y ortografía con nuestro juego de "Adivina la Letra". Un divertido desafío para todas las edades.
            </p>
            <a href="../html/adivinaLetra.php">¡Juega ahora!</a>
          </div>
        </div>
      </section>

    </article>
  </main>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>

  <!-- 
    - custom js link
  -->
  <script src="../js/script.js" defer></script>
  
  <?php include '../html/footer.php'; ?>


</body>

</html>
