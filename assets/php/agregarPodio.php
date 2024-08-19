<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $top = $_POST['top'];
    $foto = $_POST['foto'];
    $descripcion = $_POST['descripcion'];
    $carnet = $_POST['estudiante'];

    // Obtener nombre y la foto del estudiante seleccionado
    $sql = "SELECT nombreCompleto, fotoPerfil FROM estudiantes WHERE carnet = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $carnet);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Verificar si se encontró el estudiante
    if ($row) {
        $nombreApellido = $row['nombreCompleto'];
        $fotoPerfil = $row['fotoPerfil']; // Recuperar la foto del perfil

        // Insertar en la tabla podio
        $sqlInsert = "INSERT INTO podio (top, foto, nombreApellido, descripcion) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("isss", $top, $fotoPerfil, $nombreApellido, $descripcion);

        if ($stmtInsert->execute()) {
            echo "<script>
                    alert('Registro agregado exitosamente.');
                    window.location.href = '../html/podio.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al agregar el registro.');
                    window.location.href = '../html/podio.php';
                  </script>";
        }

        $stmtInsert->close();
    } else {
        echo "<script>
                alert('Error: Estudiante no encontrado.');
                window.location.href = '../html/podio.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
