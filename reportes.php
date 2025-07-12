<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
$usuarios = [];

if (isset($_GET['accion'], $_GET['idReporte'])) {
    $id = (int)$_GET['idReporte'];

    if ($_GET['accion'] === 'toggle') {
        $instruccion = "UPDATE reportes 
                        SET estadoReporte = IF(estadoReporte = 'revisado', 'pendiente', 'revisado') 
                        WHERE idReporte = :id";
        $respuesta = $connection->prepare($instruccion);
        $respuesta->execute([':id' => $id]);
    } elseif ($_GET['accion'] === 'eliminar') {
        $instruccion = "DELETE FROM reportes WHERE idReporte = :id";
        $respuesta = $connection->prepare($instruccion);
        $respuesta->execute([':id' => $id]);
    }
    header("Location: reportes.php?reporte=$id");
    exit;
}



$instruccion = "SELECT 
                reportes.idReporte, 
                reportes.mensaje, 
                reportes.fecha,
                reportes.estadoReporte,
                libro.tituloLibro,
                libro.idLibro,
                usuario.nombre, 
                usuario.apellidoPaterno,
                usuario.apellidoMaterno,
                usuario.correoElectronico
        FROM reportes 
        JOIN usuario ON reportes.idUsuario = usuario.idUsuario
        JOIN libro ON reportes.idLibro = libro.idLibro
        ORDER BY reportes.fecha ASC";
$query = $connection->prepare($instruccion);
$query->execute();
$reportes = $query->fetchAll(PDO::FETCH_ASSOC);

$htmlPendientes = "";
$htmlRevisados = "";


foreach ($reportes as $rep) {
    $idReporte = (int)$rep['idReporte'];
    $estado = $rep['estadoReporte'];

    $boton = ($estado == 'pendiente')
        ? "<a href='reportes.php?idReporte=$idReporte&accion=toggle' class='btn btn-success btn-sm'>
            <i class='fa-solid fa-circle-check'></i>
       </a>"
        : "<a href='reportes.php?idReporte=$idReporte&accion=eliminar' class='btn btn-danger btn-sm'>
            <i class='fa-solid fa-trash'></i>
       </a>";

    $fecha = htmlspecialchars($rep['fecha']);
    $idLibro = (int)$rep['idLibro'];
    $libro = htmlspecialchars($rep['tituloLibro']);
    $mensaje = htmlspecialchars($rep['mensaje']);
    $nombre = htmlspecialchars($rep['nombre']);
    $apPaterno = htmlspecialchars($rep['apellidoPaterno']);
    $apMaterno = htmlspecialchars($rep['apellidoMaterno']);
    $correo = htmlspecialchars($rep['correoElectronico']);
    $estadoTexto = ($estado == 'pendiente') ? 'Pendiente' : 'Revisado';

    $fila = "<tr>
        <td>$fecha</td>
        <td><a href='detalles.php?id=$idLibro' class='link-light'>$libro</a></td>
        <td>$mensaje</td>
        <td>$nombre $apPaterno $apMaterno</td>
        <td>$correo</td>
        <td>$estadoTexto</td>
        <td>$boton</td>
                      </tr>";

    if ($estado == 'pendiente') {
        $htmlPendientes .= $fila;
    } else {
        $htmlRevisados .= $fila;
    }
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
                                Reportes Recibidos
                                <td class="text-end">
                                    <a class="btn btn-primary btn-sm float-end" href="panelAdmin.php" role="button">Regresar</a>
                                </td>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Libro</th>
                                            <th>Reporte</th>
                                            <th>Usuario</th>
                                            <th>correoElectronico</th>
                                            <th>Estado del Reporte</th>
                                            <th>Verificar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?= $htmlPendientes . $htmlRevisados ?>


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