<?php
//session_start();

require "utils.php";
require "config.php";
// verificarSesion();


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
function generarFacultad(int $idFacultades = 0)
{
    global $connection;

    $instruccion = "SELECT
    facultades.idFacultades,
    facultades.nombreFacultad,
    facultades.idUniversidad,
    universidad.nombreUniversidad
    FROM facultades
    LEFT JOIN universidad ON facultades.idUniversidad = universidad.idUniversidad
    ORDER BY universidad.nombreUniversidad, facultades.nombreFacultad";


    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idFacultades == 0 ? "selected" : "";

    $html = "<option disabled selected value=''>Selecciona una Facultad</option>";

    foreach ($respuesta as $facu) {

        $idFacultad = $facu['idFacultades'];
        $nombreFacultad = $facu['nombreFacultad'];
        $nombreUniversidad = $facu["nombreUniversidad"];
        $selEditor = $idFacultad == $idFacultades ? "selected" : "";

        $html .= "<option value='$idFacultad' $selEditor>$nombreUniversidad - $nombreFacultad</option>";
    }

    return $html;
}

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Registro de Usuario'); ?>
    <script src="js/regusuario.js?v=1.10" defer></script>
</head>

<body>
    <div class="container-md mt-2">
        <form id="formulario" class="row g-1" method="post" autocomplete="off">
            <div class="col-6 d-flex flex-column gap-2">
                <img src="assets/images/logo.svg" alt="Bootstrap" width="300" height="300" />
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>



            <div class="col-6 d-grid gap-3">
                <div class="container">
                    <div class="mb-3">
                        <p>Registro de Nuevo usuario</p>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="64" minlength="2" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" maxlength="64" minlength="2" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" maxlength="64" minlength="2" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facultad</label>
                            <select class="form-select" name="idFacultad" id="idFacultad" required>
                                <?php echo generarFacultad($facultad ?? 0); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correoElectronico" id="correoElectronico" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" required autocomplete="off" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" required autocomplete="off" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sexo</label>
                            <select class="form-select" name="sexo" id="sexo" required>
                                <option disabled selected value="">Selecciona una opción</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">Otro</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">País</label>
                            <select class="form-select" name="pais" id="pais" required>
                                <?php echo generarPais($pais ?? 0); ?>
                            </select>
                        </div>
                    </div>
                </div>
        </form>

    </div>

    <!-- Diálogo éxito -->
    <div class="modal fade" id="dialogo-exito" tabindex="-1" aria-labelledby="label-exito" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="label-exito">Éxito</h1>
                </div>
                <div class="modal-body">Usuario dado de Alta correctamente</div>
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
                <div class="modal-body" id="mensajeError">Ha ocurrido un error al crear Usuario: [error]</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Carga -->
    <div id="contenedor-carga" class="d-none position-fixed top-0 bottom-0 start-0 end-0 bg-dark bg-opacity-75 d-flex justify-content-center align-items-center" style="z-index: 2000;">
        <div class="spinner-border text-primary" style="width: 5rem; height: 5rem;" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    </div>
</body>

</html>