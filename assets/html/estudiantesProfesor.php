<?php
include "../php/session_check4.php";
include '../php/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Estudiantes</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

    <!-- Barra de navegación -->
    <?php include "../html/navBarProfesor.php"; ?>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Tabla CRUD -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="bi bi-table"></i>Listado de estudiantes</h2>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre Completo</th>
                    <th>Foto de Perfil</th>
                    <th>Año Bachillerato</th>
                    <th>Sección</th>
                    <th>Especialidad</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../php/conexion.php';
            $sql = "SELECT * FROM estudiantes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['carnet'] . "</td>";
                    echo "<td>" . $row['nombreCompleto'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['fotoPerfil']) . "' alt='Foto de Perfil' width='100'></td>";
                    echo "<td>" . $row['añoBachi'] . "</td>";
                    echo "<td>" . $row['seccion'] . "</td>";
                    echo "<td>" . $row['especialidad'] . "</td>";
                }
            } else {
                echo "<tr><td colspan='10'>No hay estudiantes registrados.</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
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
