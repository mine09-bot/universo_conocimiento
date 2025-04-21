<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();

function mostrarPortadas($idLibro)
{
    global $connection;

    if (!isset($idLibro) || !is_numeric($idLibro)) {
        return "<p>ID no válido.</p>";
    }

    // Traer solo ese libro desde la base de datos

    $instruccion = "SELECT 
    tituloLibro, idLibro, portada 
    FROM libro 
    WHERE idLibro = :id";

    $query = $connection->prepare($instruccion);
    $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();

    $libro = $query->fetch(PDO::FETCH_ASSOC);

    if (!$libro) {
        return '<p>Libro no encontrado.</p>';
    }

    // Variables
    $tituloLibro = htmlspecialchars($libro['tituloLibro']);
    $extension = $libro['portada'];
    $src = "uploads/portada/{$idLibro}.{$extension}";

    // HTML como string
    $html = "
    <div class='container text-center mt-5'>
        <img 
            src='{$src}' 
            class='img-fluid img-thumbnail shadow-sm' 
            style='height: 350px; object-fit: cover; width: 100%; max-width: 300px;'
            alt='Portada de {$tituloLibro}'
        >
       
    </div>";

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    } else {
        echo "<p>ID no válido.</p>";
    }

    return $html;
}

function mostrarTarjeta($idLibro)
{
    global $connection;

    if (!isset($idLibro) || !is_numeric($idLibro)) {
        return "<p>ID no válido.</p>";
    }

    // Traer solo ese libro desde la base de datos

    $instruccion = "SELECT 
            libro.tituloLibro, 
            libro.idLibro, 
            libro.portada,
            libro.anioEdicion,
            libro.numeropaginas,
            editorial.nombreEditorial,
            GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor
        FROM libro
        LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
        LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
        LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
        WHERE libro.idLibro = :id
        GROUP BY libro.idLibro";

    $query = $connection->prepare($instruccion);
    $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();

    $libro = $query->fetch(PDO::FETCH_ASSOC);

    if (!$libro) {
        return '<p>Libro no encontrado.</p>';
    }

    // Variables
    $tituloLibro = htmlspecialchars($libro['tituloLibro']);
    $autor = htmlspecialchars($libro['autor']);
    $editorial = htmlspecialchars($libro['nombreEditorial']);
    $anio = htmlspecialchars($libro['anioEdicion']);
    $paginas = htmlspecialchars($libro['numeropaginas']);

    // HTML como string
    $html = "
    
     
                
                    <div class='card shadow-sm'>
                         <div class='card-body'>
                             <h3 class='card-title'>{$tituloLibro} 📖</h3>
                            <p class='card-text'><strong>Autor:</strong> {$autor}</p>
                            <p class='card-text'><strong>Editorial:</strong> {$editorial}</p>
                             <p class='card-text'><strong>Año de Edición:</strong> {$anio}</p>
                             <p class='card-text'><strong>Número de Páginas:</strong> {$paginas}</p>
                         </div>
                     </div>
                </div>
         </div>
     
    ";
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    } else {
        echo "<p>ID no válido.</p>";
    }

    return $html;
}

function mostrarFormato($idLibro)
{
    global $connection;

    if (!isset($idLibro) || !is_numeric($idLibro)) {
        return "<p>ID no válido.</p>";
    }

    // Consulta con filtro por ID
    $instruccion = "SELECT formato.nombre
        FROM libro
        LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
        LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
        WHERE libro.idLibro = :id";

    $query = $connection->prepare($instruccion);
    $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();

    $libro = $query->fetch(PDO::FETCH_ASSOC);

    if (!$libro) {
        return '<p>Libro no encontrado.</p>';
    }

    // Variables seguras
    $formato = htmlspecialchars($libro['nombre']);

    // HTML de salida
    $html = "
        <div class='col-3 d-flex flex-column gap-2'>
            <button class='btn btn-secondary btn-sm' type='button'>
                $formato
            </button>
        </div>";

    return $html;
}


function mostrarSinopsis($idLibro)
{
    global $connection;

    if (!isset($idLibro) || !is_numeric($idLibro)) {
        return "<p>ID no válido.</p>";
    }

    // Traer solo ese libro desde la base de datos

    $instruccion = "SELECT 
    sinopsis, idLibro 
    FROM libro 
    WHERE idLibro = :id";

    $query = $connection->prepare($instruccion);
    $respuesta = $query->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $query->execute();

    $libro = $query->fetch(PDO::FETCH_ASSOC);

    if (!$libro) {
        return '<p>Libro no encontrado.</p>';
    }

    // Variables
    $sinopsis = htmlspecialchars($libro['sinopsis']);

    // HTML como string
    $html = "
    
       <div class='card-body'>
                            <blockquote
                                class='blockquote mb-0'>
                                <p>
                                   $sinopsis
                                </p>
                            </blockquote>
                        </div>
    </div>";

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    } else {
        echo "<p>ID no válido.</p>";
    }
    return $html;
}



?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Descargar'); ?>
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
            <form class="row mb-4 g-1">
                <div class="col-3 d-grid gap-2">


                    <?php echo mostrarPortadas($_GET['id']); ?>

                </div>
                <div class='col-8'>
                    <?php echo mostrarTarjeta($_GET['id']); ?>
                </div>
        </div>
        </form>
    </div>

    <div class="container-md p-2">
        <form
            class="row g-2 justify-content-between">
            <?php echo mostrarFormato($_GET['id']); ?>

            <div class="col-9 d-grid gap-2">
                <div class="card">
                    <div class="row g-2">
                        <div class="card-header">
                            Sinopsis 📖
                        </div>
                        <?php echo mostrarSinopsis($_GET['id']); ?>
                    </div>
                    <a href="editor.php" class="btn btn-secondary" tabindex="-1" role="button">Agregar otro formato </a>
                </div>
            </div>
        </form>
    </div>
    </div>
    </div>

    <?php echo generarFooter(); ?>
</body>

</html>