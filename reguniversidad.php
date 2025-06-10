<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();

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

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Registro de Universidad'); ?>
    <script src="js/editoruniversidad.js?v=1.1" defer></script>
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
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Guardando Universidad...</span>
    </div>

    <div class="container-sm flex-grow-1 mt-lg-4">
        <div class="d-flex flex-column align-items-start mb-4 border-bottom border-primary">
            <img src="assets/images/logo.svg" alt="Bootstrap" width="200" />
            <h3 class="mt-3">Registra tu Universidad</h3>
        </div>


        <form id="form_uni" method="POST" enctype="multipart/form-data">
            <div class="row align-items-start gx-4">
                <!-- Columna izquierda: logo y formulario -->
                <div class="col-md-6 col-lg-4">

                    <div class="h4 pb-1 mb-4">
                        Datos Universidad
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Logotipo</label>
                        <input class="form-control" type="file" accept="image/*" <?php echo isset($idUsuario) ? '' : 'required'; ?> name="logo" id="logo" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">País</label>
                        <select class="form-select" name="pais" id="pais" required>
                            <?php echo generarPais($pais ?? 0); ?>
                        </select>
                    </div>
                </div>
                <div class="col-0 col-lg-1"></div>
                <!-- Columna derecha-->


                <div class="col-md-6 col-lg-7">
                    <div class="d-flex justify-content-between">
                        <div class="h4 pb-1 mb-3">Facultades</div>
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#dialogo-facultades">
                                Agregar
                            </button>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Código Postal</th>
                                <th>Teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tablaFacultades">
                            <!-- Las facultades registradas aparecerán aquí -->
                        </tbody>
                    </table>
                    <!-- Sin facultades -->
                    <div id="no-facultades" class="d-flex text-center">
                        No hay facultades Registradas
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>

        </form>
    </div>

    <!-- modal-->
    <div class="modal fade" id="dialogo-facultades" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" id="form_facu">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Facultad</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la Facultad</label>
                        <input type="text" class="form-control" name="nombreFacultad" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" class="form-control" name="codigoPostal" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Diálogo éxito -->
    <div class="modal fade" id="dialogo-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Éxito</h1>
                </div>
                <div class="modal-body">Libro cargado al sistema exitosamente</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="boton-cerrar-exito">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Diálogo error -->
    <div class="modal fade" id="dialogo-error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Error</h1>
                </div>
                <div class="modal-body" id="mensajeError">Ha ocurrido un error al cargar el libro: [error]</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>