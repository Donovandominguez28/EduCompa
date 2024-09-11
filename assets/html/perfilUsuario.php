<?php
include '../php/session_check2.php';
include '../php/datosPerfil.php';
    
// Check if a banner is set; if not, use a default image
$bannerImg = !empty($banner) ? 'data:'  . ';base64,' . base64_encode($banner) : '../images/defaultBanner.jpg';
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php include '../html/navBar.php'; ?>

<body id="#top">


    <section class="perfil-usuario">
        <div class="contenedor-perfil">
            <div class="portada-perfil reveal" style="background-image: url('<?php echo $bannerImg; ?>');">
                <div class="sombra"></div>
                <div class="avatar-perfil reveal">
                    <img src="data:<?php echo $mimeType; ?>;base64,<?php echo base64_encode($fotoPerfil); ?>" alt="Foto de perfil">
                </div>
                <div class="datos-perfil reveal">
                    <h4 style="font-size:20px;">Nombre: <?php echo htmlspecialchars($nombreCompleto); ?></h4>
                    <h4 style="font-size:20px;">Usuario: <?php echo htmlspecialchars($usuario); ?></h4>
                    <h4 style="font-size:20px;">Bachillerato: <?php echo htmlspecialchars($añoBachi); ?> Año</h4>
                    <h4 style="font-size:20px;">Sección: <?php echo htmlspecialchars($seccion); ?></h4>
                    <h4 style="font-size:20px;">Especialidad: <?php echo htmlspecialchars($especialidad); ?></h4>
                    <!-- <ul class="lista-perfil">
                        <li>35 Seguidores</li>
                        <li>7 Seguidos</li>
                        <li>32 Publicaciones</li>
                    </ul> -->
                </div>
            </div>
            <div class="menu-perfil reveal">
                <ul>
                    <li><a type="button" href="../html/publicarMural.php" class="btn btn-primary" style="color:white;"><i class="bi bi-megaphone"></i> Publicar</a></li>
                    <li><a type="button" href="../html/editarPerfil.php" class="btn btn-primary" style="color:white;"><i class="bi bi-pencil-square"></i> Editar Perfil</a></li>
                    <li><a type="button" href="../html/perfiles.php" class="btn btn-primary" style="color:white;"><i class="bi bi-search"></i> Mas perfiles...</a></li>
                </ul>
            </div>
        </div>
    </section>

    <br><br><br><br><br>
    <section class="section section-divider white cta reveal" style="background-image: url('../images/pared2.jpg')">
    <div class="containerrr">
        <h1 class="titulo-usuario reveal" style="color: white; font-size: 40px;">Mural del Conocimiento</h1>
        <div class="card__container reveal">
        <?php
$sql = "SELECT * FROM mural WHERE carnet2 = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $carnet);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<article class="card__article">';
        if (!empty($row['imagenMural'])) {
            echo '<div class="card__image-container">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagenMural']) . '" alt="image" class="card__img">';
            echo '</div>';
        }
        echo '<div class="card__data" style="font-size:15px; color:black;">';
        echo '<h2 class="card__title">' . htmlspecialchars($row['titulo']) . '</h2>';
        echo '<p style="color:black;">' . htmlspecialchars($row['informacion']) . '</p>';
        echo '</div>';
        echo '<div class="card__actions">';
        echo '<a href="../html/editarMural.php?idMural=' . $row['idMural'] . '" class="card__btn card__btn--edit"><i class="bi bi-pencil-square"></i> Editar</a>';
        echo '<button class="card__btn card__btn--delete" onclick="confirmDelete(' . $row['idMural'] . ')"><i class="bi bi-trash-fill"></i> Eliminar</button>';
        echo '</div>';
        echo '</article>';
    }
} else {
    echo '<h1 class="titulo-usuario reveal" style="color: white; font-size: 40px; text-align: center;">Publicaciones no disponibles.</h1>';
}
echo'</div>';
echo'</div>';
echo'</section>';
?>
<section class="section section-divider white cta reveal" style="background-image: url('../images/pared2.jpg')">
  <div class="container">
      <div class="cta-content">
      <h1 class="section-title reveal" style="text-align: center; margin: 0 auto; font-size:40px;">Mural Del Conocimiento</h1>
      <br>
      <br>
      <br>
      <br>
      <div class="carousel">
          <div class="list">

              <?php
              // Conexión a la base de datos y obtención de datos del mural
              $sql = "SELECT * FROM mural WHERE carnet2 = ?";
              $stmt = mysqli_prepare($conn, $sql);
              mysqli_stmt_bind_param($stmt, 'i', $carnet);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);

              // Comprobamos si hay resultados
              if (mysqli_num_rows($result) > 0) {
                  // Iteramos sobre los resultados y los mostramos
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<div class="item" style="background-image: url(data:image/jpeg;base64,' . base64_encode($row['imagenMural']) . ');">';
                      echo '<div class="content">';
                      echo '<div class="title">' . htmlspecialchars($row['titulo']) . '</div>';
                      echo '<div class="des">' . htmlspecialchars($row['informacion']) . '</div>';
                      echo '<div class="btnC">';
                      echo '<a href="../html/editarMural.php?idMural=' . $row['idMural'] . '"><button>Editar</button></a>';
                      echo '<button onclick="confirmDelete(' . $row['idMural'] . ')">Eliminar</button>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                  }
              } else {
                  echo '<h1 class="titulo-usuario reveal" style="color: white; font-size: 40px; text-align: center;">Publicaciones no disponibles.</h1>';
              }
              ?>

          </div>

          <!--next prev button-->
          <div class="arrows">
              <button class="prev"><</button>
              <button class="next">></button>
          </div>

      </div>
  </div>
