<?php
if (isset($_SESSION['carnet'])) {
    include_once "../php/conexion.php";

    $outgoing_id = $_SESSION['carnet'];
    $output = "";

    // Consulta para obtener todos los estudiantes que han enviado mensajes al usuario actual
    $sql = "SELECT DISTINCT e.* 
            FROM estudiantes e
            INNER JOIN chat c ON e.carnet = c.outgoing_msg_id
            WHERE c.incoming_msg_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $outgoing_id);
        $stmt->execute();
        $query = $stmt->get_result();

        while ($row = $query->fetch_assoc()) {
            $sql2 = "SELECT * FROM chat WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) 
                     OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY idChat DESC LIMIT 1";
            if ($stmt2 = $conn->prepare($sql2)) {
                $stmt2->bind_param("iiii", $outgoing_id, $row['carnet'], $row['carnet'], $outgoing_id);
                $stmt2->execute();
                $query2 = $stmt2->get_result();
                $row2 = $query2->fetch_assoc();
                
                $result = ($query2->num_rows > 0) ? $row2['msg'] : "No hay mensajes disponibles";
                $msg = (mb_strlen($result) > 28) ? mb_substr($result, 0, 28) . '...' : $result;
                $you = (isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? "Tu: " : "";
                $hid_me = ($outgoing_id == $row['carnet']) ? "hide" : "";

                $output .= '<a href="../php/chat.php?carnet=' . htmlspecialchars($row['carnet']) . '">
                                <div class="content">
                                    <img src="data:image/jpeg;base64,' . base64_encode($row['fotoPerfil']) . '" alt="">
                                    <div class="details">
                                        <span>' . htmlspecialchars($row['nombreCompleto']) . '</span>
                                        <p>' . htmlspecialchars($you . $msg) . '</p>
                                    </div>
                                </div>
                            </a>';
            } else {
                // Manejo de error en la preparación de la segunda declaración
                error_log("Error preparing second statement: " . $conn->error);
            }
        }

        $stmt->close();
    } else {
        // Manejo de error en la preparación de la primera declaración
        error_log("Error preparing first statement: " . $conn->error);
    }

    echo $output;
} else {
    echo "No ha iniciado sesión.";
}
?>
