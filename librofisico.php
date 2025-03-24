<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Libros Físicos'); ?>

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
                            <div class="d-grid gap-4 mx-left">
                                <div class="card" style="max-width: 540px">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <p class="card-text">
                                                    <strong> Ubicacion: </strong>Universidad
                                                </p>
                                                <p class="card-text">
                                                    <strong>Ejemplares disponibles:</strong> 2
                                                </p>
                                                <p class="card-text">
                                                    <strong>Pais:</strong> Pais
                                                </p>
                                                <button class="btn btn-secondary btn-lg">
                                                    Solicitar
                                                </button>
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