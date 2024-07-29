<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="../css/styleadmin.css">
</head>
<body>
    <header class="header">
        <section class="flex">
           <img class="logo" src="../img/educompalogo.jpg" alt="">
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
        <h1 class="heading">Elige una opción</h1>
        <div class="button-container">
          <a  href="../html/estudiantesadmin.php" class="btnn">Estudiantes</a>
            <a  href="../html/profesoradmin.php" class="btnn">Profesores</a>
            <a  href="../html/administradoresAdmin.php" class="btnn">Administradores</a>

        </div>
    </section>

    <!-- custom js file link -->
    <script src="../js/script.js"></script>
</body>
</html>
