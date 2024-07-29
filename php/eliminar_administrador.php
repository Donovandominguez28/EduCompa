<?php
include "../php/conexion.php";

if (isset($_GET['idAdmin'])) {
    $idAdmin = $_GET['idAdmin'];

    $sql = "DELETE FROM administrador WHERE idAdmin = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $idAdmin);

    if ($stmt->execute()) {
        echo '<script>
        alert("Administrador eliminado exitosamente.");
        window.location.href = "../html/administradoresAdmin.php";
      </script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID de administrador no proporcionado";
}
?>
