<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Ver Libros'); ?>
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
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
                                    height="30"
                                />
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
                                    type="submit"
                                >
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

        <?php echo generarFooter(); ?>
    </body>
</html>
