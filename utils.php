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
    <div class="container-fluid">
        <div class="row bg-secondary">
            <!-- Columnas Responsivas -->
            <!-- Van divididas en 12 partes, la sm(small) sólo va dividida en 4  -->
            <div class="col-6">
                <h4>"Unidos por el saber, desde cualquier rincón del planeta"</h4>
                <h5>Redes sociales</h5>
                <i class="fa-brands fa-facebook"></i>
                <a class="btn" href="https://www.facebook.com/" role="button">facebook</a>
                <h6>Creado por: Minerva Benítez Pérez 2025</h6>
            </div>
            <div class="col-6 d-flex flex-column">
                <a class="btn" href="inicio.php" role="button">Inicio</a>
                <a class="btn" href="ayuda.php" role="button">Ayuda</a>
                <a class="btn" href="mision.php" role="button">Mision</a>
            </div>
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
