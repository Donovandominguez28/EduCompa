<?php
include "../php/session_check3.php";
include '../php/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Estudiantes</title>
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
            <h2><i class="bi bi-table"></i> Administrar Estudiantes</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Carnet</th>
                    <th>Nombre Completo</th>
                    <th>Foto de Perfil</th>
                    <th>Año Bachillerato</th>
                    <th>Sección</th>
                    <th>Especialidad</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../php/conexion.php';
            $sql = "SELECT * FROM estudiantes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['carnet'] . "</td>";
                    echo "<td>" . $row['nombreCompleto'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['fotoPerfil']) . "' alt='Foto de Perfil' width='100'></td>";
                    echo "<td>" . $row['añoBachi'] . "</td>";
                    echo "<td>" . $row['seccion'] . "</td>";
                    echo "<td>" . $row['especialidad'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['contrasena'] . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editModal' 
                                    data-carnet='" . $row['carnet'] . "' 
                                    data-nombreCompleto='" . $row['nombreCompleto'] . "' 
                                    data-email='" . $row['email'] . "' 
                                    data-añoBachi='" . $row['añoBachi'] . "' 
                                    data-seccion='" . $row['seccion'] . "' 
                                    data-especialidad='" . $row['especialidad'] . "'>
                                <i class='bi bi-pencil'></i> Editar
                            </button>
                        </td>";
                    echo "<td>
                            <button class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#confirmDeleteModal' 
                                    data-carnet='" . $row['carnet'] . "'>
                                <i class='bi bi-trash'></i> Eliminar
                            </button>
                        </td>";                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No hay estudiantes registrados.</td></tr>";
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
                    <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarEstudiante.php">
                        <div class="mb-3">
                            <label for="addCarnet" class="form-label">Carnet</label>
                            <input type="number" class="form-control" id="addCarnet" name="carnet" required>
                        </div>
                        <div class="mb-3">
                            <label for="addNombreCompleto" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="addNombreCompleto" name="nombreCompleto" required>
                        </div>
                        <div class="mb-3">
                            <label for="addFotoPerfil" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="addFotoPerfil" name="fotoPerfil" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="addAñoBachi" class="form-label">Año Bachillerato</label>
                            <input type="number" class="form-control" id="addAñoBachi" name="añoBachi" required>
                        </div>
                        <div class="mb-3">
                            <label for="addSeccion" class="form-label">Sección</label>
                            <input type="text" class="form-control" id="addSeccion" name="seccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEspecialidad" class="form-label">Especialidad</label>
                            <input type="text" class="form-control" id="addEspecialidad" name="especialidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="addContrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="addContrasena" name="contrasena" required>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Estudiante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarEstudiante.php">
                        <input type="hidden" id="editCarnet" name="carnet">
                        <div class="mb-3">
                            <label for="editNombreCompleto" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="editNombreCompleto" name="nombreCompleto" required>
                        </div>
                        <div class="mb-3">
                            <label for="editFotoPerfil" class="form-label">Foto de Perfil (dejar en blanco si no se desea cambiar)</label>
                            <input type="file" class="form-control" id="editFotoPerfil" name="fotoPerfil" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editAñoBachi" class="form-label">Año Bachillerato</label>
                            <input type="number" class="form-control" id="editAñoBachi" name="añoBachi" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSeccion" class="form-label">Sección</label>
                            <input type="text" class="form-control" id="editSeccion" name="seccion" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEspecialidad" class="form-label">Especialidad</label>
                            <input type="text" class="form-control" id="editEspecialidad" name="especialidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="editContrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="editContrasena" name="contrasena" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="bi bi-trash"></i> Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este estudiante?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="../php/eliminarEstudiante.php">
                        <input type="hidden" id="deleteCarnet" name="carnet">
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
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var carnet = button.getAttribute('data-carnet');
                var nombreCompleto = button.getAttribute('data-nombreCompleto');
                var email = button.getAttribute('data-email');
                var añoBachi = button.getAttribute('data-añoBachi');
                var seccion = button.getAttribute('data-seccion');
                var especialidad = button.getAttribute('data-especialidad');

                var editForm = document.getElementById('editForm');
                editForm.querySelector('#editCarnet').value = carnet;
                editForm.querySelector('#editNombreCompleto').value = nombreCompleto;
                editForm.querySelector('#editEmail').value = email;
                editForm.querySelector('#editAñoBachi').value = añoBachi;
                editForm.querySelector('#editSeccion').value = seccion;
                editForm.querySelector('#editEspecialidad').value = especialidad;
            });

            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var carnet = button.getAttribute('data-carnet');
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.querySelector('#deleteCarnet').value = carnet;
            });
        });
    </script>
</body>
</html>
