<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
$carnet = $_SESSION['carnet'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php include '../html/navBar.php'; ?>

    <section class="perfil-usuario reveal">
        <div class="contenedor-perfil">
            <div class="portada-perfil" style="background-image: url('../images/libros.jpg');">
                <div class="sombra"></div>
                <div class="avatar-perfil">
                    <img src="data:<?php echo $mimeType; ?>;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Foto de perfil">
                </div>
                <div class="datos-perfil">
                    <h4 style="font-size:20px;">Nombre: <?php echo htmlspecialchars($nombreCompleto); ?></h4>
                    <h4 style="font-size:20px;">Usuario: <?php echo htmlspecialchars($usuario); ?></h4>
                    <h4 style="font-size:20px;">Bachillerato: <?php echo htmlspecialchars($añoBachi); ?> Año</h4>
                    <h4 style="font-size:20px;">Sección: <?php echo htmlspecialchars($seccion); ?></h4>
                    <h4 style="font-size:20px;">Especialidad: <?php echo htmlspecialchars($especialidad); ?></h4>
                    <ul class="lista-perfil">
                        <li>35 Seguidores</li>
                        <li>7 Seguidos</li>
                        <li>32 Publicaciones</li>
                    </ul>
                </div>
                <div class="opciones-perfil">
                </div>
            </div>
            <div class="menu-perfil">
                <ul>
                    <li><button id="publicar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPublicar">Publicar</button></li>
                </ul>
            </div>
        </div>
    </section>
    <br><br><br><br><br>

    <section class="section section-divider white cta reveal" style="background-image: url('../images/pared.jpg')">
        <div class="containerrr reveal">
            <h1 class="titulo-usuario reveal" style="color: white; font-size: 40px;">Mural del Conocimiento</h1>
            <br>
            <div class="card__container reveal">
                <?php
                $sql = "SELECT * FROM mural WHERE carnet2 = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $carnet);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<article class="card__article">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagenMural']) . '" alt="image" class="card__img">';
                        echo '<div class="card__data" style="font-size:15px;">';
                        echo '<h2 class="card__title">' . htmlspecialchars($row['titulo']) . '</h2>';
                        echo '<p>' . htmlspecialchars($row['informacion']) . '</p>';
                        if ($row['carnet2'] == $carnet) {
                            echo '<a class="btn btn-warning edit-btn" data-bs-toggle="modal" data-bs-target="#modalEditar" href="#" data-id="' . $row['idMural'] . '" data-titulo="' . htmlspecialchars($row['titulo']) . '" data-descripcion="' . htmlspecialchars($row['informacion']) . '">Editar</a>';

                            echo '<a class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#modalEliminar" href="#" data-id="' . $row['idMural'] . '">Eliminar</a>';
                        }
                        echo '</div>';
                        echo '</article>';
                    }
                } else {
                    echo '<p class="no-publicaciones">Publicaciones no disponibles.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Modal para hacer publicaciones -->
    <div id="modalPublicar" class="modal fade" tabindex="-1" aria-labelledby="publicarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="publicarModalLabel">Publicar en el Mural</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formPublicar" action="../php/publicar.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcion" name="informacion" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar publicaciones -->
    <div id="modalEditar" class="modal fade" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditar" action="../php/editarPublicacion.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="idMuralEditar" name="idMural">
                        <div class="mb-3">
                            <label for="tituloEditar" class="form-label">Título:</label>
                            <input type="text" class="form-control" id="tituloEditar" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionEditar" class="form-label">Descripción:</label>
                            <textarea class="form-control" id="descripcionEditar" name="informacion" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="imagenEditar" class="form-label">Imagen:</label>
                            <input type="file" class="form-control" id="imagenEditar" name="imagen" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar publicaciones -->
    <div id="modalEliminar" class="modal fade" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Eliminar Publicación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEliminar" action="../php/eliminarPublicacion.php" method="post">
                        <input type="hidden" id="idMuralEliminar" name="idMural">
                        <p>¿Estás seguro de que deseas eliminar esta publicación?</p>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <footer class="footer-distributed reveal">
        <div class="footer-left">
            <img src="../images/educompalogo.jpg" alt="" class="footer-logo">
            <p class="footer-links">
                <a href="../html/index.html"><i class="bi bi-house">Inicio</i></a> |
                <a href="../html/perfilUsuario.html"><i class="bi bi-people">Perfil</i></a> |
                <a href="#"><i class="bi bi-backpack3">Aula Virtual</i></a> |
                <br>
                <a href="../html/biblioteca.html"><i class="bi bi-book">Biblioteca</i></a> |
                <a href="#"><i class="bi bi-chat-dots-fill">Chat</i></a> |
                <a href="#"><i class="bi bi-controller">Juegos</i></a> |
                <br>
                <a href="#"><i class="bi bi-pen">Refuerzo Avanzo</i></a>
            </p>
            <p class="footer-company-name">Copyright © 2024 <strong>EduCompa</strong> All rights reserved</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="bi bi-map"></i>
                <p>Colegio Don Bosco</p>
            </div>
            <div>
                <i class="bi bi-phone"></i>
                <p>503 7681-4348</p>
            </div>
            <div>
                <i class="bi bi-envelope"></i>  
                <p><a href="mailto:estudiante20230698@cdb.edu.sv">estudiante20230698@cdb.edu.sv</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>Sobre Nosotros</span>
                <strong>EduCompa</strong> Es nuestra plataforma educativa
            </p>
            <div class="footer-icons">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </footer>
    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>
    <div class="contenedor-toast" id="contenedor-toast"></div>
    <script src="../js/script.js" defer></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/notificaciones.js"></script>
</body>

</html>
