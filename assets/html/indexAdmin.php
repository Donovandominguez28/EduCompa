<?php include "../php/session_check3.php"; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

<?php include "../html/navBarAdmin.php"; ?>

  <!-- Contenedor principal -->
  <div class="container mt-5">
  <h1>Bienvenido Administrador</h1>
  <p>El administrador es responsable de las 
    operaciones CRUD (Crear, Leer, Actualizar, Eliminar) 
    dentro de la plataforma. Estas tareas incluyen la 
    creación de nuevos perfiles de usuarios y contenido 
    educativo, la lectura y supervisión de datos y 
    estadísticas de uso, la actualización de información
     y recursos, y la eliminación de datos obsoletos 
     o incorrectos.</p>
     <br>
 <p>Además, el administrador 
    asegura el correcto funcionamiento 
    de la plataforma, maneja problemas 
    técnicos, implementa mejoras y garantiza 
    la seguridad y privacidad de los datos de 
    los usuarios. Su objetivo principal es 
    facilitar una experiencia educativa efectiva 
    y segura para los estudiantes y las 
    instituciones que utilizan EduCompa.</p>
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
