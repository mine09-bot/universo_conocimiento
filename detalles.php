<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<head>  
<?php echo generarEncabezado('Descargar'); ?>
</head>
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
            <div class="container-md p-3">
                <form class="row mb-4 g-1">
                    <div class="col-6 d-grid gap-2">
                        <img
                            src="Informatica.jpg"
                            alt="Bootstrap"
                            width="250"
                            height="300"
                        />
                    </div>
                    <div class="col-6 d-grid gap-2">
                        <div class="card" style="max-width: 540px">
                            <div class="row g-0">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            Título del Libro
                                        </h5>
                                        <p class="card-text">
                                            <strong>Autor:</strong> Nombre del
                                            Autor
                                        </p>
                                        <p class="card-text">
                                            <strong>Editorial:</strong>
                                            Editorial
                                        </p>
                                        <p class="card-text">
                                            <strong>Año de Edición:</strong>
                                            2024
                                        </p>
                                        <p class="card-text">
                                            <strong>ISBN:</strong>
                                            978-3-16-148410-0
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-md p-3">
                <form class="row g-1 space-between">
                    <div class="col-3 d-flex flex-column gap-2">
                        <button class="btn btn-secondary" type="button">
                            PDF
                        </button>
                        <button class="btn btn-secondary" type="button">
                            EPUB
                        </button>
                        <button class="btn btn-secondary" type="button">
                            MOBI
                        </button>
                        <button class="btn btn-secondary" type="button">
                            AZW
                        </button>
                        <button class="btn btn-secondary" type="button">
                            CBR
                        </button>
                    </div>

                    <div class="col-3 d-flex flex-column gap-2">
                        <button class="btn btn-secondary" type="button">
                            HTML
                        </button>
                        <button class="btn btn-secondary" type="button">
                            TXT
                        </button>
                        <button class="btn btn-secondary" type="button">
                            CBZ
                        </button>
                        <button class="btn btn-secondary" type="button">
                            Libro Fisico
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php echo generarFooter(); ?>
    </body>
</html>
