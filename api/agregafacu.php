<?php

include('../config.php');
include('../utils.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_POST)) {
            throw new Exception("POST vacío, no se recibieron datos");
        }
        $paquete = $_POST;

        $facultad = $paquete['facultad'];
        $telefono = $paquete['telefono'];
        $direccion = $paquete['direccion'];
        $pais = $paquete['pais'];
        $codigoPostal = $paquete['codigo'];
        file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);

        $connection->beginTransaction();

        $instruccion = "INSERT INTO facultades
        (nombreFacultad, direccion, codigoPostal, telefono, pais) 
        VALUES (:facultad, :direccion, :codigo, :telefono, :pais)";


        $query = $connection->prepare($instruccion);
        $query->bindParam(":facultad", $facultad, PDO::PARAM_STR);
        $query->bindParam(":direccion", $direccion, PDO::PARAM_STR);
        $query->bindParam(":codigo", $codigoPostal, PDO::PARAM_STR);
        $query->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $query->bindParam(":pais", $pais, PDO::PARAM_STR);

        $query->execute();

        $connection->commit();

        $res = ['status' => 1, 'paquete' => $_POST];
    } catch (Exception $e) {
        $connection->rollBack();
        $res = ['status' => 0, 'msg' => "Error de servidor", "error" => $e->getMessage()];
    }
} else {
    $res = ['status' => 0, 'msg' => "Error de envío POST", "error" => $_SERVER['REQUEST_METHOD']];
}

echo json_encode($res);
