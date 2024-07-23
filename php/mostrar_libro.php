<?php
include '../php/conexion.php'; // Incluir el archivo de conexión a la base de datos

// Consulta SQL para obtener todos los libros
$sql = "SELECT * FROM biblioteca";
$result = $conn->query($sql);

// Iniciar la sección de la salida del búfer
ob_start();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Iterar sobre cada fila de resultados
    while($row = $result->fetch_assoc()) {
        // Obtener los datos del libro
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $link = $row['link'];
        // Puedes ajustar la obtención de la imagen según tu estructura de datos
        $libroimg = 'data:image/jpeg;base64,' . base64_encode($row['libroimg']);

        // Generar HTML para mostrar cada libro
        echo "<div class='col'>
                <div class='card shadow-sm'>
                  <img class='imglibros' src='$libroimg' alt='Imagen del libro'>
                  <div class='card-body'>
                    <h1>$titulo</h1>
                    <p class='card-text'>$descripcion</p>
                    <div class='d-flex justify-content-between align-items-center'>
                      <div class='buttonn' data-tooltip='Size:10MB'>
                        <div>
                          <div class='textt'><a href='$link' target='_blank'>Link PDF</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>";
    }
} else {
    echo "<h1>No se encontraron libros en la biblioteca.</h1>";
}


?>
