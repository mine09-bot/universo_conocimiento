<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
$usuarios = [];


if (
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    isset($_GET['facultad'])
) {
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
            if (
                isset($_GET['accion']) && $_GET['accion'] === 'toggle'
                && isset($_GET['idUsuario'], $_GET['idFacultad'])
            ) {
                blockear();
            }
            $idUsuario = (int)$usu['idUsuario'];
            $nombre = htmlspecialchars($usu['nombre']);
            $apPaterno = htmlspecialchars($usu['apellidoPaterno']);
            $apMaterno = htmlspecialchars($usu['apellidoMaterno']);
            $correo = htmlspecialchars($usu['correoElectronico']);
            $telefono = htmlspecialchars($usu['telefono']);
            $fac = htmlspecialchars($usu['idFacultades']);
            $facultad = $fac = htmlspecialchars($usu['facultad']);
            $accion = htmlspecialchars($usu['bloqueado']);
            $universidad = htmlspecialchars($usu['universidad']);


            $html .= "<tr>
                    <td>$nombre</td>
                    <td>$apPaterno</td>
                    <td>$apMaterno</td>
                    <td>$correo</td>
                    <td>$telefono</td>
                    <td>$universidad</td>
                    <td>$facultad</td>
                    <td class='align-middle'>
            <div class='d-flex gap-2'>";
            $bloqueado = (int)$usu['bloqueado'];

            if ($bloqueado == 1) {
                $html .= "<a href=\"usuarios.php?accion=toggle&bloqueado=1&idUsuario={$idUsuario}&idFacultad={$fac}\" class=\"btn btn-success btn-sm\">
                  <i class=\"fa-solid fa-lock-open\"></i>
              </a>";
            } else {
                $html .= "<a href=\"usuarios.php?accion=toggle&bloqueado=0&idUsuario={$idUsuario}&idFacultad={$fac}\" class=\"btn btn-warning btn-sm\">
                  <i class=\"fa-solid fa-user-lock\"></i>
              </a>";
            }

            $html .= "</div>
        </td>
    </tr>";
        }
    }
}

function blockear()
{
    global $connection;

    $id = (int)($_GET['idUsuario'] ?? 0);
    $fac = (int)($_GET['idFacultad'] ?? 0);
    if (!$id) {
        header("Location: usuarios.php?facultad=$fac");
        exit;
    }

    $instruccion = "UPDATE usuario 
        SET bloqueado = IF(bloqueado = 1, 0, 1) 
        WHERE idUsuario = :id";
    $respuesta = $connection->prepare($instruccion);
    $respuesta->execute([':id' => $id]);

    header("Location: usuarios.php?facultad=$fac");
    exit;
}
