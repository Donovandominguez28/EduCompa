<?php
    session_start();
    include_once "../php/conexion.php";
    $outgoing_id = $_SESSION['carnet'];
    $sql = "SELECT * FROM estudiantes WHERE NOT carnet = {$outgoing_id} ORDER BY carnet DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "../php/data.php";
    }
    echo $output;
?>