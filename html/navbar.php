<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <title>Navbar</title>
</head>
<body style="margin-top:95px;">
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../html/index.php">
        <img src="../img/educompalogo.jpg" alt="logo" class="rounded-circle" style="width: 70px; height: 70px;">
      </a>
      <div class="d-flex align-items-center">
        <div class="d-flex align-items-center me-3">
          <img id="user_avatar" src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Avatar del usuario" class="rounded-circle" style="width: 70px; height: 70px;">
          <span class="text-white ms-2"><?php echo htmlspecialchars($usuario); ?></span>
          <button class="btn btn-danger ms-3" onclick="window.location.href='../php/cerrar_sesion.php';">
            <i class="bi bi-box-arrow-right"></i>
            <span class="ms-1">Cerrar sesión</span>
          </button>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menú</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../html/aulaVirtual.php">
                <i class="bi bi-backpack3"></i>
                Aula virtual
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/perfil.php">
                <i class="bi bi-person-fill"></i>
                Perfil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/biblioteca.php">
                <i class="bi bi-book"></i>
                Biblioteca
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/users.php">
                <i class="bi bi-chat-dots-fill"></i>
                Chat
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../html/juegos.php">
                <i class="bi bi-controller"></i>
                Juegos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="bi bi-pen"></i>
                Refuerzo Avanzo
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
