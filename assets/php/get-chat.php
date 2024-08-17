<?php
session_start();
if (isset($_SESSION['carnet'])) {
    include_once "../php/conexion.php";
    
    $outgoing_id = $_SESSION['carnet'];
    
    // Verificar que 'incoming_id' exista en POST
    if (isset($_POST['incoming_id'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";

        // Consulta para obtener los mensajes entre los dos usuarios
        $sql = "SELECT chat.*, estudiantes.fotoPerfil 
                FROM chat 
                LEFT JOIN estudiantes ON estudiantes.carnet = chat.outgoing_msg_id
                WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?)
                   OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
                ORDER BY idChat";
        
        // Preparar la consulta
        if ($stmt = $conn->prepare($sql)) {
            // Vincular parámetros
            $stmt->bind_param("iiii", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['outgoing_msg_id'] == $outgoing_id) {
                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>' . htmlspecialchars($row['msg']) . '</p>
                                        </div>
                                    </div>';
                    } else {
                        $output .= '<div class="chat incoming">
                                        <img src="data:image/jpeg;base64,' . base64_encode($row['fotoPerfil']) . '" alt="Foto de perfil">
                                        <div class="details">
                                            <p>' . htmlspecialchars($row['msg']) . '</p>
                                        </div>
                                    </div>';
                    }
                }
            } else {
                $output .= '<div class="text">No hay mensajes disponibles. Una vez que envíe el mensaje, aparecerán aquí.</div>';
            }
            $stmt->close();
        } else {
            $output .= '<div class="text">Error al preparar la consulta.</div>';
        }
        echo $output;
    } else {
        echo '<div class="text">ID de destinatario no especificado.</div>';
    }
} else {
    echo '<div class="text">No ha iniciado sesión.</div>';
}
?>
