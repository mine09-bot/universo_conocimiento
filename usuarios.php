<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();



//bloquear/desbloquear
if (isset($_GET['accion'], $_GET['idUsuario'], $_GET['facultad']) && $_GET['accion'] === 'toggle') {
    $id = (int)$_GET['idUsuario'];
    $fac = (int)$_GET['facultad'];
    if ($id) {
        $instruccion = "UPDATE usuario 
                        SET bloqueado = IF(bloqueado = 1, 0, 1) 
                        WHERE idUsuario = :id";
        $respuesta = $connection->prepare($instruccion);
        $respuesta->execute([':id' => $id]);
    }
    header("Location: usuarios.php?facultad=$fac");
    exit;
}

// preparar tabla
$html = '';
if (isset($_GET['facultad'])) {
    $idFacu = (int)$_GET['facultad'];
    $instruccion = "SELECT usuario.nombre,
                   usuario.apellidoPaterno,
                   usuario.apellidoMaterno, 
                   usuario.correoElectronico, 
                   usuario.telefono,
                   usuario.bloqueado,
                   usuario.idUsuario,
                   universidad.nombreUniversidad AS universidad,
                   facultades.nombreFacultad AS facultad,
                   facultades.idFacultades
            FROM usuario
            JOIN facultades  ON usuario.idFacultad = facultades.idFacultades
            JOIN universidad ON facultades.idUniversidad = universidad.idUniversidad
            WHERE facultades.idFacultades = :fac";
    $query = $connection->prepare($instruccion);
    $query->execute([':fac' => $idFacu]);
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $html = "";


    if (!$respuesta) {
        $html = "<tr><td colspan='8' class='text-center'>No hay usuarios registrados.</td></tr>";
    } else {
        foreach ($respuesta as $usu) {
            $idUsuario = (int)$usu['idUsuario'];
            $bloqueado = (int)$usu['bloqueado'];
            $boton = $bloqueado ? "<a href='usuarios.php?facultad=$idFacu&accion=toggle&idUsuario=$idUsuario' class='btn btn-success btn-sm'>
                     <i class='fa-solid fa-lock-open'></i>
                   </a>"
                : "<a href='usuarios.php?facultad=$idFacu&accion=toggle&idUsuario=$idUsuario' class='btn btn-warning btn-sm'>
                     <i class='fa-solid fa-user-lock'></i>
                   </a>";

            $nombre = htmlspecialchars($usu['nombre']);
            $apPaterno = htmlspecialchars($usu['apellidoPaterno']);
            $apMaterno = htmlspecialchars($usu['apellidoMaterno']);
            $correo = htmlspecialchars($usu['correoElectronico']);
            $telefono = htmlspecialchars($usu['telefono']);
            $fac = htmlspecialchars($usu['idFacultades']);
            $facultad = $fac = htmlspecialchars($usu['facultad']);
            $universidad = htmlspecialchars($usu['universidad']);

            $html .= "<tr>
                    <td>$nombre</td>
                    <td>$apPaterno</td>
                    <td>$apMaterno</td>
                    <td>$correo</td>
                    <td>$telefono</td>
                    <td>$universidad</td>
                    <td>$facultad</td>

            
                        <td class='align-middle'><div class='d-flex gap-2'>$boton</div></td>
                      </tr>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Usuarios'); ?>
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
                                Usuarios
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
                                            <th>Correo Electronico</th>
                                            <th>Telefono</th>
                                            <th>Universidad</th>
                                            <th>Facultad</th>
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