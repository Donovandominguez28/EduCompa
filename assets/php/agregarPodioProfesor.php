<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $top = $_POST['top'];
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

        // Verificar si ya existen 3 registros en el top 1, 2 o 3
        $stmtCheck = $conn->prepare("SELECT COUNT(*) as total FROM podio WHERE top IN (1, 2, 3)");
        $stmtCheck->execute();
        $stmtCheck->bind_result($totalPodios);
        $stmtCheck->fetch();
        $stmtCheck->close();

        // Si ya hay 3 registros en los top 1, 2 o 3, no permitir agregar más
        if ($totalPodios >= 3) {
            echo "<script>
                    alert('Ya existen 3 estudiantes en el podio. No se pueden agregar más.');
                    window.location.href = '../html/podioProfesor.php';
                  </script>";
            exit; // Detener el proceso de agregar un nuevo registro
        }

        // Verificar si el top seleccionado ya está ocupado y hacer el intercambio de puestos
        $stmtCheckTop = $conn->prepare("SELECT idPodio, nombreApellido FROM podio WHERE top = ?");
        $stmtCheckTop->bind_param("i", $top);
        $stmtCheckTop->execute();
        $resultTop = $stmtCheckTop->get_result();

        if ($resultTop->num_rows > 0) {
            // Si el top está ocupado, intercambiar con el otro estudiante
            $rowTop = $resultTop->fetch_assoc();
            $idPodioExistente = $rowTop['idPodio'];
            $nombrePodioExistente = $rowTop['nombreApellido'];

            // Actualizar el top del estudiante existente
            $sqlUpdateTop = "UPDATE podio SET top = NULL WHERE idPodio = ?";
            $stmtUpdateTop = $conn->prepare($sqlUpdateTop);
            $stmtUpdateTop->bind_param("i", $idPodioExistente);
            $stmtUpdateTop->execute();
            $stmtUpdateTop->close();

            // Ahora insertar el nuevo estudiante
            $sqlInsert = "INSERT INTO podio (top, foto, nombreApellido, descripcion) VALUES (?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("isss", $top, $fotoPerfil, $nombreApellido, $descripcion);

            if ($stmtInsert->execute()) {
                // Ahora reasignar el top al estudiante que fue desplazado
                $newTop = $top == 1 ? 2 : ($top == 2 ? 3 : 1); // Ajuste según el top actual
                $sqlReassignTop = "UPDATE podio SET top = ? WHERE idPodio = ?";
                $stmtReassignTop = $conn->prepare($sqlReassignTop);
                $stmtReassignTop->bind_param("ii", $newTop, $idPodioExistente);
                $stmtReassignTop->execute();
                $stmtReassignTop->close();

                echo "<script>
                        alert('Registro agregado exitosamente con intercambio de top.');
                        window.location.href = '../html/podioProfesor.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error al agregar el registro.');
                        window.location.href = '../html/podioProfesor.php';
                      </script>";
            }

            $stmtInsert->close();
        } else {
            // Si el top no está ocupado, proceder con la inserción normal
            $sqlInsert = "INSERT INTO podio (top, foto, nombreApellido, descripcion) VALUES (?, ?, ?, ?)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bind_param("isss", $top, $fotoPerfil, $nombreApellido, $descripcion);

            if ($stmtInsert->execute()) {
                echo "<script>
                        alert('Registro agregado exitosamente.');
                        window.location.href = '../html/podioProfesor.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error al agregar el registro.');
                        window.location.href = '../html/podioProfesor.php';
                      </script>";
            }

            $stmtInsert->close();
        }
    } else {
        echo "<script>
                alert('Error: Estudiante no encontrado.');
                        window.location.href = '../html/podioProfesor.php';
              </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
