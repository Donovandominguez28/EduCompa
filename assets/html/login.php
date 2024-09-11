<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylelogin.css">
    <link rel="stylesheet" href="../css/notificaciones.css">
    <link rel="shortcut icon" href="../images/educompalogo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Login</title>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Rubik:wght@400;500;600;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">    
<style>
    * {
        font-family: 'Roboto', sans-serif;
    }
    body {
        background-color: white;
    }

    .floating-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #365b77;
        color: white;
        border: none;
        border-radius: 100%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        cursor: pointer;
        z-index: 1000;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .floating-button.active {
        transform: rotate(45deg);
        background-color: red; /* Color diferente cuando está activo */
    }

    .floating-button i {
        transform: rotate(90deg);
    }

    .floating-button.active i {
        transform: rotate(-45deg); /* Rotación del ícono cuando está activo */
    }

    .hidden-content {
        display: none;
    }
    .preview-container {
        position: relative;
        width: 100%;
        height: 200px; /* Adjust as needed */
        border: 1px solid #ddd;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
</style>
<body>
  <div class="container-form sign-up">
    <div class="welcome-back">
        <div class="message">
            <h2>Bienvenido a EduCompa</h2>
            <p>Si ya tienes una cuenta por favor inicia sesión aquí</p>
            <button class="sign-up-btn">Iniciar Sesión</button>
        </div>
    </div>
    <form class="formulario" id="registerForm" action="../php/register.php" method="POST" enctype="multipart/form-data">
        <br>
        <h2>Crea una cuenta</h2>
        <br>
        <a href="../html/index.php"><img src="../images/educompalogo.jpg" alt="" class="logologin"></a>
        <br>
        <br>
        <div class="input-group mb-3">
            <i class="bi bi-person-badge"></i>
            <label>Carnet</label>
            <input type="number" class="form-control" name="carnet">
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-camera"></i>
            <label>Foto de perfil</label>
            <div id="fotoPerfilPreview"></div>
            <input type="file" class="form-control" name="fotoPerfil" id="fotoPerfil">
        </div>
        <div id="fotoPerfilPreview"></div>
        <div class="input-group mb-3">
            <i class="bi bi-person"></i>
            <label>Nombre Completo</label>
            <input type="text" class="form-control" name="nombreCompleto">
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-calendar"></i>
            <label>Año de bachillerato</label>
            <select class="form-control" name="añoBachi">
                <option value="">Selecciona el año bachillerato</option>
                <option value="1">Primer Año</option>
                <option value="2">Segundo Año</option>
                <option value="3">Tercer Año</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-building"></i>
            <label>Sección</label>
            <select class="form-control" name="seccion">
                <option value="">Selecciona la sección</option>
                <option value="A">"A"</option>
                <option value="B">"B"</option>
                <option value="C">"C"</option>
                <option value="D">"D"</option>
                <option value="C">"F"</option>
                <option value="G">"G"</option>
                <option value="H">"H"</option>
                <option value="I">"I"</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-briefcase"></i>
            <label>Especialidad</label>
            <select class="form-control" name="especialidad">
                <option value="">Selecciona la especialidad</option>
                <option value="Atencion Primaria en Salud">Atencion Primaria en Salud</option>
                <option value="Electronica">Electronica</option>
                <option value="Electromecanica">Electromecanica</option>
                <option value="Desarrollo de Software">Desarrollo de Software</option>
                <option value="Diseño Grafico">Diseño Grafico</option>
                <option value="Electronica">Mantenimiento Automotriz</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-person-circle"></i>
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario">
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-envelope"></i>
            <label>Email</label>
            <input type="email" class="form-control" name="email">
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-lock"></i>
            <label>Contraseña</label>
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleRegisterPassword" style="cursor: pointer;"></i>
            </span>
            <div class="input-group">
                <input type="password" class="form-control" name="contrasena" id="registerPassword">
            </div>
        </div>
        <div class="input-group mb-3">
            <i class="bi bi-lock"></i>
            <label>Confirma la contraseña</label>
            <span class="input-group-text">
                <i class="bi bi-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
            </span>
            <div class="input-group">
                <input type="password" class="form-control" name="confirmarContrasena" id="confirmPassword">
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Registrarse">
        <br><br>
    </form>
</div>

    <div class="container-form sign-in">
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido de nuevo a EduCompa</h2>
                <p>Si aun no tienes una cuenta por favor registrese aqui</p>
                <button class="sign-in-btn">Registrarse</button>
            </div>
        </div>
        <form class="formulario" id="loginForm" action="../php/login.php" method="POST">
            <br>
            <h2 class="create-account">Iniciar Sesion</h2>
            <a href="../html/index.php"><img src="../images/educompalogo.jpg" alt="" class="logologin"></a>
            <br>
            <br>
            <div class="input-group mb-3">
                <i class="bi bi-envelope"></i>
                <label>Email/Usuario</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="input-group mb-3">
                <i class="bi bi-lock"></i>
                <label>Contraseña</label>
                    <i class="bi bi-eye" id="toggleLoginPassword" style="cursor: pointer;"></i>

                <div class="input-group">
                   
                    <input type="password" class="form-control" name="contrasena" id="loginPassword" id="contrasena">
                    
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Iniciar Sesion">
        </form>
    </div>
    <div class="contenedor-toast" id="contenedor-toast"></div>
<script src="../js/script.js"></script>
<script src="../js/eye.js"></script>
<script src="../js/notificaciones.js"></script>
</body>
<!-- Botón flotante -->
<button class="floating-button" id="floatingBtn">
    <i class="bi bi-gear-fill" id="iconoBtn"></i>
</button>
<!-- Contenedor de contenido oculto -->
<div class="hidden-content">
    <?php include '../html/translate.php'; ?>
</div>
<script>
    const floatingBtn = document.getElementById('floatingBtn');
    const hiddenContent = document.querySelector('.hidden-content');
    const iconoBtn = document.getElementById('iconoBtn');

    floatingBtn.addEventListener('click', () => {
        // Toggle la clase 'active' en el botón
        floatingBtn.classList.toggle('active');

        // Cambiar el icono cuando el botón está activo
        if (floatingBtn.classList.contains('active')) {
            hiddenContent.style.display = 'block';
            iconoBtn.classList.remove('bi-gear-fill');
            iconoBtn.classList.add('bi-x');
        } else {
            hiddenContent.style.display = 'none';
            iconoBtn.classList.remove('bi-x');
            iconoBtn.classList.add('bi-gear-fill');
        }
    });
</script>

<script>
    document.getElementById('fotoPerfil').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.borderRadius = '50%';
            img.style.border = '5px solid white';
            img.style.objectFit = 'cover';
            const preview = document.getElementById('fotoPerfilPreview');
            preview.innerHTML = ''; // Limpiar la vista previa existente
            preview.appendChild(img);
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });

    function showPreview(event, previewId) {
    var input = event.target;
    var preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the preview
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none'; // Hide the preview if no file selected
    }
}
</script>
</html>
