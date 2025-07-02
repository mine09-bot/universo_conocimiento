<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('PanelUniversidad'); ?>
</head>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>

                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <div class="d-flex flex-column align-items-start mb-4 border-bottom border-primary">
                                <img src="assets/images/logo.svg" alt="Bootstrap" width="200" />
                                <h3 class="mt-3"> Panel</h3>
                            </div>
                            <form id="form_panel" method="POST" enctype="multipart/form-data">
                                <div class="row align-items-start gx-4">
                                    <!-- Columna izquierda: logo y formulario -->
                                    <div class="col-md-6 col-lg-4">

                                        <div class="mb-3">
                                            <a class="btn btn-secondary w-50" href="prestamo.php" role="button">Prestamos</a>
                                        </div>

                                        <div class="mb-3">
                                            <a class="btn btn-secondary w-50" href="#" role="button">Universidades</a>
                                        </div>


                                    </div>

                            </form>
                        </div>
                    </div>
                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>