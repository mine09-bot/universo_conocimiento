<?php

session_start();
require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Categorias'); ?>   
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-6">
            <!-- Empieza aqui -->

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

        
        <?php echo generarFooter(); ?>
    </body>
</html>
