<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();

function generarUniversidad(int $idUniversidad = 0)
{
    global $connection;

    $instruccion = "SELECT
    universidad.idUniversidad,
    universidad.nombreUniversidad
    FROM universidad";


    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idUniversidad == 0 ? "selected" : "";

    $html = "<option disabled selected value=''>Selecciona una Universidad</option>";

    foreach ($respuesta as $uni) {

        $idUni = $uni['idUniversidad'];
        $nombreUniversidad = $uni['nombreUniversidad'];
        $selEditor = $idUni == $idUniversidad ? "selected" : "";

        $html .= "<option value='$idUni' $selEditor>$nombreUniversidad</option>";
    }

    return $html;
}

function generarFacultad(int $idFacultades = 0)
{
    global $connection;

    $instruccion = "SELECT
    facultades.idFacultades,
    facultades.nombreFacultad,
    facultades.idUniversidad,
    universidad.nombreUniversidad
    FROM facultades
    LEFT JOIN universidad ON facultades.idUniversidad = universidad.idUniversidad
    ORDER BY universidad.nombreUniversidad, facultades.nombreFacultad";


    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idFacultades == 0 ? "selected" : "";

    $html = "<option disabled selected value=''>Selecciona una Facultad</option>";


    foreach ($respuesta as $facu) {

        $idFacultad = $facu['idFacultades'];
        $nombreFacultad = $facu['nombreFacultad'];
        $nombreUniversidad = $facu["nombreUniversidad"];
        $selEditor = $idFacultad == $idFacultades ? "selected" : "";

        $html .= "<option value='$idFacultad' $selEditor>$nombreUniversidad - $nombreFacultad</option>";
    }
    return $html;
}

?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Panel Admin'); ?>
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
                            <div class="d-flex flex-column align-items-start mb-4 border-bottom border-primary">
                                <img src="assets/images/logo.svg" alt="Bootstrap" width="200" />
                                <h3 class="mt-3"> Panel</h3>
                            </div>
                            <form id="form_panel" method="POST" enctype="multipart/form-data">
                                <div class="row align-items-start gx-4">
                                    <!-- Columna izquierda: logo y formulario -->
                                    <div class="col-md-6 col-lg-4">

                                        <div class="mb-3">
                                            <a class="btn btn-secondary w-50" href="listado.php" role="button">Libros</a>

                                        </div>

                                        <div class="mb-3">
                                            <button type="button" class="btn btn-secondary w-50" data-bs-toggle="modal" data-bs-target="#dialogo-usuarios">
                                                Usuarios
                                            </button>
                                        </div>

                                        <div class="mb-3">
                                            <button type="button" class="btn btn-secondary w-50" data-bs-toggle="modal" data-bs-target="#reportes.php">
                                                Reportes
                                            </button>
                                        </div>

                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- modal-->
                <div class="modal fade" id="dialogo-usuarios" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form class="modal-content" method="get" action="usuarios.php">
                            <div class="modal-header">
                                <h5 class="modal-title">Selecciona Universidad y Facultad</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <select name="facultad" class="form-select" required>
                                        <?php echo generarFacultad($facultad ?? 0); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>


                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>