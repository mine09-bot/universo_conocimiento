<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Libros Físicos'); ?>
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
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
            <div class="d-grid gap-4 mx-left">
                <div class="card" style="max-width: 540px">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <p class="card-text">
                                    <strong> Ubicacion: </strong>Universidad
                                </p>
                                <p class="card-text">
                                    <strong>Ejemplares disponibles:</strong> 2
                                </p>
                                <p class="card-text">
                                    <strong>Pais:</strong> Pais
                                </p>
                                <button class="btn btn-secondary btn-lg">
                                    Solicitar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
