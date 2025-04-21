<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();

// Consulta para obtener los libros
function mostrarLibros()
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
            LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
            LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
            LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
            GROUP BY libro.idLibro
            ORDER BY libro.visitas DESC
            LIMIT 6";

    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = "";

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

function mostLibrosRecomendados()
{
    global $connection;

    $facultad = $_SESSION['facultad'];

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
       WHERE facultades.idFacultades = $facultad
       GROUP BY libro.idLibro
       ORDER BY libro.visitas DESC
       LIMIT 6;";

    $query = $connection->prepare($instruccion);
    $query->execute();
    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = "";
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
    <?php echo generarEncabezado('Inicio'); ?>
</head>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <?php echo generarBarraNav(); ?>

                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <!-- Fila -->
                            <!-- Margen tiene 4 tipos y 7 posiciones: -->
                            <!-- mt-4: margen superior de 4 -->
                            <!-- mb-4: margen inferior de 4 -->
                            <!-- ml-4: margen izquierdo de 4 -->
                            <!-- mr-4: margen derecho de 4 -->
                            <!-- mx-4: margen der-izq de 4 (sobre eje X) -->
                            <!-- my-4: margen arriba-abajo de 4 (sobre eje Y) -->
                            <!-- m-4: margen total de 4 -->


                            <div class="row mb-4">
                                <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                    Libros mas visitados
                                </div>
                                <!-- Columnas -->
                                <!-- Van divididas en 12 partes  -->

                                <?php echo mostrarLibros(); ?>


                            </div>

                            <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                Recomendaciones
                            </div>

                            <!-- Fila -->
                            <div class="row mb-4">
                                <!-- Columnas -->

                                <!-- Columnas -->
                                <!-- Van divididas en 12 partes  -->
                                <?php echo mostLibrosRecomendados(); ?>
                            </div>

                            <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                Libros Físicos
                            </div>

                            <!-- Fila -->

                            <div class="row mb-4">
                                <!-- Columnas -->
                                <!-- Van divididas en 12 partes  -->
                                <div class="col-6 col-md-3 col-lg-2">
                                    <h5>Libro1</h5>
                                    <source srcset="Informatica.jgp" type="image/svg+xml" />
                                    <img
                                        src="Informatica.jpg"
                                        class="img-fluid img-thumbnail"
                                        alt="..." />
                                </div>
                                <div class="col-6 col-md-3 col-lg-2">
                                    <h5>Libro2</h5>
                                    <source srcset="medicina.jgp" type="image/svg+xml" />
                                    <img
                                        src="medicina.jpg"
                                        class="img-fluid img-thumbnail"
                                        alt="..." />
                                </div>
                                <div class="col-6 col-md-3 col-lg-2">
                                    <h5>Libro3</h5>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2">
                                    <h5>Libro4</h5>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2">
                                    <h5>Libro5</h5>
                                </div>
                                <div class="col-6 col-md-3 col-lg-2 bg-secondary">
                                    <h5>Libro6</h5>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                        </div>
                    </div>
                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>
</body>

</html>