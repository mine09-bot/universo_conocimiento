<?php
session_start();
require 'utils.php';

// Si ya hay una sesión activa, redirige a inicio.php
if (isset($_SESSION['idUsuario'])) {
    header("Location: inicio.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Iniciar Sesión'); ?>
</head>

<body>
    <div class="position-relative" style="height: 100vh; width: 100vw;">
        <img
            src="assets/images/library_bg.webp"
            alt="Background"
            class="img-fluid position-absolute w-100" />
    </div>
    <div class="container-md mt-2">
        <div class="row justify-content-center">
            <div class="card col-12 col-md-8 col-lg-6 col-xl-4 shadow">
                <img
                    src="assets/images/logo.svg"
                    alt="Bookia Logo"
                    class="img-fluid px-4 px-md-5 pt-4" />
                <form class="card-body mt-3" method="post" action="login_manejador.php">
                    <h5 class="card-title pb-3">Iniciar Sesión</h5>
                    <input
                        type="text"
                        class="form-control mb-3"
                        id="usuario"
                        name="usuario"
                        placeholder="Nombre de Usuario" />
                    <div class="input-group">
                        <input
                            type="password"
                            class="form-control"
                            id="contrasena"
                            name="contrasena"
                            placeholder="Contraseña" />
                        <button class="btn btn-outline-secondary" type="button" id="button-showpass">
                            <i class="fa-solid fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <a href="recuperacontrasena.php">
                        <small> ¿Olvidaste tu Contraseña? </small>
                    </a>
                    <button type="submit" class="btn btn-primary w-100 my-3">Iniciar Sesion</button>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <h5>Aun no tienes una cuenta?</h5>
                        <a
                            href="registro.php"
                            class="btn btn-outline-light"
                            tabindex="-1"
                            role="button"
                            aria-disabled="true">
                            Registro
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('button-showpass').addEventListener('click', function() {
            const pwdInput = document.getElementById('contrasena');
            const icon = this.querySelector('i');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                pwdInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>