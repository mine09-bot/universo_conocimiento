<?php
session_start();
include('../config.php');
include('../utils.php');

header('Content-Type: application/json');
$carpetaFotoPerfil = "../uploads/perfil/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $paquete = $_POST;
        $nombre = $paquete['nombre'];
        $apPaterno = $paquete['apellidoPaterno'];
        $apMaterno = $paquete['apellidoMaterno'];
        $pais = $paquete['pais'];
        $linked = $paquete['linkedIn'];
        $facebook = $paquete['facebook'];
        $facultad = $paquete['facultad'];
        $universidad = $paquete['universidad'];

        $foto = $_FILES['foto'];
        $idUsuario = $_SESSION['idUsuario'];

        $connection->beginTransaction();

        // Subir foto si se proporcionó
        if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
            $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
            $tamanoMax = 2 * 1024 * 1024; // 2 MB
            $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
            $tipo = $foto['type'];
            $tamano = $foto['size'];

            if (!in_array($tipo, $permitidos)) {
                throw new Exception('Tipo de imagen no permitido');
            }
            if ($tamano > $tamanoMax) {
                throw new Exception('Imagen demasiado grande');
            }

            $nombreArchivo = $idUsuario . '.' . $extension; // CORREGIDO
            $rutaCompleta = $carpetaFotoPerfil . $nombreArchivo;

            if (!move_uploaded_file($foto['tmp_name'], $rutaCompleta)) {
                throw new Exception('Error al subir foto de perfil');
            }
        } else {
            // Obtener nombre actual de la foto si no se subió una nueva
            $stmt = $connection->prepare("SELECT foto FROM usuario WHERE idUsuario = :idUsuario");
            $stmt->execute([':idUsuario' => $idUsuario]);
            $nombreArchivo = $stmt->fetchColumn(); // CORREGIDO
        }

        $instruccion = "UPDATE usuario 
            SET nombre = :nombre,
                apellidoPaterno = :apPaterno,
                apellidoMaterno = :apMaterno,
                pais = :pais,
                foto = :foto,
                linkedIn = :linked,
                facebook = :facebook
            WHERE idUsuario = :idUsuario";

        $sentencia = $connection->prepare($instruccion);
        $sentencia->execute([
            ':nombre' => $nombre,
            ':apPaterno' => $apPaterno,
            ':apMaterno' => $apMaterno,
            ':pais' => $pais,
            ':foto' => $nombreArchivo,
            ':linked' => $linked,
            ':facebook' => $facebook,
            ':idUsuario' => $idUsuario
        ]);

        $connection->commit();

        // Actualizar las variables de sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidoPaterno'] = $apPaterno;
        $_SESSION['apellidoMaterno'] = $apMaterno;
        $_SESSION['facultad'] = $facultad;
        $_SESSION['universidad'] = $universidad;

        echo json_encode(['status' => 1, 'msg' => 'Perfil actualizado correctamente']);
    } catch (Exception $e) {
        $connection->rollBack();
        echo json_encode(['status' => 0, 'msg' => 'Error al actualizar perfil', 'error' => $e->getMessage()]);
    }
}
