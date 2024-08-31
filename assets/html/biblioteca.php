<?php
include '../php/session_check2.php'; // Check if the user is logged in
include '../php/conexion.php'; // Database connection

// Assume you have a user ID stored in session
$carnet = $_SESSION['carnet']; // This should be the user ID from the session

// Query to fetch books assigned to the user
$sql = "SELECT b.titulo, b.descripcion, b.libroimg, b.link
        FROM biblioteca b
        WHERE b.carnet6 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $carnet);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduCompa</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body id="top">

  <?php include '../html/navBar.php'; ?>

  <main>
    <article>
      <section class="hero reveal" id="home">
        <video autoplay muted loop id="bg-video">
          <source src="../images/bibliotecaFondo.mp4" type="video/mp4">
        </video>
        <div class="container">
          <div class="hero-content">
            <p class="hero-subtitle reveal" style="color: white;">¡El maravilloso mundo de la literatura!</p>
            <h2 class="h1 hero-title reveal">¡Biblioteca EduCompa!</h2>
            <p class="hero-text reveal">
              La lectura es una puerta abierta a mundos infinitos. 
              A través de los libros, podemos viajar en el tiempo, 
              explorar tierras desconocidas y sumergirnos en las
              mentes de personajes fascinantes. La lectura no 
              solo enriquece nuestro vocabulario y nos brinda 
              conocimiento, sino que también nos permite 
              comprender diferentes perspectivas y culturas.
            </p>
          </div>
        </div>
      </section>

      <section class="section section-divider white cta reveal" style="background-image: url('../images/estantes2.jpg')">
        <h1 class="h1 hero-title reveal" style="color: white;">Libros disponibles:</h1>
        <br>
        <br>
        <div class="wrapper reveal">
          <?php if ($result->num_rows > 0): ?>
              <?php
              while ($row = $result->fetch_assoc()) {
                  echo '  <div class="card reveal">';
                  echo '    <img src="data:image/jpeg;base64,' . base64_encode($row['libroimg']) . '" alt="' . htmlspecialchars($row['titulo']) . '">';
                  echo '    <div class="info">';
                  echo '      <h1>' . htmlspecialchars($row['titulo']) . '</h1>';
                  echo '      <p>' . htmlspecialchars($row['descripcion']) . '</p>';
                  echo '      <a href="' . htmlspecialchars($row['link']) . '" class="btnn">Leer Más</a>';
                  echo '    </div>';
                  echo '  </div>';
              }
              ?>
          <?php else: ?>
            <h1>No hay libros disponibles</h1>
          <?php endif; ?>
        </div>
      </section>
    </article>
  </main>

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="../js/script.js" defer></script>
  
  <?php include '../html/footer.php'; ?>
  <?php 
include '../html/changesMode.php';
?>
  
</body>
</html>
