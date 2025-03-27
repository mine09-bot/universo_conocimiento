<?php
session_start();
require "utils.php";
require "config.php";

verificarSesion();

function generarCategorias() {
    global $connection;

    $instruccion= "SELECT * FROM categoria";

    $query=$connection->prepare($instruccion);

    $query->execute();
    
    $respuesta=$query->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option selected disabled value="">Selecciona</option>';

    foreach($respuesta as $cat){
        $html .= '<option value="' . $cat['idCategoria'] . '">' . $cat['nombreCategoria'] . '</option>';
    }

    return $html;
}
function generarFormato() {
    global $connection;

    $instruccion= "SELECT * FROM formato";

    $query=$connection->prepare($instruccion);

    $query->execute();
    
    $respuesta=$query->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option selected disabled value="">Selecciona</option>';

    foreach($respuesta as $cat){
        $html .= '<option value="' . $cat['idFormatos'] . '">' . $cat['nombre'] . '</option>';
    }

    return $html;
}
function generarPais() {
    global $connection;

    $instruccion= "SELECT * FROM pais";

    $query=$connection->prepare($instruccion);

    $query->execute();
    
    $respuesta=$query->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option selected disabled value="">Selecciona</option>';

    foreach($respuesta as $cat){
        $html .= '<option value="' . $cat['idPais'] . '">' . $cat['nombrePais'] . '</option>';
    }

    return $html;
}

function generarIdioma() {
    global $connection;

    $instruccion= "SELECT * FROM idioma";

    $query=$connection->prepare($instruccion);

    $query->execute();
    
    $respuesta=$query->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option selected disabled value="">Selecciona</option>';

    foreach($respuesta as $cat){
        $html .= '<option value="' . $cat['idIdioma'] . '">' . $cat['nombreIdioma'] . '</option>';
    }

    return $html;
}

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Editor de Libros'); ?>
    <script src="js/editor.js?v=1.8" defer></script>
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
        </div>

        <style>
            .flipping {
                height: 22.4px;
                display: grid;
                grid-template-columns: repeat(5, 22.4px);
                grid-gap: 5.6px;
            }

            .flipping div {
                animation: flipping-owie1ymd 1.25s calc(var(--delay) * 1s) infinite ease;
                background-color: var(--bs-primary);
            }

            .flipping div:nth-of-type(1) {
                --delay: 0.25;
            }

            .flipping div:nth-of-type(2) {
                --delay: 0.5;
            }

            .flipping div:nth-of-type(3) {
                --delay: 0.75;
            }

            .flipping div:nth-of-type(4) {
                --delay: 1;
            }

            .flipping div:nth-of-type(5) {
                --delay: 1.25;
            }

            @keyframes flipping-owie1ymd {
                0% {
                    transform: perspective(44.8px) rotateY(-180deg);
                }

                50% {
                    transform: perspective(44.8px) rotateY(0deg);
                }
            }
        </style>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Guardando libro...</span>
    </div>

    <!-- Contenido -->
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <form class="row g-4" id="formulario">
                                <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Portada</label>
                                        <input class="form-control" type="file" accept="image/*" required name="portada" id="portada" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" rows="1" minlength="5" maxlength="64" required name="titulo" id="titulo" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Autor</label>
                                        <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="autor" id="autor" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" rows="1" maxlength="32" name="isbn" id="isbn" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"> Editorial </label>
                                        <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="editorial" id="editorial" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Numero de Páginas </label>
                                        <input type="number" min="10" max="10000" class="form-control" required name="numpaginas" id="numpaginas" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">Categoría</label>
                                        <select class="form-select" aria-label="Large select example" required name="categoria" id="categoria">
                                            <?php echo generarCategorias(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formato" class="form-label">Formato</label>
                                        <select class="form-select" aria-label="Large select example" id="formato" required name="formato">
                                            
                                            <?php echo generarFormato(); ?>
                                        </select>
                                    </div>

                                    <div class="mb-3" required>
                                        <label for="year" class="form-label">Año de Edición</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            min="1800"
                                            max="2099"
                                            placeholder="Ejemplo: 2024" required
                                            name="anoedicion" id="anoedicion" />
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                <div class="mb-3">
                                        <label for="pais" class="form-label">Pais</label>
                                        <select class="form-select" aria-label="Large select example" id="pais" required name="pais">
                                            
                                            <?php echo generarPais(); ?>
                                        </select>
                                    </div>


                                    <div class="mb-3">
                                        <label for="idioma" class="form-label">Idioma</label>
                                        <select class="form-select" aria-label="Large select example" id="idioma" required name="idioma">
                                            
                                            <?php echo generarIdioma(); ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Sinopsis </label>
                                        <textarea class="form-control" rows="5" name="sinopsis" required id="sinopsis"></textarea>

                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Cargar Libro</label>
                                        <input class="form-control" type="file" accept=".epub,.pdf,.azw,.azw3" required name="cargarlibro" id="cargarlibro" />
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
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
    <div class="modal fade" id="dialogo-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Éxito</h1>
                </div>
                <div class="modal-body">Libro cargado al sistema exitosamente</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
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
                <div class="modal-body"  id="mensajeError">Ha ocurrido un error al cargar el libro: [error]</div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>