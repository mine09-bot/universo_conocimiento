<?php
function verificarSesion() {
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: login.php');
        exit;
    }
}

function generarEncabezado($titulo) {
    return <<<HTML
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>$titulo - 📖 Bookia</title>
        <link rel="stylesheet" href="assets/css/tema.css" />
        <script src="assets/bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/4ff96bfcc8.js" crossorigin="anonymous"></script>
    HTML;
}

function generarFooter() {
    return <<<HTML
    <div class="container-fluid position-relative bg-secondary" style="overflow: hidden">
        <div class="position-absolute h-100 w-100 z-1" style="overflow: hidden; left: 50%">
            <img
                class="img-fluid w-100"
                src="/assets/images/icono_barra.svg"
                alt="Bookia Logo"
                style="
                    filter: invert(1) brightness(1000%);
                    clip-path: inset(0 0 0 0);
                    mask-image: linear-gradient(to left, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0));
                    -webkit-mask-image: linear-gradient(rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0) 50%);
                " />
        </div>
        <div class="container-sm py-4 z-2 position-relative">
            <div class="row py-5">
                <div class="col-md-6 col-lg-4 d-flex flex-column align-items-start">
                    <h4>Enlaces de Interés</h4>
                    <a class="btn btn-secondary" href="inicio.php" role="button">Listado de Libros</a>
                    <a class="btn btn-secondary" href="ayuda.php" role="button">Categorías</a>
                    <a class="btn btn-secondary" href="mision.php" role="button">Misión</a>
                </div>
                <div class="col-md-6 col-lg-4 d-flex flex-column align-items-start">
                    <h4>Conócenos</h4>
                    <a class="btn btn-secondary" href="ayuda.php" role="button">Ayuda</a>
                    <a class="btn btn-secondary" href="mision.php" role="button">Misión</a>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-12 col-md-5 col-lg-3">
                    <img src="assets/images/logo.svg" alt="Logo Bookia" class="img-fluid" />
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-12 d-flex flex-row justify-content-end align-items-center">
                    <p class="mb-0">
                        <small>Síguenos</small>
                        <a class="btn" href="#" role="button"><i class="fa-brands fa-facebook"></i></a>
                    </p>
                </div>
            </div>
            <hr />
            <span>© 2025 Minerva Benítez Pérez. Todos los derechos reservados.</span>
        </div>
    </div>
    HTML;
}
function generarBarraNav() {
    return <<<HTML
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-fluid">
                <!-- Icono y Nombre -->
                <a class="navbar-brand text-brand" href="inicio.php">
                    <img
                        src="assets/images/icono_barra.svg"
                        alt="Logo"
                        width="24"
                        height="24"
                        class="d-inline-block align-text-top" />
                    BOOKIA
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
    HTML;
}

function aMinusculas($texto) {
    $texto = trim($texto);

    $texto = strtolower($texto);

    return $texto;
}

function primeraMayus($texto) {
    $texto = aMinusculas($texto);
    $texto = ucwords($texto);
    return $texto;
}
