<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Mision'); ?>
    
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
            <div class="container-md mt-2">
                <form class="row g-1">
                    <div class="col-4 d-flex flex-column gap-2">
                        <img
                            src="logoproyecto.webp"
                            class="img-fluid"
                            alt="Bootstrap"
                            width="300"
                            height="300"
                        />
                    </div>
                    <div class="col-8 d-grid gap-3">
                        <div class="container">
                            <div class="card" style="max-width: 540px">
                                <div class="row g-0">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="card-header">
                                                Mision
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        Facilitar el acceso
                                                        global al conocimiento
                                                        académico mediante una
                                                        biblioteca digital y
                                                        física interconectada
                                                        entre universidades,
                                                        ofreciendo a
                                                        estudiantes,
                                                        investigadores y
                                                        docentes una plataforma
                                                        intuitiva y eficiente
                                                        para la búsqueda,
                                                        descarga y solicitud de
                                                        libros en diversos
                                                        formatos. Nuestro
                                                        objetivo es fomentar el
                                                        aprendizaje, la
                                                        investigación y la
                                                        colaboración
                                                        internacional a través
                                                        de una experiencia
                                                        tecnológica accesible,
                                                        segura y de alta
                                                        calidad.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php echo generarFooter(); ?>
    </body>
</html>
