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

</head>

<body id="#top">

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
          <source src="../images/aulaVirtual.mp4" type="video/mp4">
        </video>
        <div class="container">
          <div class="hero-content">
            <p class="hero-subtitle reveal" style="color: white;" >¡Gestiona tus clases!</p>
            <h2 class="h1 hero-title reveal">¡Aula Virtual!</h2>
            <p class="hero-text reveal">
              ¡Bienvenido al Aula Virtual! 
              Aquí puedes acceder a tus clases, 
              participar en discusiones y 
              realizar tareas, todo en un solo 
              lugar. Navegar es fácil e intuitivo, 
              permitiéndote concentrarte en aprender 
              y crecer. ¡Explora y descubre lo que puedes 
              lograr con nuestra aula virtual!
      
              </p>
          </div>
        </div>
      </section>

      <!-- 
        - #CTA
         -->

     <!-- Sección 1 -->
<section class="section section-divider white cta reveal" style="background-image: url('../images/clases3.jpg')">
    <div class="containeraula">
      <?php
include '../php/conexion.php';

// Fetch classes from the database
$sql = "SELECT c.*
        FROM clases c
        LEFT JOIN estudiantes e ON c.carnet7 = e.carnet";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo'<h1 class="h1 hero-title reveal" style="color: white;">Clases disponibles:</h1>';
    while ($row = $result->fetch_assoc()) {
        $idClase = $row['idClase'];
        $imagenClase = $row['imagenClase'];
        $materia = $row['materia'];
        $nombreProfesor = $row['nombreProfesor'];

        // Convert the BLOB image data to base64 for embedding in HTML
        $imagenClaseBase64 = base64_encode($imagenClase);
        $imagenClaseSrc = "data:image/jpeg;base64," . $imagenClaseBase64;

        echo '<div class="card__containeraula reveal">';
        echo '   <article class="card__articleaula">';
        echo '      <img src="../images/userrr.png" alt="profile picture" class="card__imgaula" style="border-radius:50%;">';
        echo '      <div class="card__dataaula">';
        echo '         <h3 class="card__titleaula" style="color: white; font-size: 15px;">' . htmlspecialchars($materia) . '</h3>';
        echo '         <span class="card__priceaula" style="color: white; font-size: 15px;">Prof. ' . htmlspecialchars($nombreProfesor) . '</span>';
        echo '      </div>';
        echo '      <img src="' . $imagenClaseSrc . '" alt="class background" class="card__bgaula">';
        echo '<a href="../html/verClases.php?idClase=' . $idClase . '" class="card__buttonaula" style="color: black; font-size: 12px;">';
echo '   Revisar Clase <i class="bi bi-arrow-right"></i>';
echo '</a>';

        echo '   </article>';
        echo '</div>';
    }
} else {
    echo '<h1 class="h1 hero-title reveal" style="color: white;">No se encontraron clases disponibles.</h1>';
}

$conn->close();
?>

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
  
<?php include "../html/footer.php"?>

</body>

</html>
