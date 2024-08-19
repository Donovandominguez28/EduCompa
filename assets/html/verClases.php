<?php
include '../php/session_check2.php';
include '../php/conexion.php';

// Inicializar variables por defecto
$nombreProfesor = 'Profesor no disponible';
$materia = 'Materia no disponible';
$descripcion = 'Descripción no disponible';

// Obtener el ID de la clase desde la URL
if (isset($_GET['idClase']) && is_numeric($_GET['idClase'])) {
    $idClase = intval($_GET['idClase']); // Convertir a entero para mayor seguridad
    
    // Consulta para obtener los datos de la clase
    $sql = "SELECT nombreProfesor, materia, descripcion FROM clases WHERE idClase = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idClase);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $nombreProfesor = $row['nombreProfesor'];
        $materia = $row['materia'];
        $descripcion = $row['descripcion'];
    }
    
    $stmt->close();
}
$conn->close();
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
          <source src="../images/verClases.mp4" type="video/mp4">
        </video>
        <div class="container">
          <div class="hero-content">
            <p class="hero-subtitle reveal" style="color: white;">Prof. <?php echo htmlspecialchars($nombreProfesor); ?></p>
            <h2 class="h1 hero-title reveal"><?php echo htmlspecialchars($materia); ?></h2>
            <p class="hero-text reveal"><?php echo htmlspecialchars($descripcion); ?></p>
          </div>
        </div>
      </section>

      <section class="section section-divider white cta reveal" style="background-image: url('../images/nature.jpg')">
        <div class="container reveal">
            <div class="cta-content">
                <h2 class="h2 section-title">¡Contenido no disponible!</h2>
                <p class="section-text">No disponible</p>
            </div>
        </div>
      </section>

    </article>
  </main>

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>
  <script src="../js/script.js" defer></script>
  <?php include '../html/footer.php'; ?>

</body>
</html>
