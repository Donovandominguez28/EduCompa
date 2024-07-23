<a href="../html/index.php"><img src="../img/educompalogo.jpg" alt="logo" class="logo"></a>
<nav id="sidebar">
  <div id="sidebar_content">
    <div id="user">
      <img id="user_avatar" src="data:image/jpeg;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Avatar del usuario">
      <span class="item-description"><?php echo htmlspecialchars($usuario); ?></span>
    </div>
    <ul id="side_items">
      <li class="side-item active">
        <a href="../html/aulaVirtual.php">
          <i class="bi bi-backpack3"></i>
          <span class="item-description">Aula virtual</span>
        </a>
      </li> 
      <li class="side-item">
        <a href="../html/perfil.php">
          <i class="bi bi-person-fill"></i>
          <span class="item-description">Perfil</span>
        </a>
      </li>
      <li class="side-item">
        <a href="../html/biblioteca.php">
          <i  class="bi bi-book"></i>
          <span class="item-description">Biblioteca</span>
        </a>
      </li>
      <li class="side-item">
        <a href="../html/users.php">
          <i class="bi bi-chat-dots-fill"></i>
          <span class="item-description">Chat</span>
        </a>
      </li>
      <li class="side-item">
        <a href="../html/juegos.php">
          <i class="bi bi-controller"></i>
          <span class="item-description">Juegos</span>
        </a>
      </li>
      <li class="side-item">
        <a href="#">
          <i class="bi bi-pen"></i>
          <span class="item-description">Refuerzo Avanzo</span>
        </a>
      </li>
      
    </ul>
    <button id="open_btn">
      <i id="open_btn_icon" class="fa-solid fa-chevron-right"></i>
    </button>
  </div>
  <button class="btncerrarsesion" onclick="window.location.href='../php/cerrar_sesion.php';">
    <div class="sign">
      <svg viewBox="0 0 512 512">
        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
      </svg>
    </div>
    <div class="text">Cerrar sesión</div>
  </button>
</nav>
