<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPodio = $_POST['idPodio'];
    
    // Fetch current values from the database
    $stmt = $conn->prepare("SELECT top, foto, nombreApellido, descripcion FROM podio WHERE idPodio = ?");
    $stmt->bind_param("i", $idPodio);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($currentTop, $currentFoto, $currentNombreApellido, $currentDescripcion);
    
    if ($stmt->num_rows === 1) {
        $stmt->fetch();
    } else {
        echo "<script>alert('Registro no encontrado.'); window.location.href='../html/podioProfesor.php';</script>";
        exit;
    }
    $stmt->close();
    
    // Get the new values from the form, or use current values if empty
    $top = !empty($_POST['top']) ? $_POST['top'] : $currentTop;
    $estudiante = !empty($_POST['estudiante']) ? $_POST['estudiante'] : $currentNombreApellido;
    $descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : $currentDescripcion;
    $foto = !empty($_FILES['foto']['tmp_name']) ? file_get_contents($_FILES['foto']['tmp_name']) : $currentFoto;

    // Check if another student is already in the new top position
    $stmtCheck = $conn->prepare("SELECT idPodio FROM podio WHERE top = ? AND idPodio != ?");
    $stmtCheck->bind_param("ii", $top, $idPodio);
    $stmtCheck->execute();
    $stmtCheck->store_result();

    if ($stmtCheck->num_rows > 0) {
        // Another student holds the new top position, we need to swap
        $stmtCheck->bind_result($otherIdPodio);
        $stmtCheck->fetch();
        $stmtCheck->close();

        // Swap the other student's position to the currentTop
        $stmtSwap = $conn->prepare("UPDATE podio SET top = ? WHERE idPodio = ?");
        $stmtSwap->bind_param("ii", $currentTop, $otherIdPodio);
        $stmtSwap->execute();
        $stmtSwap->close();
    } else {
        $stmtCheck->close();
    }

    // Update the current student's podio record
    $stmtUpdate = $conn->prepare("UPDATE podio SET top = ?, foto = ?, nombreApellido = (SELECT nombreCompleto FROM estudiantes WHERE carnet = ?), descripcion = ? WHERE idPodio = ?");
    $stmtUpdate->bind_param("isssi", $top, $foto, $estudiante, $descripcion, $idPodio);
    
    if ($stmtUpdate->execute()) {
        echo "<script>alert('Podio actualizado exitosamente.'); window.location.href='../html/podioProfesor.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar podio.'); window.location.href='../html/podioProfesor.php';</script>";
    }

    $stmtUpdate->close();
    $conn->close();
}
?>
