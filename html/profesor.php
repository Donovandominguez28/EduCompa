<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
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
        <?php include "../html/perfilProfesor.php"; ?>
        <hr>
        <?php include "../html/navProfesor.php"; ?>
    </div>

    <section class="home-grid">
        <h1 class="heading">¡Bienvenido al sistema de gestion de la plataforma web EduCompa!</h1>
    </section>

    <!-- custom js file link -->
    <script src="../js/script.js"></script>
</body>
</html>
