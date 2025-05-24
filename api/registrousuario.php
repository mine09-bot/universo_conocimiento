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

        $nombre = $paquete['nombre'];
        $apPaterno = $paquete['apellidoPaterno'];
        $apMaterno = $paquete['apellidoMaterno'];
        $correo = $paquete['correoElectronico'];
        $telefono = $paquete['telefono'];
        $contrasena = $paquete['contrasena'];
        $usuario = $paquete['nombreUsuario'];
        $sexo = $paquete['sexo'];
        $pais = $paquete['pais'];
        $nivelUsuario = 2;
        $idFacultad = $paquete['idFacultad'];

        $contrasenaHasheada = md5($contrasena);
        $connection->beginTransaction();

        $instruccion = "INSERT INTO usuario 
            (nombre, apellidoPaterno, apellidoMaterno, correoElectronico, telefono, contrasena, nombreUsuario, sexo, pais, nivelUsuario, idFacultad) 
            VALUES (:nombre, :apPaterno, :apMaterno, :correo, :telefono, :contrasena, :nombreUsuario, :sexo, :pais, :nivelUsuario, :idFacultad)";

        $query = $connection->prepare($instruccion);
        $query->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam(":apPaterno", $apPaterno, PDO::PARAM_STR);
        $query->bindParam(":apMaterno", $apMaterno, PDO::PARAM_STR);
        $query->bindParam(":correo", $correo, PDO::PARAM_STR);
        $query->bindParam(":telefono", $telefono, PDO::PARAM_STR);
        $query->bindParam(":contrasena", $contrasenaHasheada, PDO::PARAM_STR);
        $query->bindParam(":nombreUsuario", $usuario, PDO::PARAM_STR);
        $query->bindParam(":sexo", $sexo, PDO::PARAM_STR);
        $query->bindParam(":pais", $pais, PDO::PARAM_STR);
        $query->bindParam(":nivelUsuario", $nivelUsuario, PDO::PARAM_INT);
        $query->bindParam(":idFacultad", $idFacultad, PDO::PARAM_INT);
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
