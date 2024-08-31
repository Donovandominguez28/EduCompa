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
  <?php
  include '../html/changesmode2.php';
  ?>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/scriptAdmin.js"></script>
</body>
</html>
