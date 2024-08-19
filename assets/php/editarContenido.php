<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idContenido = $_POST['idContenido'];
    $titulo = !empty($_POST['titulo']) ? $_POST['titulo'] : NULL;
    $contenido = !empty($_POST['contenido']) ? $_POST['contenido'] : NULL;
    $link = !empty($_POST['link']) ? $_POST['link'] : NULL;
    $idClase2 = !empty($_POST['idClase2']) ? $_POST['idClase2'] : NULL;

    $sql = "UPDATE contenidoclases SET titulo = ?, contenido = ?, link = ?, idClase2 = ?";

    if (!empty($_FILES['multimedia']['tmp_name'])) {
        $multimedia = file_get_contents($_FILES['multimedia']['tmp_name']);
        $sql .= ", multimedia = ?";
    }

    $sql .= " WHERE idContenido = ?";
    
    $stmt = $conn->prepare($sql);
    
    if (!empty($_FILES['multimedia']['tmp_name'])) {
        $stmt->bind_param("sssibi", $titulo, $contenido, $link, $idClase2, $multimedia, $idContenido);
    } else {
        $stmt->bind_param("sssii", $titulo, $contenido, $link, $idClase2, $idContenido);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Contenido actualizado exitosamente.'); window.location.href = '../html/revisarClase.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar contenido.'); window.location.href = '../html/evisarClase.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
