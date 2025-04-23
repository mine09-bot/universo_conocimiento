<?php
// Iniciar variables de sesión
session_start();

// Incluir archivo de configuracion
include('../config.php');
include('../utils.php');

$carpetaImagen = "../uploads/portada/";
$carpetaArchivo = "../uploads/archivo/";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Paquete
        $paquete = $_POST;

        $titulo = $paquete['titulo'];
        $autor = $paquete['autor'];
        $anoedicion = $paquete['anoedicion'];
        $categoria = $paquete['categoria'];
        $editorial = $paquete['editorial'];
        $formato = $paquete['formato'];
        $idioma = $paquete['idioma'];
        $isbn = $paquete['isbn'];
        $numpaginas = $paquete['numpaginas'];
        $pais = $paquete['pais'];
        $sinopsis = $paquete['sinopsis'];

        $portada = $_FILES['portada'];
        $cargarLibro  = $_FILES['cargarlibro'];
