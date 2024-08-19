<?php include "../php/session_check4.php"; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profesor</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

<?php include "../html/navBarProfesor.php"; ?>

  <!-- Contenedor principal -->
  <div class="container mt-5">
  <h1>Bienvenido Profesor</h1>
  <p>El profesor es responsable de la 
    gestión y entrega del contenido educativo 
    dentro de la plataforma. Estas tareas incluyen 
    la creación y actualización de clases, la carga 
    de materiales didácticos, y la evaluación y 
    seguimiento del progreso de los estudiantes.</p>
     <br>
 <p>Además, el profesor desempeña un 
    papel crucial en garantizar que los estudiantes 
    reciban una educación de calidad, adaptando 
    las metodologías de enseñanza a las necesidades 
    individuales y grupales, y asegurando que los 
    recursos y actividades sean accesibles y efectivos. 
    Su objetivo principal es facilitar un entorno de 
    aprendizaje dinámico y enriquecedor que promueva 
    el éxito académico de los estudiantes en EduCompa.</p>
</div>
  </div>

  <!-- Botón flotante para cambiar modo -->
  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btnFloat btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
      <i class="bi bi-circle-half"></i> <!-- Usar ícono de Bootstrap para modo automático -->
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
          <i class="bi bi-sun"></i>
          Claro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
          <i class="bi bi-moon"></i> <!-- Usar ícono de Bootstrap para modo oscuro -->
          Oscuro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
          <i class="bi bi-circle-half"></i> <!-- Usar ícono de Bootstrap para modo automático -->
          Automático
        </button>
      </li>
    </ul>
  </div>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/scriptAdmin.js"></script>
</body>
</html>
