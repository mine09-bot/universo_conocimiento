<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();

global $connection;
$mostrarLibro = false;

if (isset($_GET['id'])) {
    $idLibro = $_GET['id'];

    if (is_numeric($idLibro)) {

        $instruccion = "SELECT
            libro.tituloLibro,
    libro.idLibro,
    facultades.idFacultades,
    facultades.nombreFacultad,
    universidad.pais,
    universidad.idUniversidad,
    universidad.nombreUniversidad,
    universidad.logoUni,
    librofisico.ejemplares,
    idioma.nombreIdioma,
    pais.nombrePais
FROM librofisico
LEFT JOIN libro ON librofisico.idLibro = libro.idLibro
LEFT JOIN facultades ON librofisico.idFacultad = facultades.idFacultades
LEFT JOIN universidad ON facultades.idUniversidad = universidad.idUniversidad
LEFT JOIN idioma ON librofisico.idIdioma = idioma.idIdioma
LEFT JOIN pais ON universidad.pais = pais.nombrePais
WHERE libro.idLibro = :id";

        $query = $connection->prepare($instruccion);
        $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
        $query->execute();
        $librofisico = $query->fetch(PDO::FETCH_ASSOC);
        if ($librofisico) {
            $ejemplar = (int)$librofisico['ejemplares'];
            if ($ejemplar > 0) {
                $mostrarLibro = true;
                // Variables

                $logoUni = $librofisico['logoUni'];
                $logo = "uploads/universidad/$logoUni";
                $tituloLibro = $librofisico['tituloLibro'];
                $universidad = $librofisico['nombreUniversidad'];
                $facultad = $librofisico['nombreFacultad'];
                $idioma = $librofisico['nombreIdioma'];
                $pais = $librofisico['nombrePais'];
            }
        }
    } else {
        echo "ID no válido.";
    }
}


?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Libros Físicos'); ?>
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
                            <?php if (!$mostrarLibro): ?>
                                <div class="row" id="nohaylibro">
                                    <div class="col-12">
                                        <div class="h4 pb-2 mb-4 text-white border-bottom border-success text-center">
                                            Libros Físicos
                                        </div>
                                        <h3>"Actualmente no hay ejemplares disponibles" </h3>
                                        <p>Estimado usuario:
                                            En este momento, no contamos con ejemplares disponibles. Sin embargo, estamos trabajando para reponer nuestro inventario.
                                            Si desea recibir una notificación cuando los libros estén nuevamente disponibles, le invitamos a proporcionarnos su Correo Electronico. De esta manera, podremos informarle oportunamente.
                                            Agradecemos su paciencia y comprensión.</p>
                                        <div class="mb-3 w-25">
                                            <label class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="correoElectronico" id="correoElectronico" required />
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>
                            <?php if ($mostrarLibro): ?>
                                <div class="row" id="sihaylibro">
                                    <div class="col-12 col-md-6">
                                        <div class="card" style="max-width: 540px">
                                            <div class="card-body">
                                                <img
                                                    src="<?php echo $logo; ?>"
                                                    alt="Bootstrap"
                                                    width="120"
                                                    height="100" />


                                                <p class="card-text">
                                                    <strong> Ubicacion: </strong><?php echo htmlspecialchars($universidad); ?>
                                                </p>

                                                <p class="card-text">
                                                <p><strong>Facultad:</strong> <?php echo htmlspecialchars($facultad); ?></p>
                                                </p>

                                                <p class="card-text">
                                                    <strong>Ejemplares disponibles:</strong> <?php echo (int)$ejemplar; ?>
                                                </p>
                                                <p class="card-text">
                                                    <strong>Idioma:</strong> <?php echo htmlspecialchars($idioma); ?>
                                                </p>
                                                <p class="card-text">
                                                    <strong>Pais:</strong> <?php echo htmlspecialchars($pais); ?>
                                                </p>
                                                <button class="btn btn-primary btn-lg">
                                                    Solicitar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="card" style="max-width: 540px">
                                            <div class="card-body">
                                                <img
                                                    src="assets/images/logo.svg"
                                                    alt="Bootstrap"
                                                    width="100"
                                                    height="100" />
                                                <p class="card-text">
                                                    <strong> Ubicacion: </strong>Universidad
                                                </p>
                                                <p class="card-text">
                                                    <strong>Ejemplares disponibles:</strong> 2
                                                </p>
                                                <p class="card-text">
                                                    <strong>Idioma:</strong> Idioma
                                                </p>
                                                <p class="card-text">
                                                    <strong>Pais:</strong> Pais
                                                </p>
                                                <button class="btn btn-primary btn-lg">
                                                    Solicitar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>


                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>