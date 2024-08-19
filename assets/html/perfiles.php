<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';

// Asegúrate de que el carnet se está asignando correctamente
if (isset($_SESSION['carnet'])) {
    $carnet = $_SESSION['carnet'];
} else {
    die('El carnet del usuario no está definido.');
}

// Verifica que $carnet esté definido y tiene el valor correcto
if (!isset($carnet)) {
    die('Carnet no está definido.');
}

// Check if a banner is set; if not, use a default image
$bannerImg = !empty($banner) ? 'data:' . (isset($mimeType) ? $mimeType : 'image/jpeg') . ';base64,' . base64_encode($banner) : '../images/defaultBanner.jpg';

// Fetch all profiles except the current one
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
<?php include '../html/navBar.php'; ?>
<body id="#top">
    <section class="perfil-usuario">
        <div class="contenedor-perfil">
            <h1>Perfiles Disponibles</h1>
            <?php
            if (mysqli_num_rows($profilesResult) > 0) {
                while ($profile = mysqli_fetch_assoc($profilesResult)) {
                    $profileBanner = !empty($profile['banner']) ? 'data:' . (isset($profile['mimeType']) ? $profile['mimeType'] : 'image/jpeg') . ';base64,' . base64_encode($profile['banner']) : '../images/defaultBanner.jpg';
                    $profilePhoto = !empty($profile['fotoPerfil']) ? 'data:' . (isset($profile['mimeType']) ? $profile['mimeType'] : 'image/jpeg') . ';base64,' . base64_encode($profile['fotoPerfil']) : '../images/defaultProfile.jpg';

                    echo '<div class="profile-card">';
                    echo '<div class="profile-banner" style="background-image: url(\'' . $profileBanner . '\');"></div>';
                    echo '<div class="profile-photo"><img src="' . $profilePhoto . '" alt="Foto de perfil"></div>';
                    echo '<div class="profile-info">';
                    echo '<h2>' . htmlspecialchars($profile['nombreCompleto']) . '</h2>';
                    echo '<p>Usuario: ' . htmlspecialchars($profile['usuario']) . '</p>';
                    echo '<p>Bachillerato: ' . htmlspecialchars($profile['añoBachi']) . ' Año</p>';
                    echo '<p>Sección: ' . htmlspecialchars($profile['seccion']) . '</p>';
                    echo '<p>Especialidad: ' . htmlspecialchars($profile['especialidad']) . '</p>';

                    // Fetch murals for the current profile
                    $profileCarnet = $profile['carnet'];
                    $sqlMurals = "SELECT * FROM mural WHERE carnet2 = ?";
                    $stmtMurals = mysqli_prepare($conn, $sqlMurals);
                    mysqli_stmt_bind_param($stmtMurals, 'i', $profileCarnet);
                    mysqli_stmt_execute($stmtMurals);
                    $muralsResult = mysqli_stmt_get_result($stmtMurals);

                    if (mysqli_num_rows($muralsResult) > 0) {
                        echo '<div class="profile-murals">';
                        while ($row = mysqli_fetch_assoc($muralsResult)) {
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
                            echo '</article>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No hay publicaciones para este perfil.</p>';
                    }

                    echo '</div>';
                }
            } else {
                echo '<p>No hay perfiles disponibles.</p>';
            }
            ?>
        </div>
    </section>
    <?php include '../html/footer.php'; ?>
    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>
    <script src="../js/script.js" defer></script>
</body>
</html>
