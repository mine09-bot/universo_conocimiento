<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Prestamo'); ?>
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
                            <div class="h2 pb-2 mb-4 text-white border-bottom border-success">
                                📬 Solicitudes de libros físicos
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Libro</th>
                                            <th>Facultad</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Estado</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
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