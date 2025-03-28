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
    <div class="container-md mt-2">
        <form class="row g-1" method="post" action="login_manejador.php">
            <div class="col-6 d-flex flex-column gap-2">
                <img
                    src="assets/images/logo.svg"
                    alt="Bootstrap"
                    width="300"
                    height="300" />
                <h1>¡Bienvenido a Bookia!</h1>
                <p>Unidos por el saber</p>
                <p>En esta página podrás encontrar una gran variedad de libros de diferentes categorías, además de poder subir tus propios libros y compartirlos con el mundo.</p>
                <p>Si ya tienes una cuenta, inicia sesión para comenzar a disfrutar de la lectura.</p>
                

            </div>
            <div class="col-6 d-grid gap-3">
                <div class="position-relative p-3 border">
                    <button
                        type="button"
                        class="btn-close position-absolute top-0 end-0"
                        aria-label="Close"></button>

                    <h5>Introduce tus datos</h5>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Nombre de usuario</label>
                        <input
                            type="text"
                            class="form-control"
                            id="usuario" name="usuario"
                            aria-describedby="emailHelp" />

                        <label for="contrasena" class="form-label">Contraseña</label>
                        <input
                            type="password"
                            class="form-control"
                            id="contrasena" name="contrasena"
                            aria-describedby="emailHelp" />

                        <br />
                        <div class="col-10 d-grid gap-4">
                            <button type="submit" class="btn btn-primary">
                                Iniciar Sesion
                            </button>
                            <h5>Aun no tienes una cuenta?</h5>
                            <h6>Registrate para iniciar Sesion</h6>
                            <button type="button" class="btn btn-link">
                                Crear cuenta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>