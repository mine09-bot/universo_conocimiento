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
        <title>Editor de Libros - UDC 📙</title>
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

            <form class="row g-4">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Portada</label>
                        <input class="form-control" type="file" id="formFile" />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Titulo</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Autor</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >ISBN</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                        >
                            Editorial
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Numero de Paginas
                        </label>
                        <input
                            type="number"
                            min="10"
                            max="10000"
                            class="form-control"
                            id="inputEmail4"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Categoria</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Formato
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label"
                            >Año de Edición</label
                        >
                        <input
                            type="number"
                            class="form-control"
                            id="year"
                            min="1800"
                            max="2099"
                            placeholder="Ejemplo: 2024"
                        />
                    </div>
                </div>

                <div class="col-12 col-md-6 d-flex flex-column gap-2">
                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Pais</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Idioma</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        />
                    </div>
                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Disponibilidad
                        </label>
                        <input
                            type="number"
                            min="0"
                            max="1000"
                            class="form-control"
                            id="inputEmail4"
                        />
                    </div>

                    <div class="mb-3">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label"
                            >Sinopsis
                        </label>
                        <textarea
                            class="form-control"
                            id="exampleFormControlTextarea1"
                            rows="1"
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label"
                            >Cargar Libro</label
                        >
                        <input class="form-control" type="file" id="formFile" />
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-secondary" type="button">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
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
