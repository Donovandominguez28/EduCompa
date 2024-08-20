<?php
include '../php/session_check2.php';
include '../php/conexion.php';

// Inicializar variables por defecto
$nombreProfesor = 'Profesor no disponible';
$materia = 'Materia no disponible';
$descripcion = 'Descripción no disponible';
$tituloClase = 'Título no disponible';
$contenidos = [];

// Obtener el ID de la clase desde la URL
if (isset($_GET['idClase']) && is_numeric($_GET['idClase'])) {
    $idClase = intval($_GET['idClase']); // Convertir a entero para mayor seguridad
    
    // Consulta para obtener los datos de la clase
    $sqlClase = "SELECT nombreProfesor, materia, descripcion, titulo FROM clases WHERE idClase = ?";
    $stmtClase = $conn->prepare($sqlClase);
    $stmtClase->bind_param("i", $idClase);
    $stmtClase->execute();
    $resultClase = $stmtClase->get_result();
    
    if ($rowClase = $resultClase->fetch_assoc()) {
        $nombreProfesor = $rowClase['nombreProfesor'];
        $materia = $rowClase['materia'];
        $descripcion = $rowClase['descripcion'];
        $tituloClase = $rowClase['titulo'];
    }
    
    $stmtClase->close();

    // Consulta para obtener el contenido de la clase
    $sqlContenido = "SELECT titulo, contenido, multimedia, link FROM contenidoclases WHERE idClase2 = ?";
    $stmtContenido = $conn->prepare($sqlContenido);
    $stmtContenido->bind_param("i", $idClase);
    $stmtContenido->execute();
    $resultContenido = $stmtContenido->get_result();
    
    while ($rowContenido = $resultContenido->fetch_assoc()) {
        $contenidos[] = $rowContenido; // Almacenar cada contenido en el array
    }
    
    $stmtContenido->close();
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
            <p class="h1 hero-title reveal  "><?php echo htmlspecialchars($tituloClase); ?></p>
          <br>
            <h2 class="h1 hero-title reveal"><?php echo htmlspecialchars($materia); ?></h2>
            <p class="hero-text reveal"><?php echo htmlspecialchars($descripcion); ?></p>
          </div>
        </div>
      </section>
      


      <section class="section section-divider white cta reveal" style="background-image: url('../images/fondodark.jpg')">
        <div class="container reveal">
            <div class="cta-content">
                <?php if (!empty($contenidos)) { ?>
            <?php foreach ($contenidos as $contenido) { ?>
              <div class="content-item">
                <h3 class="h1 hero-title reveal"><?php echo htmlspecialchars($contenido['titulo']); ?></h3>
                <p class="hero-text reveal"><?php echo htmlspecialchars($contenido['contenido']); ?></p>
                
                <?php if ($contenido['multimedia']) { ?>
                  <div class="content-media">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($contenido['multimedia']); ?>" alt="Multimedia" style="max-width: 400px;">
                  </div>
                <?php } ?>
                
                <?php if (!empty($contenido['link'])) { ?>
                  <p class="hero-text reveal"><a href="<?php echo htmlspecialchars($contenido['link']); ?>" target="_blank"><?php echo htmlspecialchars($contenido['link']); ?></a></p>
                <?php } ?>
              </div>
            <?php } ?>
          <?php } else { ?>
            <h1 class="hero-text reveal">No hay contenido disponible para esta clase.</p>
          <?php } ?>
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
