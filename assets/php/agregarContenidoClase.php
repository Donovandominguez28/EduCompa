<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = !empty($_POST['titulo']) ? $_POST['titulo'] : NULL;
    $contenido = !empty($_POST['contenido']) ? $_POST['contenido'] : NULL;
    $link = !empty($_POST['link']) ? $_POST['link'] : NULL;
    $idClase2 = !empty($_POST['idClase2']) ? $_POST['idClase2'] : NULL;

    $multimedia = NULL;
    if (!empty($_FILES['multimedia']['tmp_name'])) {
        $multimedia = file_get_contents($_FILES['multimedia']['tmp_name']);
    }

    $sql = "INSERT INTO contenidoclases (titulo, contenido, multimedia, link, idClase2) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $titulo, $contenido, $multimedia, $link, $idClase2);

    if ($stmt->execute()) {
        echo "<script>alert('Contenido agregado exitosamente.'); window.location.href = '../html/revisarClase.php';</script>";
    } else {
        echo "<script>alert('Error al agregar contenido.'); window.location.href = '../html/revisarClase.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
