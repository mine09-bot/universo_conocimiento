<?php
function mostrarPortadas($idLibro)
{
    global $connection;

    if (!isset($idLibro) || !is_numeric($idLibro)) {
        return "<p>ID no válido.</p>";
    }

    // Traer solo ese libro desde la base de datos
    $consulta = $connection->prepare("
SELECT
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
GROUP BY libro.idLibro
");
    $consulta->bindParam(':id', $idLibro, PDO::PARAM_INT);
    $consulta->execute();

    $libro = $consulta->fetch(PDO::FETCH_ASSOC);

    if (!$libro) {
        return "<p>Libro no encontrado.</p>";
    }

    // Variables
    $tituloLibro = htmlspecialchars($libro['tituloLibro']);
    $autor = htmlspecialchars($libro['autor']);
    $editorial = htmlspecialchars($libro['nombreEditorial']);
    $anio = htmlspecialchars($libro['anioEdicion']);
    $paginas = htmlspecialchars($libro['numeropaginas']);
    $extension = $libro['portada'];
    $src = "uploads/portada/{$idLibro}.{$extension}";

    // HTML como string
    $html = "

<div class='container-xxl mt-5'>
    <div class='row'>
        <div class='col-6 text-center'>
            <img
                src='{$src}'
                class='img-fluid img-thumbnail shadow-sm'
                style='height: 350px; object-fit: cover; width: 100%; max-width: 300px;'
                alt='Portada de {$tituloLibro}'>
            <h3 class='mt-3'>{$tituloLibro}</h3>
        </div>



        <div class='col-6'>
            <div class='card shadow-sm'>
                <div class='card-body'>
                    <h5 class='card-title'>{$tituloLibro} 📖</h5>
                    <p class='card-text'><strong>Autor:</strong> {$autor}</p>
                    <p class='card-text'><strong>Editorial:</strong> {$editorial}</p>
                    <p class='card-text'><strong>Año de Edición:</strong> {$anio}</p>
                    <p class='card-text'><strong>Número de Páginas:</strong> {$paginas}</p>
                </div>
            </div>
        </div>
    </div>
</div>
";


    return $html;
}
