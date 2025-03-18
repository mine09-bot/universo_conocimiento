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
        <title>Ayuda</title>
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
            <!--un acordeon-->
            <h5>Preguntas frecuentes</h5>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                        >
                            Porque necesito crear una Cuenta para poder
                            solicitar Libros Fisicos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseOne"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            Para garantizar una gestión segura y eficiente del
                            préstamo, es necesario crear una cuenta. Esto
                            permite identificar al solicitante, registrar los
                            libros prestados, enviar notificaciones y facilitar
                            el historial de solicitudes.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo"
                            aria-expanded="false"
                            aria-controls="flush-collapseTwo"
                        >
                            Con que formatos de libros Electronicos contamos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseTwo"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            EPUB (Formato estandar y mas utilizado para e-books)
                            <br />MOBI (Compatible con dispositivos Kindle)
                            <br />AZW (Formato exclusivo de Amazon para Kindle)
                            <br />PDF ( Compatible con casi cualquier
                            dispositivo PC, móviles, e-readers) <br />TXT
                            (Comopatible con todos los dispositivos) <br />CBZ
                            (Compatibilidad con lectores de cómics digitales
                            como CDisplayEx, ComicRack, YACReader y Perfect
                            Viewer) <br />CBR (Esencialmente unn archivo RAR
                            Compatible con lectores de cómics digitales como
                            CDisplayEx, ComicRack, YACReader y Perfect Viewer)
                            <br />HTML (Compatible con todos los navegadores )
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree"
                            aria-expanded="false"
                            aria-controls="flush-collapseThree"
                        >
                            Como puedo descargar los Libros Electrónicos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseThree"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            1. Seleccionar el libro de interes. <br />2.
                            Verificar la informacion del Libro <br />3.
                            Seleccionar el formato en el cual desea descargarlo
                            <br />4.Descargar
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-terminos"
                            aria-expanded="false"
                            aria-controls="flush-terminos"
                        >
                            Terminos y condiciones
                        </button>
                    </h2>
                    <div
                        id="flush-terminos"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            1. Registro: El usuario debe registrarse con datos
                            reales y es responsable de su cuenta.

                            <br />2. Uso de Recursos: Los libros digitales
                            pueden leerse o descargarse según disponibilidad.
                            Los libros físicos están sujetos a préstamo según
                            las normas.

                            <br />3. Propiedad Intelectual: No se permite
                            copiar, distribuir o modificar el contenido sin
                            autorización.

                            <br />4. Conducta del Usuario: Se prohíbe el uso
                            indebido de la plataforma y cualquier actividad
                            ilícita.

                            <br />5. Sanciones: El incumplimiento de estas
                            normas puede llevar a la suspensión de la cuenta.

                            <br />6. Modificaciones: Nos reservamos el derecho
                            de actualizar estos términos en cualquier momento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-contacto"
                            aria-expanded="false"
                            aria-controls="flush-contacto"
                        >
                            Contacto
                        </button>
                    </h2>
                    <div
                        id="flush-contacto"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            administrador@Universidad.com
                        </div>
                    </div>
                </div>
            </div>
            <!--termina acordeon-->
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
