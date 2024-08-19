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

<style>
  .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* Espacio entre las tarjetas */
    justify-content: center; /* Centrar las tarjetas */
}

.card__containeraula {
    flex: 1 1 calc(33.333% - 1rem); /* 3 tarjetas por fila con espacio entre ellas */
    box-sizing: border-box;
    margin-bottom: 1rem; /* Espacio debajo de las tarjetas */
}

.card__articleaula {
    padding: 1rem;
    border-radius: 0.5rem;
}

.card__buttonaula {
    display: block;
    text-align: center;
    margin-top: 0.5rem;
    text-decoration: none;
    color: white;
    padding: 0.5rem;
    border-radius: 0.25rem;
}
/* Estilo para el contenedor de tarjetas */
.card-container {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem; /* Espacio entre las tarjetas */
  justify-content: center; /* Centrar las tarjetas */
}

/* Estilo para las tarjetas individuales */
.card__containeraula {
  flex: 1 1 calc(33.333% - 1rem); /* 3 tarjetas por fila con espacio entre ellas */
  box-sizing: border-box;
  margin-bottom: 1rem; /* Espacio debajo de las tarjetas */
}

/* Estilo para el artículo de la tarjeta */
.card__articleaula {
  padding: 1rem;
  border-radius: 0.5rem;
  background: rgba(0, 0, 0, 0.6); /* Fondo oscuro para mejor legibilidad */
  color: white; /* Color del texto */
}

/* Estilo para el botón de la tarjeta */
.card__buttonaula {
  display: block;
  text-align: center;
  margin-top: 0.5rem;
  text-decoration: none;
  color: white;
  padding: 0.5rem;
  border-radius: 0.25rem;
  background-color: #007bff; /* Color del botón */
}


</style>
      <!-- 
        - #CTA
         -->

         <section class="section section-divider white cta reveal" style="background-image: url('../images/clases3.jpg')">
  <div class="containeraula">
    <?php
    include '../php/conexion.php';

    // Consulta para obtener todas las clases
    $sql = "SELECT * FROM clases where carnet7 = ?";
    $result = $conn->query($sql);

    if ($result) {
        echo '<h1 class="h1 hero-title reveal" style="color: white;">Clases disponibles:</h1>';
        echo '<div class="card-container">'; // Contenedor para las tarjetas
        while ($row = $result->fetch_assoc()) {
            $idClase = $row['idClase'];
            $imagenClase = $row['imagenClase'];
            $materia = $row['materia'];
            $nombreProfesor = $row['nombreProfesor'];
            //$fotoProfesor = $row['fotoProfesor'];

            // Convertir la imagen de la clase a base64 para embebido en HTML
            $imagenClaseBase64 = base64_encode($imagenClase);
            $imagenClaseSrc = "data:image/jpeg;base64," . $imagenClaseBase64;

            // Verificar si el profesor tiene una foto de perfil; si no, usar la predeterminada
            /*if ($fotoProfesor) {
                $fotoProfesorBase64 = base64_encode($fotoProfesor);
                $fotoProfesorSrc = "data:image/jpeg;base64," . $fotoProfesorBase64;
            } else {
                $fotoProfesorSrc = "../images/gokuuu.png"; // Imagen predeterminada
            }*/

            echo '<div class="card__containeraula">';
            echo '   <article class="card__articleaula">';
            echo '<br>';
            echo '      <img src="../images/cohete2.png" alt="profile picture" class="card__imgaula" ">';
            echo '      <div class="card__dataaula">';
            echo '         <h3 class="card__titleaula" style="font-size: 15px;">' . htmlspecialchars($materia) . '</h3>';
            echo '         <span class="card__priceaula" style="font-size: 15px;">Prof. ' . htmlspecialchars($nombreProfesor) . '</span>';
            echo '      </div>';
            echo '      <img src="' . $imagenClaseSrc . '" alt="class background" class="card__bgaula">';
            echo '<a href="../html/verClases.php?idClase=' . $idClase . '" class="card__buttonaula" style="font-size: 12px;">';
            echo '   Revisar Clase <i class="bi bi-arrow-right"></i>';
            echo '</a>';
            echo '   </article>';
            echo '</div>';
        }
        echo '</div>'; // Cerrar contenedor de tarjetas
    } else {
        echo '<h1 class="h1 hero-title reveal" style="color: white;">No se encontraron clases disponibles.</h1>';
    }

    // Cerrar la conexión
    $conn->close();
    ?>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  
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
