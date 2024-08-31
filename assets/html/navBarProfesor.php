<?php
include "../php/conexion.php";
// Verificar si el profesor ha iniciado sesión
if (isset($_SESSION['idProfesor'])) {
    $idProfesor = $_SESSION['idProfesor'];

    // Obtener la información del profesor desde la base de datos
    $sql = "SELECT nombreCompleto, fotoPerfil FROM profesor WHERE idProfesor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProfesor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreProfesor = $row['nombreCompleto'];
        $fotoPerfil = $row['fotoPerfil'] ? base64_encode($row['fotoPerfil']) : null;
    } else {
        $nombreProfesor = "Invitado";
        $fotoPerfil = null;
    }

    $stmt->close();
} else {
    // Redirigir si no ha iniciado sesión
    header("Location: ../html/login.html");
    exit();
}
?>
<?php
include '../html/translate2.php';
include '../html/changesmode2.php';
include '../html/compaBot.php';

?>
<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../html/indexProfesor.php"><i class="bi bi-house-door"></i> Profesor EduCompa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-gear"></i> CRUD
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="../html/bibliotecaProfesor.php"><i class="bi bi-book"></i> Biblioteca</a></li>
            <li><a class="dropdown-item" href="../html/clasesProfesor.php"><i class="bi bi-folder"></i> Clases</a></li>
            <li><a class="dropdown-item" href="../html/podioProfesor.php"><i class="bi bi-award"></i> Podio</a></li>
            <li><a class="dropdown-item" href="../html/estudiantesProfesor.php"><i class="bi bi-person-badge"></i> Estudiantes</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <!-- Mostrar la foto de perfil -->
            <?php if ($fotoPerfil): ?>
              <img src="data:image/jpeg;base64,<?php echo $fotoPerfil; ?>" alt="Foto de perfil" class="rounded-circle me-2" width="40" height="40">
            <?php else: ?>
              <i class="bi bi-person-circle me-2"></i>
            <?php endif; ?>
            <span><?php echo htmlspecialchars($nombreProfesor); ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="../php/cerrar_sesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
