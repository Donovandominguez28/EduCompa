<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <header class="header">
        <section class="flex">
           <img class="logo" src="../img/educompalogo.jpg" alt="Logo">
        </section>
    </header>

    <div class="side-bar">
        <br>
        <br>
        <?php include "../html/perfilAdmin.php"; ?>
        <hr>
        <?php include "../html/navAdmin.php"; ?>
    </div>

    <section class="home-grid">
        <!-- Contenido principal con la tabla de estudiantes -->
        <h1 class="heading">Podio de los mejores estudiantes</h1>
        <a href="../html/agregarPodio.php" class="add-button">Agregar al podio</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Podio</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Top</th>
                    <th scope="col">Nombre y Apellido</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../php/conexion.php";

                // Obtener los datos de los estudiantes
                $sql = "SELECT * FROM podio";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['idPodio']}</td>
                                <td>";
                        if (!empty($row['foto'])) {
                            echo "<img src='data:image/jpeg;base64," . base64_encode($row['foto']) . "' alt='Foto' style='width: 100px; height: 100px; object-fit: cover;'>";
                        }
                        echo "</td>
                                <td>#{$row['top']}</td>
                                <td>{$row['nombreApellido']}</td>
                                <td>{$row['descripcion']}</td>
                                <td><a href='../html/editarPodio.php?idPodio={$row['idPodio']}' class='edit-button'>
                                        <svg class='edit-svgIcon' viewBox='0 0 512 512'>
                                            <path d='M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z'></path>
                                        </svg>
                                    </a></td>
                                <td><a href='javascript:void(0);' onclick='confirmarEliminacion({$row['idPodio']})' class='delete-button'>
                                        <svg class='delete-svgIcon' viewBox='0 0 448 512'>
                                            <path d='M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z'></path>
                                        </svg>
                                    </a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay registros en el podio</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <!-- custom js file link -->
    <script src="../js/script.js"></script>
    <script>
        function confirmarEliminacion(idPodio) {
            if (confirm("¿Estás seguro de eliminar?")) {
                window.location.href = `../php/eliminar_podio.php?idPodio=${idPodio}`;
            }
        }
    </script>
</body>
</html>
