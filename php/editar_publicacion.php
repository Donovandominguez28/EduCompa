
<?php 
include "../php/conexion.php";

if (isset($_GET['idMural'])) {
    $idMural = intval($_GET['idMural']); // Asegúrate de que es un número entero
} else {
    die("ID de publicación no especificado");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $informacion = $_POST['informacion'];

    if (isset($_FILES['imagenMural']) && $_FILES['imagenMural']['size'] > 0) {
        $imagenMural = addslashes(file_get_contents($_FILES['imagenMural']['tmp_name']));
        $sql = "UPDATE mural SET imagenMural='$imagenMural', titulo='$titulo', informacion='$informacion' WHERE idMural = $idMural";
    } else {
        $sql = "UPDATE mural SET titulo='$titulo', informacion='$informacion' WHERE idMural = $idMural";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: ../html/publicacion.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>