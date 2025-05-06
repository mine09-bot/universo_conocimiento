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
         libro.anioEdicion,
         libro.sinopsis,
         subidas.Usuario_idUsuario as creador,
         libro.Pais_idPais,
         libro.numeropaginas,
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
            LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
            LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
            LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
            LEFT JOIN subidas ON libro.idLibro = subidas.Libro_idLibro
        WHERE libro.idLibro= :id
        GROUP BY libro.idLibro";

        $query = $connection->prepare($instruccion);
        $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
        $query->execute();
        $libro = $query->fetch(PDO::FETCH_ASSOC);
        if ($libro) {

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
            $formato = htmlspecialchars($libro['nombre']);
            $sinopsis = htmlspecialchars($libro['sinopsis']);

            $botonCreador = "";
            if ($creador == ($_SESSION['idUsuario'])) {
                $botonCreador = '<a href="editor.php?id=' . $idLibro . '" class="btn btn-primary" tabindex="-1" role="button">Editar Libro</a>';
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
        <div
            class="h4 pb-2 mb-4 text-white border-bottom border-success">
            Detalles del Libro
        </div>
        <div class="container-md p-3">
            <form class="row mb-0 g-1">
                <div class="col-3 d-grid gap-0">
                    <?php echo $botonCreador; ?>
                    <div class='container text-center mt-5'>
                        <img
                            src='<?php echo $src; ?>'
                            class='img-fluid img-thumbnail shadow-sm'
                            style='height: 350px; object-fit: cover; width: 100%; max-width: 300px;'
                            alt='Portada de <?php echo $tituloLibro; ?>'>
                    </div>

                </div>
                <div class='col-8'>
                    <div class='card shadow-sm border-0'>
                        <div class='card-body'>
                            <h3 class='card-title'><?php echo $tituloLibro; ?> 📖</h3>
                            <p class='card-text'><strong>Autor: </strong><?php echo $autor; ?></p>
                            <p class='card-text'><strong>Editorial: </strong><?php echo $editorial; ?></p>
                            <p class='card-text'><strong>Año de Edición: </strong><?php echo $anio; ?></p>
                            <p class='card-text'><strong>Número de Páginas: </strong><?php echo $paginas; ?></p>
                        </div>
                    </div>
                </div>
        </div>
        </form>
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