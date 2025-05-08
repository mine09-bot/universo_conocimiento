<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();
global $connection;

if (isset($_GET['id'])) {
    $idLibro = $_GET['id'];

    if (is_numeric($idLibro)) {

        agregarVisita($idLibro);
        agregarConsulta($_SESSION['idUsuario']);

        $instruccion = "SELECT
         libro.tituloLibro,
         libro.idLibro,
         libro.portada,
         libro.isbn,
         libro.anioEdicion,
         libro.sinopsis,
         subidas.Usuario_idUsuario as creador,
         libro.Pais_idPais,
         libro.numeropaginas,
         idioma.nombreIdioma,
         GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor,
         categoria.idCategoria,
         categoria.nombreCategoria,
         editorial.nombreEditorial
        FROM libro
            LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
            LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
            LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
            LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
            LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
            LEFT JOIN subidas ON libro.idLibro = subidas.Libro_idLibro
        WHERE libro.idLibro= :id
        GROUP BY libro.idLibro";

        $query = $connection->prepare($instruccion);
        $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
        $query->execute();
        $libro = $query->fetch(PDO::FETCH_ASSOC);
        if ($libro) {
            // Obtener Formatos

            // Variables
            $idLibro = $libro['idLibro'];
            $tituloLibro = $libro['tituloLibro'];
            $extension = $libro['portada'];
            $src = "uploads/portada/{$idLibro}.{$extension}";
            $creador = $libro['creador'];
            $tituloLibro = $libro['tituloLibro'];
            $autor = $libro['autor'];
            $editorial = $libro['nombreEditorial'];
            $anio = $libro['anioEdicion'];
            $paginas = $libro['numeropaginas'];
            $isbn = $libro['isbn'];
            $idCategoria = $libro['idCategoria'];
            $categoria = $libro['nombreCategoria'];
            $idioma = $libro['nombreIdioma'];
            // $formato = $libro['nombre'];
            $sinopsis = $libro['sinopsis'];

            $botonCreador = "";
            if ($creador == ($_SESSION['idUsuario'])) {
                $botonCreador = '<a href="editor.php?id=' . $idLibro . '" class="btn btn-outline-light icon-link">
                        <i class="fa-solid fa-pencil" aria-hidden="true"></i>
                        Editar
                    </a>';
            }
        } else {
            // Regresar al usuario al listado
            header('Location: listado.php');
        }
    } else {
        // Regresar al usuario al listado
        header('Location: listado.php');
    }
}

function mostLibrosRelacionados(string $categoria, int $idLibro): string
{
    global $connection;

    $instruccion = "SELECT
                        libro.tituloLibro,
                        libro.idLibro,
                        libro.portada,
                        idioma.nombreIdioma,
                        GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor,
                        categoria.nombreCategoria,
                        formato.nombre,
                        editorial.nombreEditorial
                    FROM libro
                        LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
                        LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
                        LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
                        LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
                        LEFT JOIN facultadcategoria ON categoria.idCategoria= facultadcategoria.idCategoria
                        LEFT JOIN facultades ON facultadcategoria.idFacultad =facultades.idFacultades
                        LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
                        LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
                        LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
                        WHERE libro.Categoria_idCategoria = $categoria AND libro.idLibro != $idLibro
                        GROUP BY libro.idLibro
                        ORDER BY libro.visitas DESC
                        LIMIT 6;";

    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = "";

    if (count($respuesta) < 6) {
        $restantes = 6 - count($respuesta);

        $instruccion = "SELECT
                            libro.tituloLibro,
                            libro.idLibro,
                            libro.portada,
                            idioma.nombreIdioma,
                            GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor,
                            categoria.nombreCategoria,
                            formato.nombre,
                            editorial.nombreEditorial
                        FROM libro
                            LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
                            LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
                            LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
                            LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
                            LEFT JOIN facultadcategoria ON categoria.idCategoria= facultadcategoria.idCategoria
                            LEFT JOIN facultades ON facultadcategoria.idFacultad =facultades.idFacultades
                            LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
                            LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
                            LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
                            WHERE libro.Categoria_idCategoria != $categoria AND libro.idLibro != $idLibro
                            GROUP BY libro.idLibro
                            ORDER BY libro.visitas DESC
                            LIMIT $restantes;";

        $query = $connection->prepare($instruccion);
        $query->execute();
        $respuestaRestantes = $query->fetchAll(PDO::FETCH_ASSOC);

        $respuesta = array_merge($respuesta, $respuestaRestantes);
    }
    foreach ($respuesta as $libro) {
        $tituloLibro = $libro['tituloLibro'];
        $idLibro = $libro['idLibro'];
        $extension = $libro['portada'];

        $html .= "<div class='col-6 col-md-3 col-lg-2'>
                    <a href='detalles.php?id=$idLibro'>
                    <img
                        src='uploads/portada/$idLibro.$extension'
                        class='img-fluid img-thumbnail'
                        alt='Portada de $tituloLibro' />
                    </a>
                </div>";
    }
    return $html;
}

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Detalles'); ?>
</head>

