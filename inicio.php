<?php
session_start();
require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Inicio\</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://kit.fontawesome.com/4ff96bfcc8.js"
            crossorigin="anonymous"
        ></script>
    </head>
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
                                href="#"
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
                            <a class="nav-link" href="editor.php">Agregar Libros</a>
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
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Fin Barra Superior -->
        <!-- Contenido -->
        <div class="container-md mt-4">
            <!-- Fila -->
            <!-- Margen tiene 4 tipos y 7 posiciones: -->
            <!-- mt-4: margen superior de 4 -->
            <!-- mb-4: margen inferior de 4 -->
            <!-- ml-4: margen izquierdo de 4 -->
            <!-- mr-4: margen derecho de 4 -->
            <!-- mx-4: margen der-izq de 4 (sobre eje X) -->
            <!-- my-4: margen arriba-abajo de 4 (sobre eje Y) -->
            <!-- m-4: margen total de 4 -->
            <h3>Libros mas visitados</h3>

            <div class="row mb-4">
                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>

            <h3>Recomendaciones</h3>

            <!-- Fila -->
            <div class="row mb-4">
                <!-- Columnas -->

                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>

            <h3>Libros Físicos</h3>

            <!-- Fila -->

            <div class="row mb-4">
                <!-- Columnas -->
                <!-- Van divididas en 12 partes  -->
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro1</h5>
                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                    <img
                        src="Informatica.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro2</h5>
                    <source srcset="medicina.jgp" type="image/svg+xml" />
                    <img
                        src="medicina.jpg"
                        class="img-fluid img-thumbnail"
                        alt="..."
                    />
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro3</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro4</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h5>Libro5</h5>
                </div>
                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                    <h5>Libro6</h5>
                </div>
            </div>
            <br />
            <br />
            <br />
            <br />
        </div>

        <!-- Footer -->
        <div class="container-fluid">
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
