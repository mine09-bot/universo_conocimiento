<?php
session_start();
require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Inicio'); ?>
    <body>
    <?php echo generarBarraNav(); ?>

        <!-- Contenido -->
        <div class="container-md mt-4">
            <!-- Fila -->
            <!-- Margen tiene 4 tipos y 7 posiciones: -->
            <!-- mt-4: margen superior de 4 -->
            <!-- mb-4: margen inferior de 4 -->
            <!-- ml-4: margen izquierdo de 4 -->
            <!-- mr-4: margen derecho de 4 -->
            <!-- mx-4: margen der-izq de 4 (sobre eje X) -->
            <!-- my-4: margen arriba-abajo de 4 (sobre eje Y) -->
            <!-- m-4: margen total de 4 -->
            <h3>Libros mas visitados</h3>

            <div class="row mb-4">
                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>

            <h3>Recomendaciones</h3>

            <!-- Fila -->
            <div class="row mb-4">
                <!-- Columnas -->

                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>

            <h3>Libros Físicos</h3>

            <!-- Fila -->

            <div class="row mb-4">
                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>
            <br />
            <br />
            <br />
            <br />
        </div>

        <?php echo generarFooter(); ?>
    </body>
</html>
