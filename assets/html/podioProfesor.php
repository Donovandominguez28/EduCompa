<?php
include "../php/session_check4.php";
include '../php/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Podio</title>
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
            <h2><i class="bi bi-table"></i> Administrar Podio</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID Podio</th>
                    <th>Top</th>
                    <th>Foto</th>
                    <th>Nombre y Apellido</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM podio";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['idPodio'] . "</td>";
                    echo "<td>" . $row['top'] . "</td>";
                    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['foto']) . "' alt='Foto' height='50'></td>";
                    echo "<td>" . $row['nombreApellido'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>
                            <button class='btn btn-warning btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editModal' 
                                    data-idpodio='" . $row['idPodio'] . "' 
                                    data-top='" . $row['top'] . "' 
                                    data-foto='" . base64_encode($row['foto']) . "' 
                                    data-nombreapellido='" . $row['nombreApellido'] . "' 
                                    data-descripcion='" . $row['descripcion'] . "'>
                                <i class='bi bi-pencil'></i> Editar
                            </button>
                        </td>";
                    echo "<td>
                            <button class='btn btn-danger btn-sm' 
                                    data-bs-toggle='modal' 
                                    data-bs-target='#confirmDeleteModal' 
                                    data-idpodio='" . $row['idPodio'] . "'>
                                <i class='bi bi-trash'></i> Eliminar
                            </button>
                        </td>";                  
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay registros en el podio.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Podio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarPodioProfesor.php">
                    <div class="mb-3">
    <label for="addTop" class="form-label">Top</label>
    <select class="form-control" id="addTop" name="top" required>
        <option value="">Seleccione un puesto</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>

                        <div class="mb-3">
                            <label for="addEstudiante" class="form-label">Seleccionar Estudiante</label>
                            <select class="form-control" id="addEstudiante" name="estudiante" required>
                                <option value="">Seleccione un estudiante</option>
                                <?php
                                $sqlEstudiantes = "SELECT carnet, nombreCompleto, fotoPerfil FROM estudiantes";
                                $resultEstudiantes = $conn->query($sqlEstudiantes);
                                if ($resultEstudiantes->num_rows > 0) {
                                    while ($rowEstudiante = $resultEstudiantes->fetch_assoc()) {
                                        echo "<option data-fotoperfil='" . base64_encode($rowEstudiante['fotoPerfil']) . "' value='" . $rowEstudiante['carnet'] . "'>" . $rowEstudiante['nombreCompleto'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" id="addFoto" name="foto">
                        <div class="mb-3">
                            <label for="addDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="addDescripcion" name="descripcion" required></textarea>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Podio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarPodio2.php">
                        <input type="hidden" id="editIdPodio" name="idPodio">
                        <div class="mb-3">
    <label for="editTop" class="form-label">Top</label>
    <select class="form-control" id="editTop" name="top" required>
        <option value="">Seleccione un puesto</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</div>

                        <div class="mb-3">
                            <label for="editEstudiante" class="form-label">Seleccionar Estudiante</label>
                            <select class="form-control" id="editEstudiante" name="estudiante" required>
                                <option value="">Seleccione un estudiante</option>
                                <?php
                                $sqlEstudiantes = "SELECT carnet, nombreCompleto, fotoPerfil FROM estudiantes";
                                $resultEstudiantes = $conn->query($sqlEstudiantes);
                                if ($resultEstudiantes->num_rows > 0) {
                                    while ($rowEstudiante = $resultEstudiantes->fetch_assoc()) {
                                        echo "<option data-fotoperfil='" . base64_encode($rowEstudiante['fotoPerfil']) . "' value='" . $rowEstudiante['carnet'] . "'>" . $rowEstudiante['nombreCompleto'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" id="editFoto" name="foto">
                        <div class="mb-3">
                            <label for="editDescripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editDescripcion" name="descripcion" required></textarea>
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
                    <p>¿Estás seguro de que quieres eliminar este registro?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="../php/eliminarPodio2.php">
                        <input type="hidden" id="deleteIdPodio" name="idPodio">
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
    var editModal = document.getElementById('editModal');
editModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var idPodio = button.getAttribute('data-idpodio');
    var top = button.getAttribute('data-top');
    var nombreApellido = button.getAttribute('data-nombreapellido');
    var descripcion = button.getAttribute('data-descripcion');

    var modalBodyInputIdPodio = editModal.querySelector('#editIdPodio');
    var modalBodyInputTop = editModal.querySelector('#editTop');
    var modalBodyInputDescripcion = editModal.querySelector('#editDescripcion');

    modalBodyInputIdPodio.value = idPodio;
    modalBodyInputTop.value = top;
    modalBodyInputDescripcion.value = descripcion;

    // Validación de si hay un cambio en el puesto del top
    modalBodyInputTop.addEventListener('change', function () {
        var selectedTop = modalBodyInputTop.value;

        // Aquí puedes hacer una validación con AJAX o mostrar un mensaje en caso de cambio de posición
        // Ejemplo básico de alerta:
        if (selectedTop !== top) {
            alert('Al cambiar el top, se intercambiará con otro estudiante.');
        }
    });
});


    // Código JavaScript para llenar los campos del formulario de eliminación
    var confirmDeleteModal = document.getElementById('confirmDeleteModal')
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        var idPodio = button.getAttribute('data-idpodio')

        var modalBodyInputIdPodio = confirmDeleteModal.querySelector('#deleteIdPodio')
        modalBodyInputIdPodio.value = idPodio
    })
    </script>
    
</body>
</html>
