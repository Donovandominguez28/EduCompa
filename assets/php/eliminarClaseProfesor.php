<?php
include '../php/session_check4.php';
include '../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idClase = $_POST['idClase'];

    // Mostrar valor de idClase para depuración
    error_log("ID de clase: " . $idClase);

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Preparar la consulta para eliminar el contenido de la clase
        $sqlContenido = "DELETE FROM contenidoclases WHERE idClase2 = ?";
        $stmtContenido = $conn->prepare($sqlContenido);

        if ($stmtContenido === false) {
            throw new Exception("Error al preparar la consulta para eliminar el contenido: " . $conn->error);
        }

        // Vincular parámetros para el contenido
        $stmtContenido->bind_param("i", $idClase);

        // Ejecutar la consulta para eliminar el contenido
        if (!$stmtContenido->execute()) {
            throw new Exception("Error al ejecutar la consulta para eliminar el contenido: " . $stmtContenido->error);
        }

        // Preparar la consulta para eliminar la clase
        $sqlClase = "DELETE FROM clases WHERE idClase = ?";
        $stmtClase = $conn->prepare($sqlClase);

        if ($stmtClase === false) {
            throw new Exception("Error al preparar la consulta para eliminar la clase: " . $conn->error);
        }

        // Vincular parámetros para la clase
        $stmtClase->bind_param("i", $idClase);

        // Ejecutar la consulta para eliminar la clase
        if (!$stmtClase->execute()) {
            throw new Exception("Error al ejecutar la consulta para eliminar la clase: " . $stmtClase->error);
        }

        // Si todo fue exitoso, confirmar la transacción
        $conn->commit();
        echo "<script>alert('Clase y su contenido eliminado correctamente.'); window.location.href='../html/clasesProfesor.php';</script>";

    } catch (Exception $e) {
        // En caso de error, deshacer la transacción
        $conn->rollback();
        error_log($e->getMessage());
        echo "<script>alert('Ha ocurrido un error al eliminar la clase y su contenido. Inténtelo nuevamente.'); window.history.back();</script>";
    }

    // Cerrar las declaraciones y la conexión
    $stmtContenido->close();
    $stmtClase->close();
    $conn->close();
}
?>
