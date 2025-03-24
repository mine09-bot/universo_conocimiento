<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<head>  
<?php echo generarEncabezado('Ver Libros'); ?>
</head>
<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>

                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
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
                                                    height="30" />
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
                                                    type="submit">
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
                    </div>
                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>