<?php

require "utils.php";
require "config.php";


?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Facultades'); ?>
    <script src="js/regfacultades.js?v=1.10" defer></script>
</head>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>

                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <form id="formulario" class="form-inline mb-3">
                                <div class="mb-3">
                                    <label for="exampleInput" class="form-label">Nombre de la Facultad
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control "
                                        name="facultad"
                                        id="facultad"
                                        aria-describedby="emailHelp"
                                        style="max-width: 400px;" />
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInput" class="form-label">Direccion
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="direccion"
                                        id="direccion"
                                        aria-describedby="emailHelp"
                                        style="max-width: 400px;" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInput" class="form-label">codigoPostal
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="codigo"
                                        id="codigo"
                                        aria-describedby="emailHelp"
                                        style="max-width: 400px;" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInput" class="form-label">Telefono</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="telefono"
                                        id="telefono"
                                        aria-describedby="emailHelp"
                                        style="max-width: 400px;" />
                                </div>

                                <button type="submit" class="btn btn-primary">Dar de alta</button>
                            </form>


                        </div>
                    </div>
                </div>

                <!-- Footer -->
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