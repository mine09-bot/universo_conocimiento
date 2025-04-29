<?php

session_start();
require "utils.php";
require "config.php";
verificarSesion();

function generarCategorias()
{
    global $connection;

    $instruccion = "SELECT * FROM categoria";

    $query = $connection->prepare($instruccion);

    $query->execute();

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = "";
    foreach ($respuesta as $cat) {
        $categoria = htmlspecialchars($cat['nombreCategoria']);
        $idCategoria = $cat['idCategoria'];

        $html .= "<a href='listado.php?categoria=$idCategoria' class='btn btn-secondary m-2'>
                    $categoria
                  </a>";
    }

    return $html;
}

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Categorias'); ?>
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
                            <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                Categorias
                            </div>
                            <h5>Selecione una opción</h5>

                            <div class="d-flex flex-wrap gap-2 col-12 mb-5">
                                <?php echo generarCategorias(); ?>
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