<?php
session_start();
include "../php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idPodio'])) {
    $idPodio = $_GET['idPodio'];

    // Obtener los datos actuales del podio
    $sql = "SELECT * FROM podio WHERE idPodio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idPodio);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Mostrar el formulario con los datos actuales para editar
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Podio</title>
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <div class="containerform">
        <div class="cardform">
            <h1 class="h1">Editar Estudiante en el Podio</h1>
            <form action="../php/editar_podio.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idPodio" value="<?php echo $row['idPodio']; ?>">
                <div class="inputBox1">
                    <input type="text" name="top" value="<?php echo $row['top']; ?>" required>
                    <span>Top</span>
                </div>
                <div class="inputBox1">
                    <input type="file" name="foto">
                    <span>Foto de perfil</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="nombreApellido" value="<?php echo $row['nombreApellido']; ?>" required>
                    <span>Nombre y Apellido</span>
                </div>
                <div class="inputBox1">
                    <input type="text" name="descripcion" value="<?php echo $row['descripcion']; ?>">
                    <span>Descripción</span>
                </div>
                <button class="save" type="submit">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
    } else {
        echo "No se encontró el registro del podio.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
