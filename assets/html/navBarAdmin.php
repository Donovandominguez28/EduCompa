<?php
include "../php/conexion.php";
// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['idAdmin'])) {
    $idAdmin = $_SESSION['idAdmin'];

    // Obtener la información del usuario desde la base de datos
    $sql = "SELECT nombre FROM administrador WHERE idAdmin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idAdmin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombreAdmin = $row['nombre'];
    } else {
        $nombreAdmin = "Invitado";
    }

    $stmt->close();
} else {
    // Redirigir si no ha iniciado sesión
    header("Location: ../html/login.php");
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
      <a class="navbar-brand" href="../html/indexAdmin.php"><i class="bi bi-house-door"></i> Administración EduCompa</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <!--- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../html/indexAdmin.php"><i class="bi bi-house"></i> Inicio</a>
          </li>-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-gear"></i> CRUD
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="../html/bibliotecaAdmin.php"><i class="bi bi-book"></i> Biblioteca</a></li>
              <li><a class="dropdown-item" href="../html/clasesAdmin.php"><i class="bi bi-folder"></i> Clases</a></li>
              <li><a class="dropdown-item" href="../html/podio.php"><i class="bi bi-award"></i> Podio</a></li>
              <li class="dropdown-submenu">
                <a class="dropdown-item dropdown-toggle"><i class="bi bi-person"></i> Usuarios</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../html/estudiantesAdmin.php"><i class="bi bi-person-badge"></i> Estudiantes</a></li>
                  <li><a class="dropdown-item" href="../html/profesoresAdmin.php"><i class="bi bi-person-lines-fill"></i> Profesores</a></li>
                  <li><a class="dropdown-item" href="../html/administradoresAdmin.php"><i class="bi bi-person-circle"></i> Administradores</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-2"></i><span><?php echo htmlspecialchars ($nombreAdmin); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="../php/cerrar_sesion.php"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>