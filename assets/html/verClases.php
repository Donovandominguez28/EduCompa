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
          <source src="../images/verClases.mp4" type="video/mp4">
        </video>
        <div class="container reveal">
          <div class="hero-content reveal">
            <p class="hero-subtitle" style="color: white;" >¡Prof.Son Goku!</p>
            <h2 class="h1 hero-title">Matematicas</h2>
           
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->

     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/nature.jpg')">
  <div class="container reveal">
      <div class="cta-content">
          <h2 class="h2 section-title">¡Contenido no disponible!</h2>
          <p class="section-text">
            No disponible
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

          
  <!-- 
    - ionicon link
  -->

</body>

</html>
