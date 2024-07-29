<?php
session_start();
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $top = $_POST['top'];
    $nombreApellido = $_POST['nombreApellido'];
    $descripcion = $_POST['descripcion'];

    // Procesar la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = $_FILES['foto']['tmp_name'];
        $fotoContenido = file_get_contents($foto); // Leer el contenido del archivo

        // Insertar datos en la tabla podio
        $sql = "INSERT INTO podio (top, foto, nombreApellido, descripcion) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $top, $fotoContenido, $nombreApellido, $descripcion);

        if ($stmt->execute()) {
            echo '<script>
                alert("Usuario agregado al podio con exito.");
                window.location.href = "../html/podio.php";
              </script>';
        } else {
            echo "Error al insertar datos: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Error al subir la imagen.";
    }

    $conn->close();
}
?>
