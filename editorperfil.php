<?php
session_start();
require "utils.php";
require "config.php";

verificarSesion();

$idUsuario = $_SESSION['idUsuario']; // siempre disponible si el usuario ha iniciado sesión

$instruccion = "SELECT 
    usuario.nombre, 
    usuario.apellidoPaterno, 
    usuario.apellidoMaterno, 
    usuario.pais,
    usuario.linkedIn,
    usuario.facebook,
    usuario.foto,
    facultades.nombreFacultad AS facultad,
    universidad.idUniversidad,
    universidad.nombreUniversidad AS universidad
FROM usuario 
JOIN facultades ON usuario.idFacultad = facultades.idFacultades
JOIN universidad ON facultades.idUniversidad = universidad.idUniversidad
WHERE usuario.idUsuario = :id";

$query = $connection->prepare($instruccion);
$query->execute([':id' => $idUsuario]);
$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $nombre = $usuario['nombre'];
    $apellidoPaterno = $usuario['apellidoPaterno'];
    $apellidoMaterno = $usuario['apellidoMaterno'];
    $facultad = $usuario['facultad'];
    $universidad = $usuario['idUniversidad'];
    $pais = $usuario['pais'];
    $linkedIn = $usuario['linkedIn'];
    $facebook = $usuario['facebook'];
    $foto = $usuario['foto'];
}



function generarPais(int $idPais = 0)
{
    global $connection;
    $instruccion = "SELECT * FROM pais";
    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idPais == 0 ? "selected" : "";
    $html = "<option $selected disabled value=''>Selecciona</option>";

    foreach ($respuesta as $cat) {
        $pais = $cat['idPais'];
        $nombre = $cat['nombrePais'];
        $selEditor = $idPais == $pais ? "selected" : "";

        $html .= "<option value='$pais' $selEditor>$nombre</option>";
    }

    return $html;
    // condicional ? verdadera : falsa
    // Operdor ?
}

function generarUniversidad(int $idUniversidad = 0)
{
    global $connection;
    $instruccion = "SELECT * FROM universidad";
    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idUniversidad == 0 ? "selected" : "";
    $html = "<option $selected disabled value=''>Selecciona</option>";

    foreach ($respuesta as $uni) {
        $universidad = $uni['idUniversidad'];
        $nombre = $uni['nombreUniversidad'];
        $selEditor = $idUniversidad == $universidad ? "selected" : "";

        $html .= "<option value='$universidad' $selEditor>$nombre</option>";
    }

    return $html;
    // condicional ? verdadera : falsa
    // Operdor ?
}



?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Editar Perfil'); ?>
    <script src="js/actualizaperfil.js?v=1.9" defer></script>
</head>

<body>
    <!-- Carga -->
    <div
        class="d-none position-absolute w-100 h-100 left-0 top-0 page-loader flex-column bg-dark bg-opacity-50 d-flex justify-content-center align-items-center"
        id="contenedor-carga"
        style="z-index: 1021">
        <div class="flipping">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Guardando libro...</span>
    </div>

    <!-- Contenido -->
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav();  ?>
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <form id="formulario">
                                <div class="row">
                                    <div class="col-12">
                                    </div>
                                </div>
                        </div>
                        <div class="row g-4">

                            <!-- Columna 1 -->
                            <div class="col-12 col-md-6">
                                <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                    Informacion Personal
                                </div>
                                <input type="hidden" id="idLibro" name="idLibro" value="<?php echo $idLibro ?? ''; ?>">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Foto de Perfil</label>
                                    <input class="form-control" type="file" accept="image/*" <?php echo isset($idUsuario) ? '' : 'required'; ?> name="foto" id="foto" />

                                </div>

                                <!-- Formulario para actualizar la foto de perfil -->

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="nombre" id="nombre" value="<?php echo $nombre ?? ''; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Apellido Paterno</label>
                                    <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="apellidoPaterno" id="apellidoPaterno" value="<?php echo $apellidoPaterno ?? ''; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="apellidoMaterno" id="apellidoMaterno" value="<?php echo $apellidoMaterno ?? ''; ?>" />
                                </div>

                                <div class="mb-3">
                                    <label for="universidad" class="form-label">Universidad</label>
                                    <select class="form-select" aria-label="Large select example" id="universidad" required name="universidad"><?php echo generarUniversidad($universidad ?? 0); ?></select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Facultad</label>
                                    <input type="text" class="form-control" rows="1" minlength="5" maxlength="64" required name="facultad" id="facultad" value="<?php echo $facultad ?? ''; ?>" />
                                </div>
                            </div>

                        </div>




                        <div class="col-12 col-md-6">
                            <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                Redes Sociales
                            </div>
                            <h5>Redes Sociales</h5>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" rows="1" minlength="5" maxlength="64" required name="linkedIn" id="linkedIn" value="<?php echo $linkedIn ?? ''; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Facebook</label>
                                <input type="text" class="form-control" rows="1" minlength="5" maxlength="64" required name="facebook" id="facebook" value="<?php echo $facebook ?? ''; ?>" />
                            </div>


                            <div class="mb-3">
                                <label for="pais" class="form-label">Pais</label>
                                <select class="form-select" aria-label="Large select example" id="pais" required name="pais">

                                    <?php echo generarPais($pais ?? 0); ?>
                                </select>
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>
                    </div>





                    </form>
                </div>
            </div>
        </div>
        <?php echo generarFooter(); ?>
    </div>
    </div>
    </div>

    <!-- Diálogo éxito -->
    <div class="modal fade" id="dialogo-exito" tabindex="-1" aria-labelledby="label-exito" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="label-exito">Éxito</h1>
                </div>
                <div class="modal-body">Perfil actualizado exitosamente</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="boton-cerrar-exito">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Diálogo error -->
    <div class="modal fade" id="dialogo-error" tabindex="-1" aria-labelledby="label-error" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="label-error">Error</h1>
                </div>
                <div class="modal-body" id="mensajeError">Ha ocurrido un error al actualizar el Pefil: [error]</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
    <script>

    </script>

</body>

</html>