<body>
    <!-- Barra Superior -->
    <?php echo generarBarraNav(); ?>
    <!-- Contenido -->
    <div class="container-md mt-2">
        <!-- Empieza aqui -->
        <div class="row pb-2 my-5 g-1">
            <div class="col-12 col-md-3 px-5 px-md-0">
                <img src="<?php echo $src; ?>" class="img-fluid shadow-sm rounded-3" alt='Portada de <?php echo $tituloLibro; ?>' />
            </div>
            <div class="col-0 col-md-1"></div>
            <div class="col-12 col-md-8">
                <h2 class="text-brand"><?php echo $tituloLibro; ?></h2>
                <h5><?php echo $autor; ?></h5>
                <p>
                    133 Descargas
                    <span class="badge text-bg-info">
                        <i class="fa-solid fa-arrow-trend-up" aria-hidden="true"></i>
                        En Tendencia
                    </span>
                    <span class="badge text-bg-primary">
                        <i class="fa-solid fa-download" aria-hidden="true"></i>
                        Más Descargado
                    </span>
                    <span class="badge text-bg-warning">
                        <i class="fa-solid fa-star" aria-hidden="true"></i>
                        TOP
                    </span>
                </p>
                <p class="mt-4"><i><?php echo $sinopsis; ?></i></p>
                <table class="table mb-4">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 10em" class="text-brand">Editorial</th>
                            <td><?php echo $editorial; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">Año</th>
                            <td><?php echo $anio; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">Páginas</th>
                            <td><?php echo $paginas; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">ISBN</th>
                            <td><?php echo $isbn; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">Idioma</th>
                            <td><?php echo $idioma; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">Categoría</th>
                            <td><?php echo $categoria; ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-brand">Ediciones</th>
                            <td>
                                <span class="badge text-bg-secondary">EPUB</span>
                                <span class="badge text-bg-secondary">PDF</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex gap-2 flex-wrap">
                    <div class="btn-group">
                        <button
                            type="button"
                            class="btn btn-primary dropdown-toggle icon-link"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-download" aria-hidden="true"></i>
                            Descargar
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">EPUB</a></li>
                            <li><a class="dropdown-item" href="#">PDF</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#">Otra acción</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-secondary icon-link">
                        <i class="fa-solid fa-book" aria-hidden="true"></i>
                        Solicitar Libro Físico
                    </a>
                    <?php echo $botonCreador; ?>
                </div>
            </div>
        </div>
        <h4 class="pb-1 border-bottom border-primary">Libros Relacionados</h4>
        <div class="row mb-4">
            <?php echo mostLibrosRelacionados($idCategoria, $idLibro); ?>
        </div>
    </div>

    <?php echo generarFooter(); ?>
</body>

</html>