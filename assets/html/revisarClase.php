<?php
include "../php/session_check4.php";
include '../php/conexion.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleAdmin.css">
</head>
<body>

    <!-- Barra de navegación -->
    <?php include "../html/navBarProfesor.php"; ?>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Tabla CRUD -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="bi bi-table"></i> Administrar Contenidos de Clases</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Multimedia</th>
                    <th>Link</th>
                    <th>Clase Asociada</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../php/conexion.php';
            $sql = "SELECT c.idContenido, c.titulo, c.contenido, c.multimedia, c.link, c.idClase2, cl.titulo AS tituloClase
                    FROM contenidoclases c
                    LEFT JOIN clases cl ON c.idClase2 = cl.idClase";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idContenido'] . "</td>";
                    echo "<td>" . $row['titulo'] . "</td>";
                    echo "<td>" . $row['contenido'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['multimedia']) . "' alt='Multimedia' width='100'></td>";
                    echo "<td><a href='" . $row['link'] . "' target='_blank'>" . $row['link'] . "</a></td>";
                    echo "<td>" . $row['tituloClase'] . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editModal' 
                                    data-id='" . $row['idContenido'] . "' 
                                    data-titulo='" . $row['titulo'] . "' 
                                    data-contenido='" . $row['contenido'] . "' 
                                    data-link='" . $row['link'] . "' 
                                    data-idclase2='" . $row['idClase2'] . "'>
                                <i class='bi bi-pencil'></i> Editar
                            </button>
                        </td>";
                    echo "<td>
                            <button class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#confirmDeleteModal' 
                                    data-idcontenido='" . $row['idContenido'] . "'>
                                <i class='bi bi-trash'></i> Eliminar
                            </button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay contenidos registrados.</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>

    </div>

<!-- Modal para agregar -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Contenido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarContenidoClase.php">
                    <div class="mb-3">
                        <label for="addTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="addTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="addContenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="addContenido" name="contenido" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addMultimedia" class="form-label">Multimedia</label>
                        <input type="file" class="form-control" id="addMultimedia" name="multimedia" accept="image/*,video/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="addLink" class="form-label">Link</label>
                        <input type="url" class="form-control" id="addLink" name="link">
                    </div>
                    <div class="mb-3">
                        <label for="addIdClase2" class="form-label">Clase Asociada</label>
                        <select class="form-select" id="addIdClase2" name="idClase2" required>
                            <?php
                            include '../php/conexion.php';
                            $sql = "SELECT idClase, titulo FROM clases";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['idClase'] . "'>" . $row['titulo'] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Contenido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarContenido.php">
                    <input type="hidden" id="editIdContenido" name="idContenido">
                    <div class="mb-3">
                        <label for="editTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editContenido" class="form-label">Contenido</label>
                        <textarea class="form-control" id="editContenido" name="contenido" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editMultimedia" class="form-label">Multimedia (dejar en blanco si no se desea cambiar)</label>
                        <input type="file" class="form-control" id="editMultimedia" name="multimedia" accept="image/*,video/*">
                    </div>
                    <div class="mb-3">
                        <label for="editLink" class="form-label">Link</label>
                        <input type="url" class="form-control" id="editLink" name="link">
                    </div>
                    <div class="mb-3">
                        <label for="editIdClase2" class="form-label">Clase Asociada</label>
                        <select class="form-select" id="editIdClase2" name="idClase2" required>
                            <?php
                            include '../php/conexion.php';
                            $sql = "SELECT idClase, titulo FROM clases";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['idClase'] . "'>" . $row['titulo'] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para confirmar eliminación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="bi bi-trash"></i> Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este contenido?</p>
                <form id="deleteForm" method="POST" action="../php/eliminarContenido.php">
                    <input type="hidden" id="deleteIdContenido" name="idContenido">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/bootstrap.bundle.min.js"></script>
<script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var titulo = button.getAttribute('data-titulo');
        var contenido = button.getAttribute('data-contenido');
        var link = button.getAttribute('data-link');
        var idClase2 = button.getAttribute('data-idclase2');

        var modalTitle = editModal.querySelector('.modal-title');
        var modalBodyInputId = editModal.querySelector('.modal-body input[name="idContenido"]');
        var modalBodyInputTitulo = editModal.querySelector('.modal-body input[name="titulo"]');
        var modalBodyTextareaContenido = editModal.querySelector('.modal-body textarea[name="contenido"]');
        var modalBodyInputLink = editModal.querySelector('.modal-body input[name="link"]');
        var modalBodySelectIdClase2 = editModal.querySelector('.modal-body select[name="idClase2"]');

        modalBodyInputId.value = id;
        modalBodyInputTitulo.value = titulo;
        modalBodyTextareaContenido.value = contenido;
        modalBodyInputLink.value = link;
        modalBodySelectIdClase2.value = idClase2;
    });

    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var idContenido = button.getAttribute('data-idcontenido');

        var modalBodyInputIdContenido = confirmDeleteModal.querySelector('.modal-body input[name="idContenido"]');

        modalBodyInputIdContenido.value = idContenido;
    });
</script>

</body>
</html>
