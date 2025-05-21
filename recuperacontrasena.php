<?php
session_start();
require 'utils.php';
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Recuperar Contraseña'); ?>
</head>

<body>
    <div class="container-md mt-2">
        <form class="row g-1" action="enviar_link.php" method="post">
            <div class="col-6 d-flex flex-column gap-2">
                <img
                    src="assets/images/logo.svg"
                    alt="Bootstrap"
                    width="150"
                    height="150" />
                <h3>¡Recuperar Contraseña!</h3>


                <label for="correo">Escribe tu correo:</label>
                <input type="email" name="correo" required style="width: 300px;">
                <div class="mb-3 mt-4">
                    <button class="btn btn-primary " type="submit">Enviar enlace</button>
                </div>
            </div>
        </form>

    </div>
</body>

</html>