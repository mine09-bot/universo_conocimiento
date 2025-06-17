<?php
session_start();
require "config.php";
require "utils.php";
verificarSesion();
global $connection;

$error = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idLibro = (int)$_GET['id'];

    // Verifica que el usuario actual sea el creador
    $instruccion = "SELECT subidas.Usuario_idUsuario AS creador FROM libro
        LEFT JOIN subidas ON libro.idLibro = subidas.Libro_idLibro
        WHERE libro.idLibro = :id";
    $query = $connection->prepare($instruccion);
    $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();
    $libro = $query->fetch(PDO::FETCH_ASSOC);

    $creador = $libro['creador'];

    if ($libro && $creador == $_SESSION['idUsuario'] && puedeEliminarLibro($idLibro)) {
        //* Borra el libro
        $connection->beginTransaction();

        try {
            // Borrar de autorlibro
            $instruccion = "DELETE FROM autorlibro WHERE idLibro = :id";
            $query = $connection->prepare($instruccion);
            $borrar = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
            $query->execute();

            // Borrar de formatolibro
            $instruccion = "DELETE FROM formatolibro WHERE idLibro = :id";
            $query = $connection->prepare($instruccion);
            $borrar = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
            $query->execute();

            // Borrar de subidas
            $instruccion = "DELETE FROM subidas WHERE Libro_idLibro = :id";
            $query = $connection->prepare($instruccion);
            $borrar = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
            $query->execute();

            // Borrar de librofisico
            $instruccion = "DELETE FROM librofisico WHERE idLibro = :id";
            $query = $connection->prepare($instruccion);
            $borrar = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
            $query->execute();


            // Borrar libro
            $instruccion = "DELETE FROM libro WHERE idLibro = :id";
            $query = $connection->prepare($instruccion);
            $borrar = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
            $query->execute();

            $connection->commit();

            header("Location: inicio.php?borrado=1");
            exit;
        } catch (Exception $e) {
            $connection->rollBack();
            $error = 'No se puede eliminar el libro. Error: ' . $e;
            header("Location: detalles.php?id=$idLibro&msg=$error");
        }
    } else {
        $error = 'No se puede eliminar el libro.';
        header("Location: detalles.php?id=$idLibro&msg=$error");
    }
}
exit;
