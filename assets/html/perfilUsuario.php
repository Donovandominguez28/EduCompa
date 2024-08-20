<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
    
// Check if a banner is set; if not, use a default image
$bannerImg = !empty($banner) ? 'data:'  . ';base64,' . base64_encode($banner) : '../images/defaultBanner.jpg';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php include '../html/navBar.php'; ?>

<body id="#top">


    <section class="perfil-usuario">
        <div class="contenedor-perfil">
            <div class="portada-perfil reveal" style="background-image: url('<?php echo $bannerImg; ?>');">
                <div class="sombra"></div>
                <div class="avatar-perfil reveal">
                    <img src="data:<?php echo $mimeType; ?>;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Foto de perfil">
                </div>
                <div class="datos-perfil reveal">
                    <h4 style="font-size:20px;">Nombre: <?php echo htmlspecialchars($nombreCompleto); ?></h4>
                    <h4 style="font-size:20px;">Usuario: <?php echo htmlspecialchars($usuario); ?></h4>
                    <h4 style="font-size:20px;">Bachillerato: <?php echo htmlspecialchars($añoBachi); ?> Año</h4>
                    <h4 style="font-size:20px;">Sección: <?php echo htmlspecialchars($seccion); ?></h4>
                    <h4 style="font-size:20px;">Especialidad: <?php echo htmlspecialchars($especialidad); ?></h4>
                    <!-- <ul class="lista-perfil">
                        <li>35 Seguidores</li>
                        <li>7 Seguidos</li>
                        <li>32 Publicaciones</li>
                    </ul> -->
                </div>
            </div>
            <div class="menu-perfil reveal">
                <ul>
                    <li><a type="button" href="../html/publicarMural.php" class="btn btn-primary" style="color:white;"><i class="bi bi-megaphone"></i> Publicar</a></li>
                    <li><a type="button" href="../html/editarPerfil.php" class="btn btn-primary" style="color:white;"><i class="bi bi-pencil-square"></i> Editar Perfil</a></li>
                    <li><a type="button" href="../html/perfiles.php" class="btn btn-primary" style="color:white;"><i class="bi bi-search"></i> Mas perfiles...</a></li>
                </ul>
            </div>
        </div>
    </section>

    <br><br><br><br><br>
    <section class="section section-divider white cta reveal" style="background-image: url('../images/pared2.jpg')">
    <div class="containerrr">
        <h1 class="titulo-usuario reveal" style="color: white; font-size: 40px;">Mural del Conocimiento</h1>
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
        if (!empty($row['imagenMural'])) {
            echo '<div class="card__image-container">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagenMural']) . '" alt="image" class="card__img">';
            echo '</div>';
        }
        echo '<div class="card__data" style="font-size:15px;">';
        echo '<h2 class="card__title">' . htmlspecialchars($row['titulo']) . '</h2>';
        echo '<p>' . htmlspecialchars($row['informacion']) . '</p>';
        echo '</div>';
        echo '<div class="card__actions">';
        echo '<a href="../html/editarMural.php?idMural=' . $row['idMural'] . '" class="card__btn card__btn--edit"><i class="bi bi-pencil-square"></i> Editar</a>';
        echo '<button class="card__btn card__btn--delete" onclick="confirmDelete(' . $row['idMural'] . ')"><i class="bi bi-trash-fill"></i> Eliminar</button>';
        echo '</div>';
        echo '</article>';
    }
} else {
    echo '<h1 class="titulo-usuario reveal" style="color: white; font-size: 40px; text-align: center;">Publicaciones no disponibles.</h1>';
}
?>

        </div>
    </div>
</section>
<style>
    .card__container {
    position: relative;
}

.card__article {
    position: relative;
    margin-bottom: 3em; /* Espacio suficiente para los botones */
    padding-bottom: 6em; /* Espacio para los botones en la parte inferior */
}

.card__btn {
    position: absolute;
    bottom: 10px; /* Ajusta la distancia desde el borde inferior según sea necesario */
    padding: 0.5em 1em;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.5em;
    color: white;
    z-index: 10; /* Asegura que los botones estén por encima del contenido de la tarjeta */
}

.card__btn--edit {
    background: #007bff;
    left: 10px; /* Ajusta la distancia desde el borde izquierdo */
}

.card__btn--delete {
    background: #dc3545;
    right: 10px; /* Ajusta la distancia desde el borde derecho */
}


.card__btn--edit:hover {
    background: darkblue;
}

.card__btn--delete:hover {
    background: darkred;
}

.card__image-container {
    max-height: 300px; /* Ajusta según el tamaño máximo deseado */
    overflow: hidden;
}

.card__img {
    width: 100%;
    height: auto;
    max-height: 300px; /* Ajusta según el tamaño máximo deseado */
    object-fit: cover; /* Asegura que la imagen no se deforme */
}

</style>


    <br><br>
    <?php include '../html/footer.php'; ?>

    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>
    <script src="../js/script.js" defer></script>
    <script>

</script>

</body>

</html>
