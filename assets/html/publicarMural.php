<?php
include '../php/session_check2.php';
include '../php/conexion.php';
$carnet = $_SESSION['carnet']; // Asegúrate de que el carnet esté almacenado en la sesión

// Aquí no necesitamos datos del estudiante para la publicación en mural
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar en Mural</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
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
    <h1>Publicar en el Mural</h1>
    <form id="publicarMural" action="../php/publicarMural.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="carnet" value="<?php echo htmlspecialchars($carnet); ?>">
        <div>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div>
            <label for="informacion">Información:</label>
            <textarea id="informacion" name="informacion" rows="5" required></textarea>
        </div>
        <div>
            <label for="imagenMural">Imagen del Mural:</label>
            <input type="file" id="imagenMural" name="imagenMural" accept="image/*">
            <div id="imagenMuralPreview"></div>
        </div>
        <button type="submit" name="submit">Publicar</button>
        <a href="../html/perfilUsuario.php">Cancelar</a>
    </form>
</main>
</body>
<script>
    document.getElementById('imagenMural').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '200px';
            img.style.height = 'auto';
            img.style.objectFit = 'cover';
            const preview = document.getElementById('imagenMuralPreview');
            preview.innerHTML = ''; // Limpiar la vista previa existente
            preview.appendChild(img);
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>
</html>
