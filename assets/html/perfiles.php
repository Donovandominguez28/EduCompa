<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';

// Verifica que el carnet esté definido en la sesión
if (isset($_SESSION['carnet'])) {
    $carnet = $_SESSION['carnet'];
} else {
    die('El carnet del usuario no está definido.');
}

// Verifica que $carnet esté definido correctamente
if (!isset($carnet)) {
    die('Carnet no está definido.');
}

// Verifica si se ha establecido un banner, de lo contrario, usa una imagen predeterminada
$bannerImg = !empty($banner) ? 'data:' . (isset($mimeType) ? $mimeType : 'image/jpeg') . ';base64,' . base64_encode($banner) : '../images/defaultBanner.jpg';

// Obtén todos los perfiles excepto el actual
$sql = "SELECT * FROM estudiantes WHERE carnet != ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die('Error en la preparación de la consulta: ' . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, 'i', $carnet);
mysqli_stmt_execute($stmt);

$profilesResult = mysqli_stmt_get_result($stmt);

if (!$profilesResult) {
    die('Error en la ejecución de la consulta: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfiles Disponibles</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body id="top">
    <?php include '../html/navBar.php'; ?>
    
    <section class="perfil-usuario">
        <?php
        if (mysqli_num_rows($profilesResult) > 0) {
            while ($profile = mysqli_fetch_assoc($profilesResult)) {
                $profileBanner = !empty($profile['banner']) ? 'data:' . (isset($profile['mimeType']) ? $profile['mimeType'] : 'image/jpeg') . ';base64,' . base64_encode($profile['banner']) : '../images/defaultBanner.jpg';
                $profilePhoto = !empty($profile['fotoPerfil']) ? 'data:' . (isset($profile['mimeType']) ? $profile['mimeType'] : 'image/jpeg') . ';base64,' . base64_encode($profile['fotoPerfil']) : '../images/defaultProfile.jpg';

                echo '<div class="contenedor-perfil">';
                echo '<div class="portada-perfil reveal" style="background-image: url(\'' . $profileBanner . '\');">';
                echo '<div class="sombra"></div>';
                echo '<div class="avatar-perfil reveal"><img src="' . $profilePhoto . '" alt="Foto de perfil"></div>';
                echo '<div class="datos-perfil reveal">';
                echo '<h4 style="font-size:20px;">Nombre: ' . htmlspecialchars($profile['nombreCompleto']) . '</h4>';
                echo '<h4 style="font-size:20px;">Usuario: ' . htmlspecialchars($profile['usuario']) . '</h4>';
                echo '<h4 style="font-size:20px;">Bachillerato: ' . htmlspecialchars($profile['añoBachi']) . ' Año</h4>';
                echo '<h4 style="font-size:20px;">Sección: ' . htmlspecialchars($profile['seccion']) . '</h4>';
                echo '<h4 style="font-size:20px;">Especialidad: ' . htmlspecialchars($profile['especialidad']) . '</h4>';
                echo '</div>'; // Cierre de datos-perfil
                echo '</div>'; // Cierre de portada-perfil
                echo '<div class="menu-perfil reveal">';
                echo '<ul>';
                echo '<li><a type="button" href="../php/chat.php?carnet=' . htmlspecialchars($profile['carnet']) . '" class="btn btn-primary" style="color:black; background-color:white;"><i class="bi bi-chat-left-dots"></i> Enviar mensaje</a></li>';
                echo '</ul>';
                echo '</div>'; // Cierre de menu-perfil
                echo '</div>'; // Cierre de contenedor-perfil

                // Añade un espaciado adicional entre perfiles
                echo '<br><br><br><br><br><br><br>';

                // Obtén las publicaciones en el mural del perfil actual
                $profileCarnet = $profile['carnet'];
                $sqlMurals = "SELECT * FROM mural WHERE carnet2 = ?";
                $stmtMurals = mysqli_prepare($conn, $sqlMurals);
                mysqli_stmt_bind_param($stmtMurals, 'i', $profileCarnet);
                mysqli_stmt_execute($stmtMurals);
                $muralsResult = mysqli_stmt_get_result($stmtMurals);

                echo '<section class="section section-divider white cta reveal" style="background-image: url(\'../images/pared2.jpg\')">';
                echo '<div class="containerrr">';
                echo '<h1 class="titulo-usuario reveal" style="color: white; font-size: 40px; text-align: center;">Mural del Conocimiento de ' . htmlspecialchars($profile['nombreCompleto']) . '</h1>';
                echo '<br><br><br><br><br><br><br>';

                echo '<div class="card__container reveal">';

                if (mysqli_num_rows($muralsResult) > 0) {
                    while ($row = mysqli_fetch_assoc($muralsResult)) {
                        echo '<article class="card__article">';
                        if (!empty($row['imagenMural'])) {
                            echo '<div class="card__image-container">';
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagenMural']) . '" alt="Imagen del Mural" class="card__img">';
                            echo '</div>';
                        }
                        echo '<div class="card__data" style="font-size:15px;">';
                        echo '<h2 class="card__title">' . htmlspecialchars($row['titulo']) . '</h2>';
                        echo '<p>' . htmlspecialchars($row['informacion']) . '</p>';
                        echo '</div>';
                        echo '<br><br><br><br><br><br><br>';
                        echo '</article>';

                        // Añade un espaciado adicional entre publicaciones
                        echo '<br><br><br><br><br><br><br>';
                    }
                } else {
                    echo '<h1 class="titulo-usuario reveal" style="color: white; font-size: 40px; text-align: center;">Publicaciones no disponibles.</h1>';
                }

                echo '</div>'; // Cierre de card__container
                echo '</div>'; // Cierre de containerrr
                echo '</section>'; // Cierre de section-divider
            }
        }
        ?>
    </section>
    <style>
    .card__container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .card__article {
        margin-bottom: 4em;
    }

    .card__image-container {
        max-height: 400px;
        overflow: hidden;
    }

    .card__img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
    }
    </style>
    <?php include '../html/footer.php'; ?>
    <?php 
    include '../html/changesMode.php';
    ?>
    
    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
        <i class="bi bi-arrow-up-short"></i>
    </a>
    
    <script src="../js/script.js" defer></script>
</body>
</html>
