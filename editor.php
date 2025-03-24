<?php
session_start();
require "utils.php";
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Editor de Libros'); ?>
    <script src="js/editor.js"></script>
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
                            <form class="row g-4">
                                <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Portada</label>
                                        <input class="form-control" type="file" id="formFile" accept="image/*" required name="portada" id="portada" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" minlength="5" maxlength="64" required name="titulo" id="titulo" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Autor</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="10" name="autor" id="autor" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="32" name="isbn" id="isbn" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"> Editorial </label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="10" name="editorial" id="editorial" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Numero de Páginas </label>
                                        <input type="number" min="10" max="10000" class="form-control" id="inputnumber" name="numpaginas" id="numpaginas" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoria" class="form-label">Categoría</label>
                                        <select class="form-select" aria-label="Large select example" name="categoria" id="categoria">
                                            <option selected disabled>Selecciona</option>
                                            <option value="1">Ciencias Sociales y Humanidades</option>
                                            <option value="2">Ciencias Politicas y Derecho </option>
                                            <option value="3">Ciencias Naturales y Matematicas</option>
                                            <option value="3">Tecnología e Ingeniería</option>
                                            <option value="3">Ciencias de la Salud y Medicina</option>
                                            <option value="3">Artes y Bellas Artes</option>
                                            <option value="3">Negocios y Economía</option>
                                            <option value="3">Ciencias Sociales Aplicadas</option>
                                            <option value="3">Ciencias de la Educación</option>
                                            <option value="3">Investigación y Métodos Científicos</option>
                                            <option value="3">infantiles</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formato" class="form-label">Formato</label>
                                        <select class="form-select" aria-label="Large select example" id="formato" name="formato">
                                            <option selected disabled>Seleccionar</option>
                                            <option value="1">Libro Físico</option>
                                            <option value="2">EPUB</option>
                                            <option value="3">MOBI</option>
                                            <option value="3">AZW</option>
                                            <option value="3">PDFa</option>
                                            <option value="3">CBZ</option>
                                            <option value="3">CBR</option>
                                            <option value="3">HTML</option>
                                            <option value="3">TXT</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" required>
                                        <label for="year" class="form-label">Año de Edición</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            id="year"
                                            min="1800"
                                            max="2099"
                                            placeholder="Ejemplo: 2024"
                                            name="anoedicion" id="anoedicion" />
                                    </div>
                                </div>

                                <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Pais</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="5" name="pais" id="pais" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Idioma</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="16" minlength="5" name="idioma" id="idioma" />
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Disponibilidad </label>
                                        <input type="number" min="0" max="1000" class="form-control" id="inputEmail4" />
                                    </div> -->

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Sinopsis </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="sinopsis" id="sinopsis"></textarea>

                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Cargar Libro</label>
                                        <input class="form-control" type="file" id="formFile" accept=".epub,.pdf,.azw,.azw3" name="cargarlibro" id="cargarlibro" />
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
                <div class="modal-body">Ha ocurrido un error al cargar el libro: [error]</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>