<?php
include "../php/session_check3.php";
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
    <?php include "../html/navBarAdmin.php"; ?>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <!-- Tabla CRUD -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="bi bi-table"></i> Administrar Libros</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estudiante Asignado</th>
                    <th>Imagen</th>
                    <th>Link</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../php/conexion.php';
            $sql = "SELECT b.idLibro, b.titulo, b.descripcion, b.libroimg, b.link, b.carnet6, e.nombreCompleto 
                    FROM biblioteca b
                    INNER JOIN estudiantes e ON b.carnet6 = e.carnet";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idLibro'] . "</td>";
                    echo "<td>" . $row['titulo'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['nombreCompleto'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['libroimg']) . "' alt='Imagen del Libro' width='100'></td>";
                    echo "<td>" . $row['link'] . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editModal' 
                                    data-id='" . $row['idLibro'] . "' 
                                    data-titulo='" . $row['titulo'] . "' 
                                    data-descripcion='" . $row['descripcion'] . "' 
                                    data-link='" . $row['link'] . "' 
                                    data-carnet6='" . $row['carnet6'] . "'>
                              <i class='bi bi-pencil'></i> Editar
                            </button>
                          </td>";
                    echo "<td>
                            <button class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#confirmDeleteModal' 
                                    data-id='" . $row['idLibro'] . "'>
                              <i class='bi bi-trash'></i> Eliminar
                            </button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay libros registrados.</td></tr>";
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
                    <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarLibrosAdmin.php">
                        <div class="mb-3">
                            <label for="addIdLibro" class="form-label">ID del Libro</label>
                            <input type="text" class="form-control" id="addIdLibro" name="idLibro" required>
                        </div>
                        <div class="mb-3">
                            <label for="addTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="addTitulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="addDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="addDescripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="addLibroImg" class="form-label">Imagen del Libro</label>
                            <input type="file" class="form-control" id="addLibroImg" name="libroimg" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="addLink" class="form-label">Enlace</label>
                            <input type="text" class="form-control" id="addLink" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="addCarnet6" class="form-label">Estudiante Asignado</label>
                            <select class="form-select" id="addCarnet6" name="carnet6" required>
                                <?php
                                include '../php/conexion.php';
                                $sql = "SELECT carnet, nombreCompleto FROM estudiantes";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['carnet'] . "'>" . $row['nombreCompleto'] . "</option>";
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
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarLibros.php">
                        <input type="hidden" id="editIdLibro" name="idLibro">
                        <div class="mb-3">
                            <label for="editTitulo" class="form-label">Título</label>
                            <input type="text" class="form-control" id="editTitulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editDescripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editLibroImg" class="form-label">Imagen del Libro</label>
                            <input type="file" class="form-control" id="editLibroImg" name="libroimg" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="editLink" class="form-label">Enlace</label>
                            <input type="text" class="form-control" id="editLink" name="link">
                        </div>
                        <div class="mb-3">
                            <label for="editCarnet6" class="form-label">Estudiante Asignado</label>
                            <select class="form-select" id="editCarnet6" name="carnet6" required>
                                <?php
                                include '../php/conexion.php';
                                $sql = "SELECT carnet, nombreCompleto FROM estudiantes";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['carnet'] . "'>" . $row['nombreCompleto'] . "</option>";
                                    }
                                }
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
                    ¿Estás seguro de que deseas eliminar este libro?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="../php/eliminarLibro.php">
                        <input type="hidden" id="deleteIdLibro" name="idLibro">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Botón flotante para cambiar modo -->
  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btnFloat btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
      <i class="bi bi-circle-half"></i> <!-- Usar ícono de Bootstrap para modo automático -->
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
          <i class="bi bi-sun"></i>
          Claro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
          <i class="bi bi-moon"></i> <!-- Usar ícono de Bootstrap para modo oscuro -->
          Oscuro
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
          <i class="bi bi-circle-half"></i> <!-- Usar ícono de Bootstrap para modo automático -->
          Automático
        </button>
      </li>
    </ul>
  </div>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/scriptAdmin.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var titulo = button.getAttribute('data-titulo');
                var descripcion = button.getAttribute('data-descripcion');
                var link = button.getAttribute('data-link');
                var carnet6 = button.getAttribute('data-carnet6');

                var modalTitle = editModal.querySelector('.modal-title');
                var idInput = editModal.querySelector('#editIdLibro');
                var tituloInput = editModal.querySelector('#editTitulo');
                var descripcionInput = editModal.querySelector('#editDescripcion');
                var linkInput = editModal.querySelector('#editLink');
                var carnet6Select = editModal.querySelector('#editCarnet6');

                idInput.value = id;
                tituloInput.value = titulo;
                descripcionInput.value = descripcion;
                linkInput.value = link;
                carnet6Select.value = carnet6;
            });

            var deleteModal = document.getElementById('confirmDeleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');

                var idInput = deleteModal.querySelector('#deleteIdLibro');
                idInput.value = id;
            });
        });
    </script>
</body>
</html>
