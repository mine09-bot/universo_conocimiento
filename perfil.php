<?php
session_start();
require "utils.php";
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Perfil'); ?>
    
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->

            <div class="d-grid gap-4">
                <div class="card m-0" style="max-width: 8rem">
                    <div class="row g-0">
                        <img
                            src="fotoperfil.jpg"
                            class="card-img-top"
                            alt="..."
                        />
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-4 mx-left">
                <div class="card m-0" style="max-width: 540px">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong></strong>Minerva Benitez
                                    Perez
                                </p>
                                <p class="card-text">
                                    <strong></strong> Benemerita
                                    Universidad Autonoma de Puebla
                                </p>
                                <p class="card-text">
                                    <strong>Pais:</strong> México
                                </p>
                                <p class="card-text">
                                    <strong> Correo Electronico: </strong
                                    >mine-1301@hotmail.com
                                </p>
                                <p class="card-text">
                                    <strong> Libros Subidos: </strong>5
                                </p>
                                <p class="card-text">
                                    <strong> Libros Consultados: </strong> 20
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo generarFooter(); ?>
    </body>
</html>
