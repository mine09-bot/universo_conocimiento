<?php
session_start();
require "config.php";
verificarSesion();

if ($_SESSION['nivel'] != 2) {
    header("Location: inicio.php");
    exit;
}

$sql = "SELECT r.idReporte, r.asunto, r.mensaje, r.fecha,
               u.nombre, u.apellidoPaterno
        FROM reporte r
        JOIN usuario u ON r.idUsuario = u.idUsuario
        ORDER BY r.fecha DESC";
$stmt = $connection->prepare($sql);
$stmt->execute();
$reportes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head><?php echo generarEncabezado('Reportes'); ?></head>

<body>
    <?php echo generarBarraNav(); ?>
    <div class="container mt-4">
        <h2>Reportes recibidos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Asunto</th>
                        <th>Mensaje</th>
                        <th>Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reportes as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['fecha']) ?></td>
                            <td><?= htmlspecialchars($r['asunto']) ?></td>
                            <td><?= nl2br(htmlspecialchars($r['mensaje'])) ?></td>
                            <td><?= htmlspecialchars($r['nombre'] . ' ' . $r['apellidoPaterno']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php echo generarFooter(); ?>
</body>

</html>