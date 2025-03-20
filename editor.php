<?php
session_start();
require "utils.php";
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<?php echo generarEncabezado('Editor de Libros'); ?>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
                    <div class="container-fluid">
                        <!-- Icono y Nombre -->
                        <a class="navbar-brand" href="#">
                            <img src="logoproyecto.webp" alt="Bootstrap" width="30" height="30" />
                            UDC
                        </a>
                        <button
                            class="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Opciones del Menú -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="inicio.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Perfil</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Ver Libros</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Categorias</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Editor de Libros</a>
                                </li>
                            </ul>
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" />
                                <button class="btn btn-outline-success" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>

                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <form class="row g-4">
                                <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Portada</label>
                                        <input class="form-control" type="file" id="formFile" accept="image/*" required name="portada" id="portada"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Titulo</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" minlength="5" maxlength="64" required name="titulo" id="titulo"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Autor</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="10" name="autor" id="autor"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">ISBN</label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="32" name="isbn" id="isbn"/>
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label"> Editorial </label>
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="10" name="editorial" id="editorial"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Numero de Páginas </label>
                                        <input type="number" min="10" max="10000" class="form-control" id="inputnumber" name="numpaginas" id="numpaginas"/>
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
                                        <input type="text" class="form-control" id="exampleFormControlTextarea1" rows="1" maxlength="64" minlength="5" name="pais" id="pais"/>
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
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"name="sinopsis" id="sinopsis" ></textarea>
                                        
                                    </div>

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Cargar Libro</label>
                                        <input class="form-control" type="file" id="formFile" accept=".epub,.pdf,.azw,.azw3" name="cargarlibro" id="cargarlibro"/>
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="container-fluid">
                    <div class="row bg-secondary">
                        <!-- Columnas Responsivas -->
                        <!-- Van divididas en 12 partes, la sm(small) sólo va dividida en 4  -->
                        <div class="col-6">
                            <h4>"Unidos por el saber, desde cualquier rincón del planeta"</h4>
                            <h5>Redes sociales</h5>
                            <i class="fa-brands fa-facebook"></i>
                            <a class="btn" href="#" role="button">facebook</a>
                            <h6>Creado por: Minerva Benítez Pérez 2025</h6>
                        </div>
                        <div class="col-6 d-flex flex-column">
                            <a class="btn" href="inicio.php" role="button">Inicio</a>
                            <a class="btn" href="ayuda.php" role="button">Ayuda</a>
                            <a class="btn" href="mision.php" role="button">Mision</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>