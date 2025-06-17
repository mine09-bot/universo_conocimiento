<?php
session_start();
require "utils.php";
require "config.php";

verificarSesion();

if (isset($_GET['id'])) {
    $idLibro = $_GET['id'];

    $instruccion = "SELECT
         libro.tituloLibro,
         libro.idLibro,
         libro.portada,
         libro.anioEdicion,
         libro.sinopsis,
         libro.isbn,
         libro.numeroPaginas,
         idioma.idIdioma,
         GROUP_CONCAT(autor.nombre SEPARATOR ', ') AS autor,
         categoria.idCategoria AS idCategoria,
         formato.nombre,
         editorial.nombreEditorial,
         libro.pais_idPais AS idPais,
         subidas.Usuario_idUsuario AS creador,
         subidas.fecha
            FROM libro
            LEFT JOIN idioma ON libro.Idioma_idIdioma = idioma.idIdioma
            LEFT JOIN autorlibro ON libro.idLibro = autorlibro.idLibro
            LEFT JOIN autor ON autorlibro.idAutor = autor.idAutor
            LEFT JOIN categoria ON libro.Categoria_idCategoria = categoria.idCategoria
            LEFT JOIN formatolibro ON formatolibro.idLibro = libro.idLibro
            LEFT JOIN formato ON formato.idFormatos = formatolibro.idFormato
            LEFT JOIN editorial ON libro.Editorial_idEditorial = editorial.idEditorial
            LEFT JOIN subidas ON libro.idLibro = subidas.Libro_idLibro
        WHERE libro.idLibro=$idLibro
        GROUP BY libro.idLibro";


    $query = $connection->prepare($instruccion);
    $query->execute();
    $res = $query->fetch(PDO::FETCH_ASSOC);

    $titulo = $res['tituloLibro'];
    $portada = $res['portada'];
    $anioEdic = $res['anioEdicion'];
    $sinopsis = $res['sinopsis'];
    $categoria = $res['idCategoria'];
    $autor = $res['autor'];
    $editorial = $res['nombreEditorial'];
    $numpaginas = $res['numeroPaginas'];
    $isbn = $res['isbn'];
    $pais = $res['idPais'];
    $idioma = $res['idIdioma'];
    $src = "uploads/portada/" . $idLibro . "." . $portada;
    $creador = $res['creador'];
}

function generarCategorias(int $idCategoria = 0)
{
    global $connection;

    $instruccion = "SELECT * FROM categoria";

    $query = $connection->prepare($instruccion);

    $query->execute();

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idCategoria == 0 ? "selected" : "";
    $html = "<option $selected disabled value=''>Selecciona</option>";

    foreach ($respuesta as $cat) {
        $categoria = $cat['idCategoria'];
        $nombre = $cat['nombreCategoria'];
        $selEditor = $idCategoria == $categoria ? "selected" : "";
        $html .= "<option value='$categoria' $selEditor>$nombre</option>";
    }

    return $html;
}
function generarFormato()
{
    global $connection;

    $instruccion = "SELECT * FROM formato";

    $query = $connection->prepare($instruccion);

    $query->execute();

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $html = '<option selected disabled value="">Seleccionado Automaticamente</option  >';

    foreach ($respuesta as $cat) {
        $html .= '<option  value ="' . $cat['idFormatos'] . '">' . $cat['nombre'] . '</option>';
    }

    return $html;
}
function generarPais(int $idPais = 0)
{
    global $connection;

    $instruccion = "SELECT * FROM pais";

    $query = $connection->prepare($instruccion);

    $query->execute();

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);

    $selected = $idPais == 0 ? "selected" : "";

    $html = "<option $selected disabled value=''>Selecciona</option>";

    foreach ($respuesta as $cat) {
        $pais = $cat['idPais'];
        $nombre = $cat['nombrePais'];
        $selEditor = $idPais == $pais ? "selected" : "";

        $html .= "<option value='$pais' $selEditor>$nombre</option>";
    }

    return $html;

    // condicional ? verdadera : falsa
    // Operdor ?
}

function generarIdioma(int $idIdioma = 0)
{
    global $connection;

    $instruccion = "SELECT * FROM idioma ORDER BY nombreIdioma";

    $query = $connection->prepare($instruccion);

    $query->execute();

    $respuesta = $query->fetchAll(PDO::FETCH_ASSOC);
    $selected = $idIdioma == 0 ? "selected" : "";

    $html = "<option $selected disabled value=''>Selecciona</option>";

    foreach ($respuesta as $cat) {
        $idioma = $cat['idIdioma'];
        $nombre = $cat['nombreIdioma'];
        $selEditor = $idIdioma == $idioma ? "selected" : "";
        $html .= "<option value='$idioma' $selEditor>$nombre</option>";
    }

    return $html;
}



