<?php
// Iniciar variables de sesión
session_start();
include('../config.php');
include('../utils.php');

$carpetaImagen = "../uploads/universidad/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Paquete
        $paquete = $_POST;

        $nombre = $paquete['nombre'];
        $facultades = json_decode($paquete['facultades']);
        $pais = $paquete['pais'];

        $logo = $_FILES['logo'];

        // Comenzar transacción
        $connection->beginTransaction();

        $nombreArchivo = '';

        // Generar un nombre de archivo para el logo (id de la uni o UUID)
        if ($logo["error"] === UPLOAD_ERR_OK) {
            $extension = strtolower(pathinfo($logo['name'], PATHINFO_EXTENSION));
            $uuid = bin2hex(random_bytes(16));
            $nombreArchivo = $uuid . '.' . $extension;

            // Guardar Logo
            $rutaCompleta = $carpetaImagen . $nombreArchivo;

            if (!move_uploaded_file($logo['tmp_name'], $rutaCompleta)) {
                throw new Exception('Error al subir logo de universidad');
            }
        } else {
            throw new Error("Imagen no cargada correctamente");
        }

        // Guardar Universidad
        $instruccion = "INSERT INTO universidad(nombreUniversidad, logoUni, pais) VALUES (:nomUni, :logUni, :pais)";
        $query = $connection->prepare($instruccion);
        $query->bindParam("nomUni", $nombre, PDO::PARAM_STR);
        $query->bindParam("logUni", $nombreArchivo, PDO::PARAM_STR);
        $query->bindParam("pais", $pais, PDO::PARAM_STR);
        $query->execute();

        // Obtener ID de la universidad
        $idUniversidad = $connection->lastInsertId();

        // Guardar Facultades
        for ($i = 0; $i < sizeof($facultades); $i++) {
            $facu = $facultades[$i];
            $instruccion = "INSERT INTO facultades(nombreFacultad, direccion, codigoPostal, telefono, idUniversidad, idAdministrador) VALUES (:nomFacu, :dir, :codPost, :tel, :uni, :admi)";
            $query = $connection->prepare($instruccion);
            $query->bindParam("nomFacu", $facu->nombre, PDO::PARAM_STR);
            $query->bindParam("dir", $facu->direccion, PDO::PARAM_STR);
            $query->bindParam("codPost", $facu->codigoPostal, PDO::PARAM_STR);
            $query->bindParam("tel", $facu->telefono, PDO::PARAM_STR);
            $query->bindParam("uni", $idUniversidad, PDO::PARAM_STR);
            $query->bindParam("admi", $_SESSION['idUsuario'], PDO::PARAM_STR);

            $query->execute();
        }

        // Hacer commit a la transacción
        $connection->commit();
        // Devolver respuesta
        $res = ['status' => 1, 'paquete' => $_POST, 'facs' => $facultades];
    } catch (Exception $e) { // Something happened!
        $connection->rollBack();
        $res = ['status' => 0, 'msg' => "Error de servidor", "error" => $e->getMessage()];
    }
}

echo json_encode($res);
