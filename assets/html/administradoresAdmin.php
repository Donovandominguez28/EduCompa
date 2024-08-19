<?php
include "../php/session_check3.php";
include '../php/conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Administradores</title>
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
            <h2><i class="bi bi-table"></i> Administrar Administradores</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-circle"></i> Agregar Nuevo
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID Admin</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Email</th>
                    <th>Contraseña</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
$sql = "SELECT * FROM administrador WHERE idAdmin != 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['idAdmin'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['rol'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['contrasena'] . "</td>";
        echo "<td>
                <button class='btn btn-warning btn-sm' 
                        data-bs-toggle='modal' 
                        data-bs-target='#editModal' 
                        data-idAdmin='" . $row['idAdmin'] . "' 
                        data-nombre='" . $row['nombre'] . "' 
                        data-email='" . $row['email'] . "' 
                        data-rol='" . $row['rol'] . "' 
                        data-contrasena='" . $row['contrasena'] . "'>
                    <i class='bi bi-pencil'></i> Editar
                </button>
            </td>";
        echo "<td>
                <button class='btn btn-danger btn-sm' 
                        data-bs-toggle='modal' 
                        data-bs-target='#confirmDeleteModal' 
                        data-idAdmin='" . $row['idAdmin'] . "'>
                    <i class='bi bi-trash'></i> Eliminar
                </button>
            </td>";                  
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No hay administradores registrados.</td></tr>";
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
                    <h5 class="modal-title" id="addModalLabel"><i class="bi bi-plus-circle"></i> Agregar Nuevo Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" method="POST" enctype="multipart/form-data" action="../php/agregarAdministrador.php">
                        <div class="mb-3">
                            <label for="addIdAdmin" class="form-label">ID Admin</label>
                            <input type="number" class="form-control" id="addIdAdmin" name="idAdmin" required>
                        </div>
                        <div class="mb-3">
                            <label for="addNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="addNombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="addRol" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="addRol" name="rol" value="Administrador" readonly>
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
                    <h5 class="modal-title" id="editModalLabel"><i class="bi bi-pencil"></i> Editar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" enctype="multipart/form-data" action="../php/editarAdministradores.php">
                        <input type="hidden" id="editIdAdmin" name="idAdmin">
                        <div class="mb-3">
                            <label for="editNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre">
                        </div>
                        <div class="mb-3">
                            <label for="editRol" class="form-label">Rol</label>
                            <input type="text" class="form-control" id="editRol" name="rol" readonly>
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
                    ¿Estás seguro de que deseas eliminar este administrador? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="../php/eliminarAdministradores.php">
                        <input type="hidden" id="deleteIdAdmin" name="idAdmin">
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
                aria-label="Toggle theme">
            <svg class="bi" width="24" height="24" fill="currentColor">
                <use xlink:href="../node_modules/bootstrap-icons/icons/moon.svg"/>
            </svg>
            <svg class="bi d-none" width="24" height="24" fill="currentColor">
                <use xlink:href="../node_modules/bootstrap-icons/icons/sun.svg"/>
            </svg>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="../node_modules/bootstrap-icons/icons/sun.svg"/>
                    </svg>
                    Light
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="../node_modules/bootstrap-icons/icons/moon.svg"/>
                    </svg>
                    Dark
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
                    <svg class="bi me-2" width="24" height="24" fill="currentColor">
                        <use xlink:href="../node_modules/bootstrap-icons/icons/lamp.svg"/>
                    </svg>
                    Auto
                </button>
            </li>
        </ul>
    </div>

    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        // Script para llenar los modales de edición y confirmación de eliminación
        document.addEventListener('DOMContentLoaded', function () {
            var editModal = document.getElementById('editModal');
            var deleteModal = document.getElementById('confirmDeleteModal');

            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var idAdmin = button.getAttribute('data-idAdmin');
                var nombre = button.getAttribute('data-nombre');
                var email = button.getAttribute('data-email');
                var rol = button.getAttribute('data-rol');
                var contrasena = button.getAttribute('data-contrasena');

                var modal = editModal.querySelector('form');
                modal.querySelector('#editIdAdmin').value = idAdmin;
                modal.querySelector('#editNombre').value = nombre;
                modal.querySelector('#editEmail').value = email;
                modal.querySelector('#editRol').value = rol;
                modal.querySelector('#editContrasena').value = contrasena;
            });

            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var idAdmin = button.getAttribute('data-idAdmin');

                var modal = deleteModal.querySelector('form');
                modal.querySelector('#deleteIdAdmin').value = idAdmin;
            });
        });
    </script>
</body>
</html>
