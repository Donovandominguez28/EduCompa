<?php
include "../php/conexion.php";

$sql_contenido = "SELECT * FROM contenidoClases";
$result_contenido = $conn->query($sql_contenido);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Clase</title>
    <link rel="stylesheet" href="../css/styleadmin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
</head>
<body>
    <header class="header">
        <section class="flex">
           <img class="logo" src="../img/educompalogo.jpg" alt="">
        </section>
    </header>

    <div class="side-bar">
        <br>
        <br>
        <?php include "../html/perfilProfesor.php"; ?>
        <hr>
        <?php include "../html/navProfesor.php"; ?>
    </div>

    <section class="home-grid">
        <div class="containerform">
            <div class="cardform">
                <h1 class="h1">Agregar Contenido a Clase</h1>
                <form action="../php/agregar_contenido.php" method="POST" enctype="multipart/form-data">
                    <div class="inputBox1">
                        <input type="text" name="idClase1" required>
                        <span>ID Clase</span>
                    </div>
                    <div class="inputBox1">
                        <input type="text" name="contenido" required>
                        <span>Contenido</span>
                    </div>
                    <div class="inputBox1">
                        <input type="file" name="multimedia" accept="image/*,video/*" required>
                        <span>Multimedia</span>
                    </div>
                    <div class="inputBox1">
                        <input type="text" name="link" required>
                        <span>Link</span>
                    </div>
                    <button class="save" type="submit">Agregar</button>
                </form>
            </div>
        </div>
        <h1 class="heading">Contenido Agregado</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Contenido</th>
                    <th scope="col">ID Clase</th>
                    <th scope="col">Contenido</th>
                    <th scope="col">Multimedia</th>
                    <th scope="col">Link</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result_contenido->num_rows > 0) {
                while ($row_contenido = $result_contenido->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row_contenido['idContenido']}</td>";
                    echo "<td>{$row_contenido['idClase2']}</td>";
                    echo "<td>{$row_contenido['contenido']}</td>";
                    
                    echo "<td>";
                    // Verifica si hay un archivo multimedia y si se ha subido correctamente                        
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row_contenido['multimedia']) . "' alt='Multimedia' width='50'>";

                    
                    echo "</td>";
                    
                    echo "<td>{$row_contenido['link']}</td>";
                    echo "<td><a href='../html/editarContenido.php?idContenido={$row_contenido['idContenido']}' class='edit-button'>
                            <svg class='edit-svgIcon' viewBox='0 0 512 512'>
                                <path d='M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z'></path>
                            </svg>
                        </a></td>";
                    echo "<td><a href='../php/eliminar_contenido.php?idContenido={$row_contenido['idContenido']}' class='delete-button'>
                            <svg class='delete-svgIcon' viewBox='0 0 448 512'>
                                <path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'></path>
                            </svg>
                        </a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay contenido agregado.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
    <script src="../js/script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
