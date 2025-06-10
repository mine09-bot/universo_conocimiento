<?php
// Iniciar variables de sesión
session_start();
include('../config.php');
include('../utils.php');

$carpetaLogo = "../uploads/logo/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Paquete
        $paquete = $_POST;

        $logo = $paquete['logo'];
        $nombre = $paquete['nombre'];
        $facultad = $paquete['facultad'];
        $pais = $paquete['pais'];
        $telefono = $paquete['telefono'];
        $correoElectronico = $paquete['correo'];
        $contrasena = $paquete['contrasena'];


        $logo = $_FILES['logo'];
        // Comenzar transacción
        $connection->beginTransaction();

        $extension = pathinfo($logo['name'], PATHINFO_EXTENSION);
    } catch (Exception $e) { // Something happened!
        $connection->rollBack();
        $res = ['status' => 0, 'msg' => "Error de servidor", "error" => $e->getMessage()];
    }
}
