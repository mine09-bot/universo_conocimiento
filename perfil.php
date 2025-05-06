<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Perfil'); ?>

</head>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>
                <!-- Contenido -->
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <div class="d-grid gap-1">
                                <div class="mb-4 border-bottom border-primary d-flex justify-content-between">
                                    <span class="h4 m-0">Información personal</span>
                                    <a class="btn btn-dark icon-link" href="#">
                                        Editar
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                <div class="container mt-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="col-auto mb-3">
                                            <img src="fotoperfil.jpg" alt="Foto de perfil" class="img-fluid rounded-circle shadow"
                                                style="width: 150px; height: 150px;
                                                                 object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h2 class="m-0">Minerva Benítez Pérez</h2>
                                            <h5 class="mb-1 card-subtitle text-body-secondary">Ciencias de la Computación</h5>
                                            <p class="card-subtitle m-0 text-body-secondary"><span class="fi fi-mx me-2 rounded-1"></span></span>México</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn" href="https://www.linkedin.com/" role="button">
                                                <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn" href="mailto:estradaoiram@gmail.com" role="button">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                            <a class="btn" href="https://facebook.com" role="button">
                                                <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="btn btn-dark icon-link mb-3" style="transform: rotate(0);">
                                            <img src="buap.webp" alt="Foto de perfil" class="img fluid rounded"
                                                style="width: 1.5rem; height: 1.5rem;">
                                            Benemérita Universidad Autónoma de Puebla
                                            <a class="stretched-link" href="#"></a>
                                        </div>
                                        <div class="mt-3 row gap-4">
                                            <div class="col-auto card p-3">
                                                <span class="fs-4">
                                                    <i class="fa-solid fa-upload text-primary"></i>
                                                    5</span>
                                                <span class="mb-2"><strong>Libros Subidos</strong></span>
                                            </div>
                                            <div class="col-auto card p-3">
                                                <span class="fs-4">
                                                    <i class="fa-solid fa-eye text-primary"></i>
                                                    20</span>
                                                <span class="mb-2"><strong>Libros Consultados</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- contenedor-->
                        </div>
                    </div>

                </div>
                <?php echo generarFooter(); ?>
            </div>
        </div>
</body>

</html>