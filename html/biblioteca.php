<?php
include "../php/datos_usuario.php";


?>



<!doctype html>
<html lang="en" data-bs-theme="auto">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Biblioteca</title>


    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../img/educompalogo.jpg" type="image/x-icon">
<link rel="stylesheet" href="../css/sidebar2.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">


  </head>
  <body>
  <?php
include "../html/sidebar.php";
?>
<main class="bodypage">

  <section class="library-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto text-center">
                <h1 class="tit">Biblioteca EduCompa</h1>
                <p class="subtit">Sumérgete en un mundo de maravillas literarias, 
                  donde cada libro es un tesoro esperando ser descubierto. 
                  En nuestra biblioteca, las palabras cobran vida y 
                  los sueños se hacen realidad.
                </p>
            </div>
        </div>
    </div>
</section>
<br><br><br>
<!-- <div class="input-container">
 <input type="text" name="text" class="inputsearch" placeholder="Busca el libro que necesites...">
<svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24" class="iconm"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <rect fill="white" height="24" width="24"></rect> <path fill="" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM9 11.5C9 10.1193 10.1193 9 11.5 9C12.8807 9 14 10.1193 14 11.5C14 12.8807 12.8807 14 11.5 14C10.1193 14 9 12.8807 9 11.5ZM11.5 7C9.01472 7 7 9.01472 7 11.5C7 13.9853 9.01472 16 11.5 16C12.3805 16 13.202 15.7471 13.8957 15.31L15.2929 16.7071C15.6834 17.0976 16.3166 17.0976 16.7071 16.7071C17.0976 16.3166 17.0976 15.6834 16.7071 15.2929L15.31 13.8957C15.7471 13.202 16 12.3805 16 11.5C16 9.01472 13.9853 7 11.5 7Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
  </div>
<hr class="featurette-divider">
<br>
-->


<div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php include '../php/mostrar_libro.php'; ?>
            </div>
        </div>
    </div>

</main>

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
<script src="../js/script.js">
</script>

    </body>
</html>
