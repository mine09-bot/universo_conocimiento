<?php

session_start();
require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Categorias'); ?>

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
                            <h5>Selecione una opción</h5>

                            <div class="d-grid gap-2 col-4 margin-left">
                                <button class="btn btn-secondary" type="button">
                                    Ciencias Sociales y Humnaidades
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Ciencias Políticas y Derecho
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Ciencias Naturales y Matematicas
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Tecnología e Ingenieria
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Ciencias de la Salud y Medicina
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Artes y Bellas Artes
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Negocios y Economía
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Ciencias Sociales Aplicadas
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Ciencias de la Educación
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Investigación y metodos Científicos
                                </button>
                                <button class="btn btn-secondary" type="button">
                                    Infantiles
                                </button>
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