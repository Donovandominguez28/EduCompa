<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contenido de Clase</title>
    <script src="../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .tox-promotion { display: none; }
        button {
            padding: 10px 30px;
            border: 3px solid #000;
            font-family: 'Noto Sans', sans-serif;
            border-radius: 5px;
            background: none;
            color: #000;
            cursor: pointer;
            transition: 0.2s ease all;
        }
        button:hover {
            background: #000;
            color: #fff;
        }
    </style>
    <script>
    // Inicialización de TinyMCE con soporte para la carga de imágenes
    tinymce.init({
        selector: '#editor',
        language: 'es_MX',
        branding: false,
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code | formatselect | removeformat | fullscreen | preview',
        statusbar: false,
        plugins: 'image link code lists media table advlist fullscreen preview paste',
        images_upload_url: '../php/upload_image.php', // URL donde se manejará la carga de imágenes
        automatic_uploads: true,
        images_upload_base_path: '/uploads',
        file_picker_types: 'image', // Permitir solo imágenes en el selector de archivos

        // Función para manejar la carga de imágenes
        images_upload_handler: function (blobInfo, success, failure) {
            let xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '../php/upload_image.php');

            xhr.onload = function() {
                let json;

                if (xhr.status != 200) {
                    failure('Error HTTP: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Respuesta inválida: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },

        // Configuración del selector de archivos personalizado
        file_picker_callback: function (callback, value, meta) {
            if (meta.filetype === 'image') {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function () {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.onload = function () {
                        const img = new Image();
                        img.src = reader.result;

                        img.onload = function () {
                            const canvas = document.createElement('canvas');
                            const ctx = canvas.getContext('2d');
                            const MAX_WIDTH = 800; // Ancho máximo
                            const MAX_HEIGHT = 800; // Altura máxima
                            let width = img.width;
                            let height = img.height;

                            if (width > height) {
                                if (width > MAX_WIDTH) {
                                    height *= MAX_WIDTH / width;
                                    width = MAX_WIDTH;
                                }
                            } else {
                                if (height > MAX_HEIGHT) {
                                    width *= MAX_HEIGHT / height;
                                    height = MAX_HEIGHT;
                                }
                            }

                            canvas.width = width;
                            canvas.height = height;
                            ctx.drawImage(img, 0, 0, width, height);

                            canvas.toBlob(function (blob) {
                                const id = 'blobid' + (new Date()).getTime();
                                const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                const blobInfo = blobCache.create(id, blob, file.name);
                                blobCache.add(blobInfo);
                                callback(blobInfo.blobUri(), { title: file.name });
                            }, 'image/jpeg', 0.8); // Comprime a JPEG con calidad 80%
                        };
                    };

                    reader.readAsDataURL(file);
                };

                input.click();
            }
        }
    });
</script>
</head>
<body>
    <?php
    include '../php/conexion.php';

    if (isset($_GET['idContenido'])) {
        $idContenido = intval($_GET['idContenido']);
        
        // Obtener los datos actuales del contenido
        $sql = "SELECT contenido, idClase10 FROM contenidoclases2 WHERE idContenido = $idContenido";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $contenido = $row['contenido'];
            $idClase10 = $row['idClase10'];
        } else {
            echo "<p style='color: red;'>No se encontró el contenido.</p>";
            exit;
        }
    } else {
        echo "<p style='color: red;'>ID de contenido no proporcionado.</p>";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
        if (isset($_POST['contenido']) && isset($_POST['idClase10'])) {
            $contenido = $conn->real_escape_string($_POST['contenido']);
            $idClase10 = intval($_POST['idClase10']);

            $sql = "UPDATE contenidoclases2 SET contenido='$contenido', idClase10=$idClase10 WHERE idContenido=$idContenido";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: green;'>Contenido actualizado exitosamente.</p>";
            } else {
                echo "<p style='color: red;'>Error al actualizar: " . $sql . "<br>" . $conn->error . "</p>";
            }

            // Redirigir a la página principal después de la edición
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color: red;'>Datos incompletos para editar.</p>";
        }
    }
    ?>

    <h2>Editar Contenido</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="idClase10">Seleccionar Clase:</label>
        <select id="idClase10" name="idClase10" required>
            <?php
            $sql = "SELECT idClase, titulo FROM clases";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['idClase'] == $idClase10) ? "selected" : "";
                    echo "<option value='" . $row['idClase'] . "' $selected>" . $row['titulo'] . "</option>";
                }
            } else {
                echo "<option value=''>No hay clases disponibles</option>";
            }
            ?>
        </select>

        <textarea id="editor" name="contenido"><?php echo $contenido; ?></textarea>

        <label for="imagen">Seleccionar Imagen:</label>
        <input type="file" id="imagen" name="imagen">

        <button type="submit" name="editar">Guardar Cambios</button>
    </form>
</body>
</html>
