<?php
session_start();
include_once "../php/conexion.php";

if (isset($_SESSION['carnet'])) {
    $outgoing_id = $_SESSION['carnet'];
    // Verifica si incoming_id está definido y no está vacío
    $incoming_id = isset($_POST['incoming_id']) ? mysqli_real_escape_string($conn, $_POST['incoming_id']) : '';
    $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, $_POST['message']) : '';

    if (!empty($message) && !empty($incoming_id)) {
        $sql = "INSERT INTO chat (incoming_msg_id, outgoing_msg_id, msg) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $incoming_id, $outgoing_id, $message);
        if ($stmt->execute()) {
            echo "Message inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Message or incoming_id is empty.";
    }
} else {
    echo "User not authenticated.";
}
?>
