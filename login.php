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
    <div class="position-relative overflow-hidden" style="height: 100vh; width: 100vw">
        <img
            src="assets/images/library_bg.webp"
            alt="Background"
            class="position-absolute top-0 start-0 object-fit-cover"
            style="width: 100vw; height: 100vh" /><!-- Dark overlay -->
        <div
            class="position-absolute top-0 start-0 w-100 h-100"
            style="background: radial-gradient(circle at center, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.95)); z-index: 1"></div>
        <div class="position-relative container-md h-100 z-2">
            <div class="d-flex flex-column justify-content-center align-items-center h-100">
                <div class="card col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4 p-2 p-sm-3 p-md-4 shadow">
                    <img src="assets/images/logo.svg" alt="Bookia Logo" class="img-fluid px-3 px-sm-5 pt-4" />
                    <form class="card-body mt-3" method="post" action="login_manejador.php">
                        <h3 class="card-title pb-3 text-center text-brand">Bienvenido</h3>
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
                        <a class="btn btn-link btn-sm" href="recuperacontrasena.php">
                            <small> ¿Olvidaste tu Contraseña? </small>
                        </a>
                        <button type="submit" class="btn btn-primary w-100 my-4">Iniciar Sesión</button>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="text-brand">Aún no tienes una cuenta?</span>
                            <a
                                href="registro.php"
                                class="btn btn-sm btn-outline-light"
                                tabindex="-1"
                                role="button"
                                aria-disabled="true">
                                Registro
                            </a>
                        </div>
                    </form>
                </div>
                <div class="position-absolute bottom-0 w-100 mb-3 px-4 z-2">
                    <div class="row align-items-center text-white small">
                        <div
                            class="col-12 col-sm-6 gap-3 justify-content-center justify-content-sm-start d-flex mb-2 mb-sm-0">
                            <a href="ayuda.php" class="btn btn-sm">Ayuda</a>
                            <a href="mision.php" class="btn btn-sm">Misión</a>
                        </div>
                        <span class="col-12 col-sm-6 justify-content-center justify-content-sm-end d-flex">
                            © 2025 –&nbsp;
                            <a href="mailto:mine-1301@hotmail.com" class="text-white text-decoration-none">
                                Minerva Benítez Pérez
                            </a>
                        </span>
                    </div>
                </div>
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