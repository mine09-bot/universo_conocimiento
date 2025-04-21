<?php
session_start();

require "utils.php";
require "config.php";
verificarSesion();

function verLibros(){
    global $connection;

    $bus = '';
    if(isset($_GET['q'])) {
        $busqueda = $_GET['q'];
        $bus = " WHERE LOWER(tituloLibro) LIKE LOWER('%$busqueda%') OR LOWER(autor.nombre) LIKE LOWER('%$busqueda%') 
        OR LOWER(editorial.nombreEditorial) LIKE LOWER('%$busqueda%') OR LOWER(categoria.nombreCategoria) LIKE LOWER('%$busqueda%') 
        OR LOWER(formato.nombre) LIKE LOWER('%$busqueda%') OR LOWER(idioma.nombreIdioma) LIKE LOWER('%$busqueda%')";
    }

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
        $bus
        GROUP BY libro.idLibro
        ORDER BY libro.visitas DESC";

    $query=$connection->prepare($instruccion);
    $query->execute();       
    $respuesta=$query->fetchAll(PDO::FETCH_ASSOC);  

    $html = "";

    foreach($respuesta as $libro) {
        $tituloLibro = $libro['tituloLibro'];
        $idLibro = $libro['idLibro'];
        $extension = $libro['portada'];
        $autor = $libro['autor'];
        $editorial = $libro['nombreEditorial'];
        $categoria = $libro['nombreCategoria'];
        $formato = $libro['nombre'];
        $idioma = $libro['nombreIdioma'];
        
        $html .= "<tbody>
                 <tr>
                    <th scope='row'>
                    <img
                    src='uploads/portada/$idLibro.$extension'
                    class='img-fluid img-thumbnail'
                    alt='...' style='height: 5rem;'/>
                    </th>
                    <td>$tituloLibro</td>
                    <td>$autor</td>
                    <td>$editorial</td>
                    <td>$categoria</td>
                    <td>$formato</td>
                    <td>$idioma</td>
                            <td>
                            <button
                            class='btn btn-outline-success'
                            type='submit'>
                            <i class='fa-solid fa-circle-down'></i>
                            </button>
                            </td>
                </tr>
                                        
                                        
                                    </tbody> ";
    }

    return $html;
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