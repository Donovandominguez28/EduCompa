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
  <link rel="stylesheet" href="../css/adivinaLetra.css">
  <link rel="stylesheet" href="../css/notificaciones.css">

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
        <section class="reveal">
            <div id="contenedor-toast"></div>
            <h2>Adivina la Palabra</h2>
            <div id="palabra">
                <div class="letra pintar">G</div>
                <div class="letra">U</div>
                <div class="letra">I</div>
                <div class="letra">T</div>
                <div class="letra">A</div>
                <div class="letra">R</div>
                <div class="letra">R</div>
                <div class="letra">A</div>
            </div>
            <h3>Ayuda: <span id="ayuda"> Instrumento Musical</span> </h3>
            <h3>Intentos restantes: <span id="intentos">5</span></h3>
            <h3>Letras ingresadas: <span id="letrasIngresadas"></span></h3>
    
            <button class="buttonnn" onclick="cargarNuevaPalabra()">Nueva Palabra</button>
            <br>
            <br> 
            <div id="letras"></div>
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
  <script src="../js/adivinaLetra.js" defer></script>
  <br>
  <br>
  <br>
  <?php include '../html/footer.php'; ?>
  <?php 
include '../html/changesMode.php';
?>
          
  <!-- 
    - ionicon link
  -->

</body>

</html>
