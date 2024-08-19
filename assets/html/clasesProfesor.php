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
            <h2><i class="bi bi-table"></i> Administrar Clases</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nueva
            </button>
        </div>
        <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Materia</th>
            <th>Descripción</th>
            <th>Profesor</th>
            <th>Imagen</th>
            <th>Estudiante Asignado</th>
            <th>Revisar Clase</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include '../php/conexion.php';
    $sql = "SELECT c.idClase, c.titulo, c.materia, c.descripcion, c.imagenClase, c.nombreProfesor, c.carnet7, e.nombreCompleto 
            FROM clases c
            LEFT JOIN estudiantes e ON c.carnet7 = e.carnet";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['idClase'] . "</td>";
            echo "<td>" . $row['titulo'] . "</td>";
            echo "<td>" . $row['materia'] . "</td>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td>" . $row['nombreProfesor'] . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagenClase']) . "' alt='Imagen de Clase' width='100'></td>";
            echo "<td>" . ($row['nombreCompleto'] ? $row['nombreCompleto'] : 'No asignado') . "</td>";
            echo "<td>
                    <a href='../html/revisarClase.php?idClase=" . $row['idClase'] . "' class='btn btn-info btn-sm'>
                        <i class='bi bi-eye'></i> Revisar
                    </a>
                </td>";
            echo "<td>
                    <button class='btn btn-warning btn-sm' 
                            data-bs-toggle='modal' 
                            data-bs-target='#editModal' 
                            data-id='" . $row['idClase'] . "' 
                            data-titulo='" . $row['titulo'] . "' 
                            data-materia='" . $row['materia'] . "' 
                            data-descripcion='" . $row['descripcion'] . "' 
                            data-nombreProfesor='" . $row['nombreProfesor'] . "' 
                            data-carnet7='" . $row['carnet7'] . "'>
                            
                        <i class='bi bi-pencil'></i> Editar
                    </button>
                </td>";
            echo "<td>
                    <button class='btn btn-danger btn-sm' 
                            data-bs-toggle='modal' 
                            data-bs-target='#confirmDeleteModal' 
                            data-idclase='" . $row['idClase'] . "'>
                        <i class='bi bi-trash'></i> Eliminar
                    </button>
                </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>No hay clases registradas.</td></tr>"; // Actualizado para reflejar la nueva columna
    }
    $conn->close();
    ?>
    </tbody>
</table>

    </div>

    <?php
include '../php/conexion.php';

// Asume que tienes almacenado el ID del profesor en la sesión
$idProfesor = $_SESSION['idProfesor'];

$sql = "SELECT materiaInpartida, nombreCompleto FROM profesor WHERE idProfesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idProfesor);
$stmt->execute();
$stmt->bind_result($materiaInpartida, $nombreCompleto);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!-- Modal para agregar -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nueva Clase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarClasesProfesor.php">
                    <div class="mb-3">
                        <label for="addIdClase" class="form-label">ID de la Clase</label>
                        <input type="text" class="form-control" id="addIdClase" name="idClase" required>
                    </div>
                    <div class="mb-3">
                        <label for="addTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="addTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="addMateria" class="form-label">Materia</label>
                        <select class="form-select" id="addMateria" name="materia" required>
                            <option value="">Seleccione una materia</option>
                            <!-- Aquí se podrían agregar opciones dinámicamente -->
                            <option value="<?= htmlspecialchars($materiaInpartida) ?>"><?= htmlspecialchars($materiaInpartida) ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addDescripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="addDescripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="addNombreProfesor" class="form-label">Nombre del Profesor</label>
                        <select class="form-select" id="addNombreProfesor" name="nombreProfesor" required>
                            <option value="<?= htmlspecialchars($nombreCompleto) ?>"><?= htmlspecialchars($nombreCompleto) ?></option>
                            <!-- Aquí se podrían agregar opciones dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addImagenClase" class="form-label">Imagen de la Clase</label>
                        <input type="file" class="form-control" id="addImagenClase" name="imagenClase" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="addCarnet7" class="form-label">Estudiante Asignado</label>
                        <select class="form-select" id="addCarnet7" name="carnet7" required>
                            <option value="">Seleccione un estudiante</option>
                            <?php
                            include '../php/conexion.php';
                            $sql = "SELECT carnet, nombreCompleto FROM estudiantes";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['carnet']) . "'>" . htmlspecialchars($row['nombreCompleto']) . "</option>";
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



<?php
include '../php/conexion.php';

// Asume que tienes almacenado el ID del profesor en la sesión
$idProfesor = $_SESSION['idProfesor'];

$sql = "SELECT materiaInpartida, nombreCompleto FROM profesor WHERE idProfesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idProfesor);
$stmt->execute();
$stmt->bind_result($materiaInpartida, $nombreCompleto);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!-- Modal para editar -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Clase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarClaseProfesor.php">
                    <input type="hidden" id="editIdClase" name="idClase">
                    <div class="mb-3">
                        <label for="editTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editTitulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="editMateria" class="form-label">Materia</label>
                        <select class="form-select" id="editMateria" name="materia" required>
                            <option value="<?= $materiaInpartida ?>"><?= $materiaInpartida ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDescripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editDescripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editNombreProfesor" class="form-label">Nombre del Profesor</label>
                        <select class="form-select" id="editNombreProfesor" name="nombreProfesor" required>
                            <option value="<?= $nombreCompleto ?>"><?= $nombreCompleto ?></option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editImagenClase" class="form-label">Imagen de la Clase (dejar en blanco si no se desea cambiar)</label>
                        <input type="file" class="form-control" id="editImagenClase" name="imagenClase" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editCarnet7" class="form-label">Estudiante Asignado</label>
                        <select class="form-select" id="editCarnet7" name="carnet7" required>
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
                    ¿Estás seguro de que deseas eliminar esta clase?
                    <form id="deleteForm" method="POST" action="../php/eliminarClaseProfesor.php">
                        <input type="hidden" id="deleteIdClase" name="idClase">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" form="deleteForm">Eliminar</button>
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
    // Passing data to the Edit Modal
document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var idClase = button.getAttribute('data-id');
        var titulo = button.getAttribute('data-titulo');
        var materia = button.getAttribute('data-materia');
        var descripcion = button.getAttribute('data-descripcion');
        var nombreProfesor = button.getAttribute('data-nombreProfesor');
        var carnet7 = button.getAttribute('data-carnet7');

        editModal.querySelector('#editIdClase').value = idClase;
        editModal.querySelector('#editTitulo').value = titulo;
        editModal.querySelector('#editMateria').value = materia;
        editModal.querySelector('#editDescripcion').value = descripcion;
        editModal.querySelector('#editNombreProfesor').value = nombreProfesor;
        editModal.querySelector('#editCarnet7').value = carnet7;
    });

    // Passing data to the Delete Modal
    var deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var idClase = button.getAttribute('data-idclase');

        deleteModal.querySelector('#deleteIdClase').value = idClase;
    });
});

    </script>
</body>
</html>
