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

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE podio SET top = ?, foto = ?, nombreApellido = (SELECT nombreCompleto FROM estudiantes WHERE carnet = ?), descripcion = ? WHERE idPodio = ?");
    $stmt->bind_param("ibssi", $top, $foto, $estudiante, $descripcion, $idPodio);
    
    if ($stmt->execute()) {
        echo "<script>alert('Podio actualizado exitosamente.'); window.location.href='../html/podioProfesor.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar podio.'); window.location.href='../html/podioProfesor.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
