<?php
function verificarSesion()
{
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: login.php');
        exit;
    }
}

function generarEncabezado($titulo)
{
    return <<<HTML
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>$titulo - 📖 Bookia</title>
        <link rel="stylesheet" href="assets/css/tema.css" />
        <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/4ff96bfcc8.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>
        <link rel="icon" type="image/png" href="assets/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="assets/favicon.svg" />
        <link rel="shortcut icon" href="assets/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png" />
        <link rel="manifest" href="assets/site.webmanifest" />
    HTML;
}

function generarFooter()
{
    return <<<HTML
    <div class="container-fluid position-relative bg-secondary mt-4" style="overflow: hidden">
        <div class="position-absolute h-100 w-100 z-1" style="overflow: hidden; left: 50%">
            <img
                class="img-fluid w-100"
                src="assets/images/icono_barra.svg"
                alt="Bookia Logo"
                style="
                    filter: invert(1) brightness(1000%);
                    clip-path: inset(0 0 0 0);
                    mask-image: linear-gradient(to left, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));
                    -webkit-mask-image: linear-gradient(rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0) 50%);
                " />
        </div>
        <div class="container-sm py-4 z-2 position-relative">
            <div class="row py-5">
                <div class="col-md-6 col-lg-4 d-flex flex-column align-items-start">
                    <h4>Enlaces de Interés</h4>
                    <a class="btn btn-secondary" href="listado.php" role="button">Listado de Libros</a>
                    <a class="btn btn-secondary" href="categorias.php" role="button">Categorías</a>
                    <!-- <a class="btn btn-secondary" href="mision.php" role="button">Misión</a> -->
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
                        <a class="btn" href="https://facebook.com" role="button"><i class="fa-brands fa-facebook"></i></a>
                    </p>
                </div>
            </div>
            <hr />
            <span>© 2025 Minerva Benítez Pérez. Todos los derechos reservados.</span>
        </div>
    </div>
    HTML;
}
function generarBarraNav()
{
    return <<<HTML
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-lg">
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
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Opciones del Menú -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="listado.php">Listado</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="categorias.php">Categorias</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="editor.php">Agregar Libro</a>
                        </li>
                    </ul>
                    <form class="d-flex me-md-3" role="search" action="listado.php">
                        <div class="input-group">
                            <input
                                name="q"
                                class="form-control"
                                type="search"
                                placeholder="Buscar Título o Autor"
                                aria-label="Buscar" />
                            <button class="btn btn-outline-success" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                title="Usuario"
                                aria-expanded="false">
                                <i class="fa-solid fa-user d-none d-lg-inline"></i>
                                <span class="d-lg-none">Usuario</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    HTML;
}

function aMinusculas($texto)
{
    $texto = trim($texto);

    $texto = strtolower($texto);

    return $texto;
}

function primeraMayus($texto)
{
    $texto = aMinusculas($texto);
    $texto = ucwords($texto);
    return $texto;
}

function agregarVisita(int $idLibro): bool
{
    global $connection;

    try {

        $consulta = $connection->prepare("UPDATE libro SET visitas = visitas + 1 WHERE idLibro = :id");
        $consulta->bindParam(':id', $idLibro, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function agregarConsulta(int $idUsuario): bool
{
    global $connection;

    try {

        $consulta = $connection->prepare("UPDATE usuario SET visitas = visitas + 1 WHERE idUsuario = :id");
        $consulta->bindParam(':id', $idUsuario, PDO::PARAM_INT);
        $consulta->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function puedeEliminarLibro(int $idLibro): bool
{
    global $connection;

    // Obtener creador del libro
    $instruccion = "SELECT Usuario_idUsuario AS creador FROM subidas WHERE libro_idLibro = :id";
    $query = $connection->prepare($instruccion);
    $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();
    $libro = $query->fetch(PDO::FETCH_ASSOC);
    $creador = $libro['creador'];

    // Que no tenga mas cargadores
    $instruccion = "SELECT DISTINCT idCargador FROM formatolibro WHERE idLibro = :id AND idCargador != :crea";
    $query = $connection->prepare($instruccion);
    $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->bindParam(':crea', $creador, PDO::PARAM_INT);
    $query->execute();
    $cargadores = $query->fetchAll(PDO::FETCH_ASSOC);
    if (sizeof($cargadores) > 0) return false;

    // Que no tenga libros fisicos
    $instruccion = "SELECT SUM(ejemplares) AS ejemplares FROM `librofisico` WHERE idLibro = :id";
    $query = $connection->prepare($instruccion);
    $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();
    $fisicos = $query->fetch(PDO::FETCH_ASSOC);
    $ejemplares = $fisicos['ejemplares'];
    if ($ejemplares && (int)$ejemplares > 0) return false;

    return true;
}

$alert = '';
if (isset($_GET) && isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $alert = "<script>alert('$msg')</script>";
}
