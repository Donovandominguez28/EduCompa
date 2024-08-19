<?php
include "../php/session_check3.php";
include '../php/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Profesores</title>
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
            <h2><i class="bi bi-table"></i> Administrar Profesores</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID Profesor</th>
                    <th>Nombre Completo</th>
                    <th>Foto de Perfil</th>
                    <th>Materia Impartida</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include '../php/conexion.php';
            $sql = "SELECT * FROM profesor";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idProfesor'] . "</td>";
                    echo "<td>" . $row['nombreCompleto'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['fotoPerfil']) . "' alt='Foto de Perfil' width='100'></td>";
                    echo "<td>" . $row['materiaInpartida'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['contrasena'] . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editModal' 
                                    data-idProfesor='" . $row['idProfesor'] . "' 
                                    data-nombreCompleto='" . $row['nombreCompleto'] . "' 
                                    data-email='" . $row['email'] . "' 
                                    data-materiaInpartida='" . $row['materiaInpartida'] . "'>
                                <i class='bi bi-pencil'></i> Editar
                            </button>
                        </td>";
                    echo "<td>
                            <button class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#confirmDeleteModal' 
                                    data-idProfesor='" . $row['idProfesor'] . "'>
                                <i class='bi bi-trash'></i> Eliminar
                            </button>
                        </td>";                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No hay profesores registrados.</td></tr>";
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
                    <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Profesor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarProfesor.php">
                        <div class="mb-3">
                            <label for="addIdProfesor" class="form-label">ID Profesor</label>
                            <input type="number" class="form-control" id="addIdProfesor" name="idProfesor" required>
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
                            <label for="addMateriaInpartida" class="form-label">Materia Impartida</label>
                            <input type="text" class="form-control" id="addMateriaInpartida" name="materiaInpartida" required>
                        </div>
                        <div class="mb-3">
                            <label for="addEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="email" required>
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
                <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarProfesor.php">
                    <input type="hidden" id="editIdProfesor" name="idProfesor">
                    <div class="mb-3">
                        <label for="editNombreCompleto" class="form-label">Nombre Completo</label>
                        <input type="text" class="form-control" id="editNombreCompleto" name="nombreCompleto">
                    </div>
                    <div class="mb-3">
                        <label for="editFotoPerfil" class="form-label">Foto de Perfil (dejar en blanco si no se desea cambiar)</label>
                        <input type="file" class="form-control" id="editFotoPerfil" name="fotoPerfil" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editMateriaInpartida" class="form-label">Materia Impartida</label>
                        <input type="text" class="form-control" id="editMateriaInpartida" name="materiaInpartida">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="editContrasena" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="editContrasena" name="contrasena">
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


    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="bi bi-trash"></i> Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este profesor? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="../php/eliminarProfesor.php">
                        <input type="hidden" id="deleteIdProfesor" name="idProfesor">
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
        // Llenar el modal de editar con los datos del profesor
        // Llenar el modal de editar con los datos del profesor
var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var idProfesor = button.getAttribute('data-idProfesor');
    var nombreCompleto = button.getAttribute('data-nombreCompleto');
    var email = button.getAttribute('data-email');
    var materiaInpartida = button.getAttribute('data-materiaInpartida');
    var contrasena = button.getAttribute('data-contrasena');

    var idProfesorInput = editModal.querySelector('#editIdProfesor');
    var nombreCompletoInput = editModal.querySelector('#editNombreCompleto');
    var emailInput = editModal.querySelector('#editEmail');
    var materiaInpartidaInput = editModal.querySelector('#editMateriaInpartida');
    var contrasenaInput = editModal.querySelector('#editContrasena');

    idProfesorInput.value = idProfesor;
    nombreCompletoInput.value = nombreCompleto;
    emailInput.value = email;
    materiaInpartidaInput.value = materiaInpartida;
    contrasenaInput.value = contrasena;
});

        // Llenar el modal de eliminación con el ID del profesor
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var idProfesor = button.getAttribute('data-idProfesor');
            var deleteIdProfesorInput = confirmDeleteModal.querySelector('#deleteIdProfesor');
            deleteIdProfesorInput.value = idProfesor;
        });
    </script>
</body>
</html>
