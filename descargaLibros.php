<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();

$archivo = "uploads/archivo";


function descargar($file, $idLibro, $ext)
{
    global $connection;

    if (file_exists($file)) {
        $instruccion = "SELECT tituloLibro FROM libro WHERE idLibro = $idLibro;";

        $query = $connection->prepare($instruccion);
        $query->execute();
        $libro = $query->fetch(PDO::FETCH_ASSOC);

        $titulo = $libro['tituloLibro'];

        // Forzar descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $titulo . '.' . $ext . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        die("El archivo $file no existe.");
    }
}

if (isset($_GET['id'], $_GET['ext'])) {
    $nombreArchivo = basename($_GET['id'] . '.' . $_GET['ext']);
    $ruta = "$archivo/$nombreArchivo";
    descargar($ruta, $_GET['id'], $_GET['ext']);
}
