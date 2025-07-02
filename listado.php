<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();

function verLibros()
{
    global $connection;

    $parametros = [];
    $filtros = [];

    if (!empty($_GET['q'])) {
        $busqueda = '%' . strtolower(trim($_GET['q'])) . '%';
        $filtros[] = "(LOWER(libro.tituloLibro) LIKE :busqueda1 OR 
                       LOWER(autor.nombre) LIKE :busqueda2 OR 
                       LOWER(editorial.nombreEditorial) LIKE :busqueda3 OR 
                       LOWER(categoria.nombreCategoria) LIKE :busqueda4 OR 
                       LOWER(formato.nombre) LIKE :busqueda5 OR 
                       LOWER(idioma.nombreIdioma) LIKE :busqueda6)";
        $parametros[':busqueda1'] = $busqueda;
        $parametros[':busqueda2'] = $busqueda;
        $parametros[':busqueda3'] = $busqueda;
        $parametros[':busqueda4'] = $busqueda;
        $parametros[':busqueda5'] = $busqueda;
        $parametros[':busqueda6'] = $busqueda;
    }

    if (!empty($_GET['categoria']) && is_numeric($_GET['categoria'])) {
        $filtros[] = "categoria.idCategoria = :categoria";
        $parametros[':categoria'] = $_GET['categoria'];
    }

    $where = '';
    if (!empty($filtros)) {
        $where = 'WHERE ' . implode(' AND ', $filtros);
    }

    $sql = "SELECT
        libro.tituloLibro,
        libro.idLibro,
        libro.portada,
        idioma.nombreIdioma,
        GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor,
        categoria.nombreCategoria,
        formato.nombre,
        editorial.nombreEditorial,
        subidas.Usuario_idUsuario AS creador
    FROM libro
    LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
    LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
    LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
    LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
    LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
    LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
    LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
    LEFT JOIN subidas ON libro.idLibro = subidas.Libro_idLibro

    $where
    GROUP BY libro.idLibro
    ORDER BY libro.visitas DESC";

    $query = $connection->prepare($sql);

    // IMPORTANTE: Execute con o sin parámetros según corresponda
    $query->execute($parametros);

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = "";

    if (!$respuesta) {
        $html = "<tr><td colspan='7' class='text-center'>No se encontraron libros.</td></tr>";
    } else {

        foreach ($respuesta as $libro) {
            $tituloLibro = htmlspecialchars($libro['tituloLibro']);
            $idLibro = $libro['idLibro'];
            $extension = htmlspecialchars($libro['portada']);
            $autor = htmlspecialchars($libro['autor']);
            $editorial = htmlspecialchars($libro['nombreEditorial']);
            $categoria = htmlspecialchars($libro['nombreCategoria']);
            $formato = htmlspecialchars($libro['nombre']);
            $idioma = htmlspecialchars($libro['nombreIdioma']);
            $creador = ($libro['creador']);



            $html .= "<tr style='transform: rotate(0);'>
                        <th scope='row'>
                            <img src='uploads/portada/$idLibro.$extension' class='img-fluid img-thumbnail' alt='...' style='height: 5rem;'/>
                        </th>
                        <td><a href='detalles.php?id=$idLibro' class='stretched-link'>$tituloLibro</a></td>
                        <td>$autor</td>
                        <td>$editorial</td>
                        <td>$categoria</td>
                        <td>$formato</td>
                        <td>$idioma</td>
                        <td>
                            <button class='btn btn-outline-success' type='submit'>
                                <i class='fa-solid fa-circle-down'></i>
                            </button>
                        </td>";


            $esCreador = $creador == ($_SESSION['idUsuario']);
            $esAdmin = $_SESSION['nivel'] == 2;

            if ($esCreador || $esAdmin) {
                $html .= " <td>
                        <button class='btn btn-outline-danger' type= 'submit'>
                        <i class ='fa-solid fa-trash'></i>
                        </button>

                        </td>";
            }


            $html .= "</tr>";
        }

        return $html;
    }
}



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

                            <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                Lista de libros
                            </div>
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
                                            <th scope="col">Descargar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo verLibros(); ?>

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