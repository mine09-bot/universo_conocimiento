<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
$usuarios = [];
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['textoreporte'])
) {
    $rep = $_POST['textoreporte'];
}
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Reportes'); ?>
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
                                Reportes
                                <td class="text-end">
                                    <a class="btn btn-primary btn-sm float-end" href="panelAdmin.php" role="button">Regresar</a>
                                </td>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Universidad</th>
                                            <th>Facultad</th>
                                            <th>Correo Electronico</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $html ?? '' ?>


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