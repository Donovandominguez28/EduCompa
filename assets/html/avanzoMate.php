<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/preguntas.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- FontAwesome CDN Link for Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Matematicas</title>
</head>
<body>
<?php include '../html/navBar2.php'; ?>


  <!-- botón de inicio de prueba -->
  <div class="start_btn"><button>Iniciar prueba</button></div>

  <!-- Caja de Informacion-->
  <div class="info_box">
      <div class="info-title"><span>Algunas reglas de este cuestionario</span></div>
      <div class="info-list">
          <div class="info">1. Tendrás solo <span>20 segundos</span> por cada pregunta.</div>
          <div class="info">2. Una vez que seleccione su respuesta, no se puede deshacer.</div>
          <div class="info">3. No puede seleccionar ninguna opción una vez que se acaba el tiempo.</div>
          <div class="info">4. No puedes salir del Quiz mientras estás jugando.</div>
          <div class="info">5. Obtendrás puntos en base a tus respuestas correctas.</div>
      </div>
      <div class="buttons">
          <button class="quit">Salir del Cuestionario</button>
          <button class="restart">Continuar</button>
      </div>
  </div>

  <!-- Cuadro de prueba-->
  <div class="quiz_box">
      <header>
          <div class="title">Prueba Avanzo de Matematica</div>
          <div class="timer">
              <div class="time_left_txt">Tiempo restante</div>
              <div class="timer_sec">20</div>
          </div>
          <div class="time_line"></div>
      </header>
      <section>
          <div class="que_text">
              <!-- Aquí he insertado una pregunta de JavaScript -->
          </div>
          <div class="option_list">
              <!-- Aquí he insertado opciones de JavaScript -->
          </div>
      </section>

      <!-- pie de página de la prueba -->
      <footer>
          <div class="total_que">
              <!-- Aquí he insertado Número de conteo de preguntas de JavaScript -->
          </div>
          <button class="next_btn">Siguiente</button>
      </footer>
  </div>

  <!-- Result Box -->
  <div class="result_box">
      <div class="icon">
          <img src="../images/felicidades.png" class="avatar" alt="">
      </div>
      <div class="complete_text">¡Has completado el cuestionario!</div>
      <div class="score_text">
          <!-- Aquí he insertado Score Result de JavaScript-->
      </div>
      <div class="buttons">
          <button class="restart">Cuestionario de repetición</button>
          <button class="quit">Salir</button>
      </div>
  </div>

  <!-- Dentro de este archivo JavaScript, solo he insertado preguntas y opciones. -->
  <script src="../js/preguntasMate.js"></script>

  <!-- Dentro de este archivo JavaScript he codificado todos los códigos de prueba -->
  <script src="../js/avanzo.js"></script>
  <script src="../js/script.js" defer></script>

  
</body>
</html>
