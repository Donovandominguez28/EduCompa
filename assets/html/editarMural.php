<?php
include '../php/session_check2.php';
include '../php/conexion.php';
$idMural = $_GET['idMural']; // Obtener ID de la publicación desde la URL

// Consulta SQL para obtener los datos de la publicación
$sql = "SELECT * FROM mural WHERE idMural = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idMural);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $publicacion = $result->fetch_assoc();
} else {
    echo "<script>alert('No se encontraron datos de la publicación.'); window.history.back();</script>";
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
    <title>Editar Publicación</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        #imagenMuralPreview {
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
        form input, form textarea {
            padding: 10px 15px;
            border: 1px solid #AAA;
            border-radius: 5px;
            font-size: 1em;
        }
        form button {
            padding: 10px 20px;
            border: none;
            background: blue;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        a {
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
    </style>
</head>
<body>
<main>
    <h1>Editar Publicación</h1>
    <form id="editarPublicacion" action="../php/editarMural.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="idMural" value="<?php echo htmlspecialchars($publicacion['idMural']); ?>">
        <div>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($publicacion['titulo']); ?>" required>
        </div>
        <div>
            <label for="informacion">Información:</label>
            <textarea id="informacion" name="informacion" rows="5" required><?php echo htmlspecialchars($publicacion['informacion']); ?></textarea>
        </div>
        <div>
            <label for="imagenMural">Imagen del Mural:</label>
            <input type="file" id="imagenMural" name="imagenMural" accept="image/*" onchange="showPreview(event, 'imagenMuralPreview')">
            <div id="imagenMuralPreviewContainer">
                <img id="imagenMuralPreview" src="<?php echo $publicacion['imagenMural'] ? 'data:image/jpeg;base64,'.base64_encode($publicacion['imagenMural']) : ''; ?>" alt="Imagen del Mural Preview">
            </div>
        </div>
        <button type="submit" name="submit">Guardar Cambios</button>
        <a href="../html/perfilUsuario.php">Cancelar</a>
    </form>
</main>
</body>
<?php 
include '../html/changesMode.php';
?>
<script>
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
