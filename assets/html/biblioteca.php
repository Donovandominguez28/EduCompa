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
          <source src="../images/bibliotecaFondo.mp4" type="video/mp4">
        </video>
        <div class="container reveal">
          <div class="hero-content reveal">
            <p class="hero-subtitle" style="color: white;" >¡El maravilloso mundo de la literatura!</p>
            <h2 class="h1 hero-title">¡Biblioteca EduCompa!</h2>
            <p class="hero-text">
                La lectura es una puerta abierta a mundos infinitos. 
                A través de los libros, podemos viajar en el tiempo, 
                explorar tierras desconocidas y sumergirnos en las
                 mentes de personajes fascinantes. La lectura no 
                 solo enriquece nuestro vocabulario y nos brinda 
                 conocimiento, sino que también nos permite 
                 comprender diferentes perspectivas y culturas.</p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->

     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/estantes2.jpg')">
  <h1 class="h1 hero-title " style="color: white;">Libros disponibles:</h1>
<br>
<br>
<div class="wrapper reveal">
	<div class="card reveal">
		<img src="../images/portadaCienAñosSoledad.jpg" alt="">
		<div class="info">
			<h1>Cien años de soledad</h1>
			<p>La obra maestra de Gabriel García Márquez que narra la historia de la familia Buendía a lo largo de varias generaciones en el pueblo ficticio de Macondo.</p>
			<a href="#" class="btnn">Leer Más</a>
		</div>
	</div>
	<div class="card reveal">
		<img src="../images/donQuijote.jpg" alt="">
		<div class="info">
			<h1>Don Quijote de la Mancha</h1>
			<p>La novela de Miguel de Cervantes que cuenta las aventuras del ingenioso hidalgo Don Quijote y su fiel escudero Sancho Panza.</p>
			<a href="#" class="btnn">Leer Más</a>
		</div>
	</div>
	<div class="card reveal">
		<img src="../images/casaEspiritus.jpg" alt="">
		<div class="info">
			<h1>La casa de los espíritus</h1>
			<p>Isabel Allende nos ofrece una saga familiar que mezcla realismo mágico con la historia de Chile, narrando la vida de la familia Trueba.</p>
			<a href="#" class="btnn">Leer Más</a>
		</div>
	</div>
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
