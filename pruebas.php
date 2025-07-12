$instruccion = "SELECT COUNT(*) FROM reportes WHERE estadoReporte = 'pendiente'";
$respuesta = $connection->query($instruccion);
$pendientes = $respuesta->fetchColumn();

<?php echo $pendientes; ?>