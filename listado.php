<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Ver Libros'); ?>
    <body>
        <!-- Barra Superior -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <!-- Icono y Nombre -->
                <a class="navbar-brand" href="#">
                    <img
                        src="logoproyecto.webp"
                        alt="Bootstrap"
                        width="30"
                        height="30"
                    />
                    UDC
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Opciones del Menú -->
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                aria-current="page"
                                href="inicio.php"
                                >Inicio</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="perfil.php">Perfil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="listado.php">Ver Libros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="categorias.php">Categorias</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="editor.php">Editor de Libros</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input
                            class="form-control me-2"
                            type="search"
                            placeholder="Buscar"
                            aria-label="Buscar"
                        />
                        <button class="btn btn-outline-success" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Fin Barra Superior -->
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Portada</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Editorial</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Formato</th>
                            <th scope="col">Idioma</th>
                            <th scope="col">Disponibilidad</th>
                            <th scope="col">Descargar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <img
                                    src="Informatica.jpg"
                                    alt="Bootstrap"
                                    width="30"
                                    height="30"
                                />
                            </th>
                            <td>Introduccion a la Informatica</td>
                            <td>Juan Diego Perez Villa</td>
                            <td>Anaya</td>
                            <td>Tecnologia e Ingenieria</td>
                            <td>PDF</td>
                            <td>Español</td>
                            <td>2</td>
                            <td>
                                <button
                                    class="btn btn-outline-success"
                                    type="submit"
                                >
                                    <i class="fa-solid fa-circle-down"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->

        <div class="container-fluid fixed-bottom">
            <div class="row bg-secondary">
                <!-- Columnas Responsivas -->
                <!-- Van divididas en 12 partes, la sm(small) sólo va dividida en 4  -->
                <div class="col-6">
                    <h4>
                        "Unidos por el saber, desde cualquier rincón del
                        planeta"
                    </h4>
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
    </body>
</html>
