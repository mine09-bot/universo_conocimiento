if ($creador == ($_SESSION['idUsuario'])) {

$instruccion = "DELETE FROM libro
WHERE idLibro = :libro";
$borrar = $connection->prepare($instruccion);
$borrar->bindParam(":libro", $codigoIngresado, PDO::PARAM_STR);

$borrar->execute();
$msj = "¡Contraseña actualizada exitosamente!";
header("Location: inicio.php");
exit;
$botonBorrar = "";

$botonBorrar =
<a href="borrar.php?id=<?php echo $idLibro; ?>"
    class="btn btn-danger"
    onclick="return confirm('¿Seguro que deseas borrar este libro?')">
    Borrar
</a>
} else {
// Regresar al usuario al listado
header('Location: listado.php');
}