</section>

<script>
    function confirmDelete(idMural) {
        if (confirm("¿Estás seguro de que deseas eliminar este mural?")) {
            window.location.href = "../php/eliminarMural.php?idMural=" + idMural;
        }
    }
</script>

<style>
/* Alineando los botones en btnC de forma horizontal con espaciado */
.content .btnC {
    display: flex;
    flex-direction: row; /* Alinear los botones en fila */
    gap: 10px; /* Añadir más espacio si es necesario */
    margin-left: 1px;
}
/* Mostrar el contenido solo cuando haya una tarjeta */
.carousel .list .item:only-child .content {
    display: block; /* Mostrar el contenido */
    animation: none; /* Desactivar la animación si es necesario */
}

/* Asegurarse de ocultar el contenido cuando hay más de una tarjeta */
.carousel .list .item .content {
    display: none;
}

.carousel .list .item:nth-child(2) .content {
    display: block; /* Mostrar contenido de la segunda tarjeta como antes */
}

.content .btnC button {
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border: 2px solid #fff;
}

.carousel{
    width: 80vw;
    height: 80vh;
    margin-top: -50px;
    overflow: hidden;
    position: relative;
}

.carousel .list .item{
    width: 180px;
    height: 250px;
    position: absolute;
    top: 80%;
    transform: translateY(-70%);
    left: 70%;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    background-position: 50% 50%;
    background-size: cover;
    z-index: 100;
    transition: 1s;
}

.carousel .list .item:nth-child(1),
.carousel .list .item:nth-child(2){
    top: 0;
    left: 0;
    transform: translate(0, 0);
    border-radius: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;

}

.carousel .list .item:nth-child(3){
    left: 67%;
}

.carousel .list .item:nth-child(4){
    left: calc(67% + 200px);
}

.carousel .list .item:nth-child(5){
    left: calc(67% + 400px);
}

.carousel .list .item:nth-child(6){
    left: calc(67% + 600px);
}

.carousel .list .item:nth-child(n+7){
    left: calc(67% + 800px);
    opacity: 0;
}





.list .item .content{
    position: absolute;
    top: 50%;
    left: 100px;
    transform: translateY(-50%);
    width: 400px;
    text-align: left;
    color: #fff;
    display: none;
}

.list .item:nth-child(2) .content{
    display: block;
}

.content .title{
    font-size: 50px;
    text-transform: uppercase;
    font-weight: bold;
    line-height: 1;
    opacity: 0;
    animation: animate 1s ease-in-out 0.3s 1 forwards;
}


.content .des{
    margin-top: 10px;
    margin-bottom: 20px;
    font-size: 18px;
    margin-left: 5px;

    opacity: 0;
    animation: animate 1s ease-in-out 0.9s 1 forwards;
}

.content .btnC{
    margin-left: 5px;

    opacity: 0;
    animation: animate 1s ease-in-out 1.2s 1 forwards;
}

.content .btnC button{
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 16px;
    border: 2px solid #fff;
}

