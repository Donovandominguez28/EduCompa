<?php
include '../php/session_check2.php';
include '../php/conexion.php';
$carnet = $_SESSION['carnet']; // Asegúrate de que el carnet esté almacenado en la sesión

// Consulta SQL para obtener los datos del estudiante
$sql = "SELECT * FROM estudiantes WHERE carnet = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $carnet);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $estudiante = $result->fetch_assoc();
} else {
    echo "<script>alert('No se encontraron datos del estudiante.'); window.history.back();</script>";
    exit();
}

// Cerrar la conexión
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        #bannerPreview {
    display: none; /* Hide initially */
    width: 100%; /* Or adjust as needed */
    height: 200px; /* Or adjust as needed */
    object-fit: cover;
}

        .preview-container {
        position: relative;
        width: 100%;
        height: 200px; /* Adjust as needed */
        border: 1px solid #ddd;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
         
        main {
            width: 50%;
            margin: 20px auto;
            padding: 1em 2em;
            background: #153f59;
            box-shadow: 0 0 20px #ddd;
            border-radius: 20px;
        }
        h1 {
            text-align: center;
            color: white;
            border-bottom: 1px solid #C4CBCE;
            padding-bottom: .5em;
        }
        form > div {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        form label {
            font-weight: bold;
            color: white;
        }
        form input, form select {
            padding: 10px 15px;
            border: 1px solid #AAA;
            border-radius: 5px;
            font-size: 1em;
        }
        form button  {
            padding: 10px 20px;
            border: none;
            background: blue;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        a{
          padding: 10px 20px;
            border: none;
            background: red;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
        }
        a:hover {
            background: darkred;
        }
        form button:hover {
            background: darkblue;
        }
        .portada-perfil {
            background-image: url('<?php echo $estudiante['banner'] ? "data:image/jpeg;base64,".base64_encode($estudiante['banner']) : "../images/defaultBanner.jpg"; ?>');
            background-size: cover;
            position: relative;
            height: 200px;
        }
        .sombra {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .avatar-perfil {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 50%;
            overflow: hidden;
            border: 5px solid white;
            width: 100px;
            height: 100px;
        }
        .avatar-perfil img {
            width: 100%;
            height: auto;
        }
        .datos-perfil {
            text-align: center;
            margin-top: 60px;
        }
        .datos-perfil h4 {
            margin: 5px 0;
            color: white;
        }
        .lista-perfil {
            list-style: none;
            padding: 0;
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .lista-perfil li {
            color: white;
        }
    </style>
</head>
<?php 
include '../html/changesMode.php';
?>
<body>
<main>
    <h1>Editar perfil</h1>
    <div class="portada-perfil">
        <div class="sombra"></div>
        <div class="avatar-perfil">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($estudiante['fotoPerfil']); ?>" alt="Foto de perfil">
        </div>
    </div>
    <br>
    <br>
    <br>
    <form id="editarPerfil" action="../php/editarPerfil.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="carnet" value="<?php echo htmlspecialchars($estudiante['carnet']); ?>">
    <div>
        <label for="nombreCompleto">Nombre Completo:</label>
        <input type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo htmlspecialchars($estudiante['nombreCompleto']); ?>" required>
    </div>
    <div>
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($estudiante['usuario']); ?>" required>
    </div>
    <div>
        <label for="seccion">Sección:</label>
        <select id="seccion" name="seccion" class="form-control" required>
            <option value="">Selecciona la sección</option>
            <option value="A" <?php echo ($estudiante['seccion'] == 'A') ? 'selected' : ''; ?>>A</option>
            <option value="B" <?php echo ($estudiante['seccion'] == 'B') ? 'selected' : ''; ?>>B</option>
            <option value="C" <?php echo ($estudiante['seccion'] == 'C') ? 'selected' : ''; ?>>C</option>
            <option value="D" <?php echo ($estudiante['seccion'] == 'D') ? 'selected' : ''; ?>>D</option>
            <option value="F" <?php echo ($estudiante['seccion'] == 'F') ? 'selected' : ''; ?>>F</option>
            <option value="G" <?php echo ($estudiante['seccion'] == 'G') ? 'selected' : ''; ?>>G</option>
            <option value="H" <?php echo ($estudiante['seccion'] == 'H') ? 'selected' : ''; ?>>H</option>
            <option value="I" <?php echo ($estudiante['seccion'] == 'I') ? 'selected' : ''; ?>>I</option>
        </select>
    </div>
    <div>
        <label for="añoBachi">Año Bachillerato:</label>
        <select id="añoBachi" name="añoBachi" class="form-control" required>
            <option value="">Selecciona el año bachillerato</option>
            <option value="1" <?php echo ($estudiante['añoBachi'] == '1') ? 'selected' : ''; ?>>Primer Año</option>
            <option value="2" <?php echo ($estudiante['añoBachi'] == '2') ? 'selected' : ''; ?>>Segundo Año</option>
            <option value="3" <?php echo ($estudiante['añoBachi'] == '3') ? 'selected' : ''; ?>>Tercer Año</option>
        </select>
    </div>
    <div>
        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad" class="form-control" required>
            <option value="">Selecciona la especialidad</option>
            <option value="Atencion Primaria en Salud" <?php echo ($estudiante['especialidad'] == 'Atencion Primaria en Salud') ? 'selected' : ''; ?>>Atencion Primaria en Salud</option>
            <option value="Electronica" <?php echo ($estudiante['especialidad'] == 'Electronica') ? 'selected' : ''; ?>>Electronica</option>
            <option value="Electromecanica" <?php echo ($estudiante['especialidad'] == 'Electromecanica') ? 'selected' : ''; ?>>Electromecanica</option>
            <option value="Desarrollo de Software" <?php echo ($estudiante['especialidad'] == 'Desarrollo de Software') ? 'selected' : ''; ?>>Desarrollo de Software</option>
            <option value="Diseño Grafico" <?php echo ($estudiante['especialidad'] == 'Diseño Grafico') ? 'selected' : ''; ?>>Diseño Grafico</option>
            <option value="Mantenimiento Automotriz" <?php echo ($estudiante['especialidad'] == 'Mantenimiento Automotriz') ? 'selected' : ''; ?>>Mantenimiento Automotriz</option>
        </select>
    </div>
    <div>
        <label for="fotoPerfil">Foto de Perfil:</label>
        <input type="file" id="fotoPerfil" name="fotoPerfil" accept="image/*">
        <div id="fotoPerfilPreview"></div>
    </div>
    <div>
        <label for="banner">Banner:</label>
        <input type="file" id="banner" name="banner" accept="image/*" onchange="showPreview(event, 'bannerPreview')">
    </div>
    <div id="bannerPreviewContainer">
        <img id="bannerPreview" src="" alt="Banner Preview">
    </div>
    <button type="submit" name="submit">Guardar Cambios</button>
    <a href="../html/perfilUsuario.php">Cancelar</a>
</form>

</main>
</body>
<script>
    document.getElementById('fotoPerfil').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.borderRadius = '50%';
            img.style.border = '5px solid white';
            img.style.objectFit = 'cover';
            const preview = document.getElementById('fotoPerfilPreview');
            preview.innerHTML = ''; // Limpiar la vista previa existente
            preview.appendChild(img);
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    function showPreview(event, previewId) {
    var input = event.target;
    var preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the preview
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none'; // Hide the preview if no file selected
    }
}
</script>
</html>
