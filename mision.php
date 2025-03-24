<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Mision'); ?>

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
                            <form class="row g-1">
                                <div class="col-4 d-flex flex-column gap-2">
                                    <img
                                        src="logoproyecto.webp"
                                        class="img-fluid"
                                        alt="Bootstrap"
                                        width="300"
                                        height="300" />
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
                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>