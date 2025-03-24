<?php
session_start();
require "utils.php";
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Perfil'); ?>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>
                <!-- Contenido -->
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <div class="d-grid gap-4">
                                <div class="card m-0" style="max-width: 8rem">
                                    <div class="row g-0">
                                        <img
                                            src="fotoperfil.jpg"
                                            class="card-img-top"
                                            alt="..." />
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
                                                    <strong> Correo Electronico: </strong>mine-1301@hotmail.com
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
                    </div>
                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>