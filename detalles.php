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
            $tituloLibro = htmlspecialchars($libro['tituloLibro']);
            $extension = $libro['portada'];
            $src = "uploads/portada/{$idLibro}.{$extension}";
            $creador = $libro['creador'];
            $tituloLibro = htmlspecialchars($libro['tituloLibro']);
            $autor = htmlspecialchars($libro['autor']);
            $editorial = htmlspecialchars($libro['nombreEditorial']);
            $anio = htmlspecialchars($libro['anioEdicion']);
            $paginas = htmlspecialchars($libro['numeropaginas']);
            $isbn = htmlspecialchars($libro['isbn']);
            $categoria = htmlspecialchars($libro['nombreCategoria']);
            $idioma = htmlspecialchars($libro['nombreIdioma']);
            // $formato = htmlspecialchars($libro['nombre']);
            $sinopsis = htmlspecialchars($libro['sinopsis']);

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
                <p class="mt-4">
                    <i>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Optio animi est nam
                        veniam veritatis? Dolor mollitia voluptatum expedita quam, quisquam corrupti
                        quibusdam necessitatibus vel cum consequatur odio itaque maxime inventore!
                    </i>
                </p>
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
                            <td><?php echo $isbn; ?>< /td>
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
                    <div class="btn btn-secondary icon-link">
                        <i class="fa-solid fa-book" aria-hidden="true"></i>
                        Solicitar Libro Físico
                    </div>
                    <?php echo $botonCreador; ?>
                </div>
            </div>
        </div>
        <h4 class="pb-1 border-bottom border-primary">Libros Relacionados</h4>
    </div>

    <div class="container-md p-2">
        <form
            class="row g-2 justify-content-between">
            <div class='col-3 d-flex flex-column gap-2'>
                <div
                    class="h4 pb-2 mb-2 text-white border-bottom border-success">
                    Opciones de Descarga
                </div>
                <button class='btn btn-secondary btn-sm' type='button'>
                    <?php echo $formato; ?>
                </button>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="row g-2">
                        <div class="card-header">
                            Sinopsis 📖
                        </div>
                        <div class='card-body'>
                            <blockquote
                                class='blockquote mb-0'>
                                <p><?php echo $sinopsis; ?></p>
                            </blockquote>
                        </div>

                    </div>
                    <a href="editor.php" class="btn btn-primary" btn-sm tabindex="-1" role="button">Agregar otro formato </a>
                </div>
            </div>
        </form>
    </div>

    <?php echo generarFooter(); ?>
</body>

</html>