.content .btnC button:nth-child(1){
    margin-right: 15px;
    background: transparent;
    border: 2px solid #fff;
    transition: 0.3s;
}

.content .btnC button:nth-child(2){
    background: transparent;
    border: 2px solid #fff;
    transition: 0.3s;
}



@keyframes animate {
    
    from{
        opacity: 0;
        transform: translate(0, 100px);
        filter: blur(33px);
    }

    to{
        opacity: 1;
        transform: translate(0);
        filter: blur(0);
    }
}

/* Carousel */






/* next prev arrows */

.arrows{
    position: absolute;
    top: 80%;
    right: 52%;
    z-index: 100;
    width: 300px;
    max-width: 30%;
    display: flex;
    gap: 10px;
    align-items: center;
}

.arrows button{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;
    outline: none;
    font-size: 16px;
    font-family: monospace;
    font-weight: bold;
    transition: .5s;
    cursor: pointer;
}









/* Responsive Design */

@media screen and (max-width: 999px){
    
    header{
        padding-left: 50px;
    }

    .list .item .content{
        left: 50px;
    }

    .content .title, .content .name{
        font-size: 70px;
    }

    .content .des{
        font-size: 16px;
    }

}

@media screen and (max-width: 690px){
    header nav a{
        font-size: 14px;
        margin-right: 0;
    }

    .list .item .content{
        top: 40%;
    }

    .content .title, .content .name{
        font-size: 45px;
    }

    .content .btnC button{
        padding: 10px 15px;
        font-size: 14px;
    }
}
</style>
<script>
    var nextBtn = document.querySelector('.next'),
    prevBtn = document.querySelector('.prev'),
    carousel = document.querySelector('.carousel'),
    list = document.querySelector('.list'), 
    item = document.querySelectorAll('.item'),
    runningTime = document.querySelector('.carousel .timeRunning') 

let timeRunning = 3000 
let timeAutoNext = 7000

nextBtn.onclick = function(){
    showSlider('next')
}

prevBtn.onclick = function(){
    showSlider('prev')
}

let runTimeOut 

let runNextAuto = setTimeout(() => {
    nextBtn.click()
}, timeAutoNext)



function showSlider(type) {
    let sliderItemsDom = list.querySelectorAll('.carousel .list .item')
    if(type === 'next'){
        list.appendChild(sliderItemsDom[0])
        carousel.classList.add('next')
    } else{
        list.prepend(sliderItemsDom[sliderItemsDom.length - 1])
        carousel.classList.add('prev')
    }

    clearTimeout(runTimeOut)

    runTimeOut = setTimeout( () => {
        carousel.classList.remove('next')
        carousel.classList.remove('prev')
    }, timeRunning)


    clearTimeout(runNextAuto)
    runNextAuto = setTimeout(() => {
        nextBtn.click()
    }, timeAutoNext)

    resetTimeAnimation() // Reset the running time animation
}

// Start the initial animation 
resetTimeAnimation()
</script>
      </div>
  </div>
</section>
<style>
    .card__container {
    position: relative;
}

.card__article {
    position: relative;
    margin-bottom: 3em; /* Espacio suficiente para los botones */
    padding-bottom: 6em; /* Espacio para los botones en la parte inferior */
}

.card__btn {
    position: absolute;
    bottom: 10px; /* Ajusta la distancia desde el borde inferior según sea necesario */
    padding: 0.5em 1em;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.5em;
    color: white;
    z-index: 10; /* Asegura que los botones estén por encima del contenido de la tarjeta */
}

.card__btn--edit {
    background: #007bff;
    left: 10px; /* Ajusta la distancia desde el borde izquierdo */
}

.card__btn--delete {
    background: #dc3545;
    right: 10px; /* Ajusta la distancia desde el borde derecho */
}


.card__btn--edit:hover {
    background: darkblue;
}

.card__btn--delete:hover {
    background: darkred;
}

.card__image-container {
    max-height: 300px; /* Ajusta según el tamaño máximo deseado */
    overflow: hidden;
}

.card__img {
    width: 100%;
    height: auto;
    max-height: 300px; /* Ajusta según el tamaño máximo deseado */
    object-fit: cover; /* Asegura que la imagen no se deforme */
}

</style>

    <br><br>
    <?php include '../html/footer.php'; 
    ?>

    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><i class="bi bi-arrow-up-short"></i></a>
    <script src="../js/script.js" defer></script>
    <script>

</script>

</body>

</html>
