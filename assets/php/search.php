<?php
session_start();
include_once "../php/conexion.php";

if (isset($_SESSION['carnet']) && isset($_POST['searchTerm'])) {
    $outgoing_id = $_SESSION['carnet'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // Consulta para buscar usuarios que no sean el usuario actual y coincidan con el término de búsqueda
    $sql = "SELECT * FROM estudiantes 
            WHERE carnet != ? 
            AND nombreCompleto LIKE ?";
    
    $stmt = $conn->prepare($sql);
    
    // Agregamos los signos de porcentaje (%) para que busque coincidencias parciales en el nombre
    $searchTerm = "%{$searchTerm}%";

    if ($stmt) {
        $stmt->bind_param("is", $outgoing_id, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $output = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Obtener la última mensaje entre el usuario actual y el usuario encontrado
                $sql2 = "SELECT * FROM chat WHERE (incoming_msg_id = ? AND outgoing_msg_id = ?) 
                         OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY idChat DESC LIMIT 1";
                $stmt2 = $conn->prepare($sql2);

                if ($stmt2) {
                    $stmt2->bind_param("iiii", $outgoing_id, $row['carnet'], $row['carnet'], $outgoing_id);
                    $stmt2->execute();
                    $query2 = $stmt2->get_result();
                    $row2 = $query2->fetch_assoc();
                    
                    $last_message = ($query2->num_rows > 0) ? htmlspecialchars($row2['msg']) : "No hay mensajes disponibles";
                    $last_message = (mb_strlen($last_message) > 28) ? mb_substr($last_message, 0, 28) . '...' : $last_message;
                    $you_sent = (isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? "Tu: " : "";

                    // Construir el HTML para cada usuario encontrado
                    $output .= '<a href="../php/chat.php?carnet=' . htmlspecialchars($row['carnet']) . '">
                                    <div class="content">
                                        <img src="data:image/jpeg;base64,' . base64_encode($row['fotoPerfil']) . '" alt="Foto de perfil">
                                        <div class="details">
                                            <span>' . htmlspecialchars($row['nombreCompleto']) . '</span>
                                            <p>' . htmlspecialchars($you_sent . $last_message) . '</p>
                                        </div>
                                    </div>
                                </a>';
                } else {
                    // Manejo de error en la preparación de la segunda consulta
                    error_log("Error preparing second statement: " . $conn->error);
                }
            }
        } else {
            $output = 'No se encontraron usuarios relacionados con el término de búsqueda';
        }

        echo $output;
        
        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Error: No se pudo preparar la consulta";
    }
} else {
    include "../php/data.php"; // Incluir el archivo data.php si no se proporcionó un término de búsqueda o si no se inició sesión
}
?>
