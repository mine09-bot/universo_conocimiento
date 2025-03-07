<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Categorias de Libros 📙</title>
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
        <div class="container-md mt-6">
            <!-- Empieza aqui -->

            <h5>Selecione una opción</h5>

            <div class="d-grid gap-2 col-4 margin-left">
                <button class="btn btn-secondary" type="button">
                    Ciencias Sociales y Humnaidades
                </button>
                <button class="btn btn-secondary" type="button">
                    Ciencias Políticas y Derecho
                </button>
                <button class="btn btn-secondary" type="button">
                    Ciencias Naturales y Matematicas
                </button>
                <button class="btn btn-secondary" type="button">
                    Tecnología e Ingenieria
                </button>
                <button class="btn btn-secondary" type="button">
                    Ciencias de la Salud y Medicina
                </button>
                <button class="btn btn-secondary" type="button">
                    Artes y Bellas Artes
                </button>
                <button class="btn btn-secondary" type="button">
                    Negocios y Economía
                </button>
                <button class="btn btn-secondary" type="button">
                    Ciencias Sociales Aplicadas
                </button>
                <button class="btn btn-secondary" type="button">
                    Ciencias de la Educación
                </button>
                <button class="btn btn-secondary" type="button">
                    Investigación y metodos Científicos
                </button>
                <button class="btn btn-secondary" type="button">
                    Infantiles
                </button>
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
                    <a class="btn" href="#" role="button">Inicio</a>
                    <button type="button" class="btn">Ayuda</button>
                    <button type="button" class="btn">Misión</button>
                </div>
            </div>
        </div>
    </body>
</html>
