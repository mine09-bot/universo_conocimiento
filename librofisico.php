<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Libros Físicos'); ?>
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
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

        <?php echo generarFooter(); ?>
    </body>
</html>
