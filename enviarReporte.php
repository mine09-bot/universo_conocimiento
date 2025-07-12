<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idUsuario = $_SESSION['idUsuario'];
    $mensaje = ($_POST['mensaje']);
    $fecha = date('Y-m-d H:i:s');
    $estado = 'pendiente';
    $idLibro = $_POST['idLibro'] ?? null;


    $instruccion = "INSERT INTO reportes (idUsuario, mensaje, fecha, estadoReporte, idLibro)  VALUES (:usu, :msj, :fecha, :estado, :lib)";

    $query = $connection->prepare($instruccion);
    $query->bindParam(':usu', $idUsuario);
    $query->bindParam(':msj', $mensaje);
    $query->bindParam(':fecha', $fecha);
    $query->bindParam(':estado', $estado);
    $query->bindParam(':lib', $idLibro);
    $query->execute();

    foreach ($respuesta as $repusu) {
        $idreporte = $repusu['idReporte'];
        $idLibro = $repusu['idLibro'];
        $idUsuario = $repusu['idUsuario'];
        $mensaje = $repusu['mensaje'];
        $fecha = $repusu['fecha'];
        $estado = $repusu['estadoReporte'];
    }


    header("Location: detalles.php?id=$idLibro&reporte=enviado");
    exit;
}