?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Editor de Libros'); ?>
    <script src="js/editor.js?v=1.9" defer></script>
</head>

<body>
    <!-- Carga -->
    <div
        class="d-none position-absolute w-100 h-100 left-0 top-0 page-loader flex-column bg-dark bg-opacity-50 d-flex justify-content-center align-items-center"
        id="contenedor-carga"
        style="z-index: 1021">
        <div class="flipping">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Guardando libro...</span>
    </div>

    <!-- Contenido -->
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav();  ?>
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <form id="formulario">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                            Datos Generales del Libro
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                        <input type="hidden" id="idLibro" name="idLibro" value="<?php echo $idLibro ?? ''; ?>">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Portada</label>
                                            <input class="form-control" type="file" accept="image/*" <?php echo isset($idLibro) ? '' : 'required'; ?> name="portada" id="portada" />
                                            <img
                                                src="<?php echo $src; ?>"
                                                class="img-fluid img-thumbnail"
                                                style='width: 200px; height: auto;' />
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Titulo</label>
                                            <input type="text" class="form-control" rows="1" minlength="5" maxlength="64" required name="titulo" id="titulo" value="<?php echo $titulo ?? ''; ?>" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Autor</label>
                                            <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="autor" id="autor" value="<?php echo $autor ?? ''; ?>" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">ISBN</label>
                                            <input type="text" class="form-control" rows="1" maxlength="32" name="isbn" id="isbn"
                                                value="<?php echo $isbn ?? ''; ?>" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label"> Editorial </label>
                                            <input type="text" class="form-control" rows="1" maxlength="64" minlength="10" required name="editorial" id="editorial" value="<?php echo $editorial ?? ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="pais" class="form-label">Pais</label>
                                            <select class="form-select" aria-label="Large select example" id="pais" required name="pais">

                                                <?php echo generarPais($pais ?? 0); ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-6 d-flex flex-column gap-1">

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Numero de Páginas </label>
                                            <input type="number" min="10" max="10000" class="form-control" required name="numpaginas" id="numpaginas" value="<?php echo $numpaginas ?? ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="categoria" class="form-label">Categoría</label>
                                            <select class="form-select" aria-label="Large select example" required name="categoria" id="categoria">
                                                <?php echo generarCategorias($categoria ?? 0); ?>
                                            </select>
                                        </div>


                                        <div class="mb-3" required>
                                            <label for="year" class="form-label">Año de Edición</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                min="1800"
                                                max="2099"
                                                placeholder="Ejemplo: 2024" required
                                                name="anioedicion" id="anioedicion" value="<?php echo $anioEdic ?? ''; ?>" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Sinopsis </label>
                                            <textarea class="form-control" rows="9" name="sinopsis" required id="sinopsis"><?php echo htmlspecialchars($sinopsis ?? ''); ?></textarea>


                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="h4 pb-2 mb-4 text-white border-bottom border-success">
                                            Datos para Cargar Libros
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Cargar Libro</label>
                                            <input class="form-control" type="file" accept=".epub,.pdf,.azw,.azw3" <?php echo isset($titulo) ? '' : 'required'; ?> name="cargarlibro" id="cargarlibro" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="formato" class="form-label">Formato</label>
                                            <select class="form-select" aria-label="Large select example" id="formato" name="formato" disabled <?php echo $idLibro ? '' : 'required'; ?>>

                                                <?php echo generarFormato(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex flex-column gap-1">
                                        <div class="mb-3">
                                            <label for="idioma" class="form-label">Idioma</label>
                                            <select class="form-select" aria-label="Large select example" id="idioma" name="idioma" <?php echo $idLibro ? '' : 'required'; ?>>

                                                <?php echo generarIdioma($idioma ?? 0); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php echo generarFooter(); ?>
            </div>
        </div>
    </div>

    <!-- Diálogo éxito -->
    <div class="modal fade" id="dialogo-exito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-success">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Éxito</h1>
                </div>
                <div class="modal-body">Libro cargado al sistema exitosamente</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="boton-cerrar-exito">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Diálogo error -->
    <div class="modal fade" id="dialogo-error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-danger">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Error</h1>
                </div>
                <div class="modal-body" id="mensajeError">Ha ocurrido un error al cargar el libro: [error]</div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>