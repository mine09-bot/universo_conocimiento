<?php
// Iniciar variables de sesión
// session_start();

// Incluir archivo de configuracion
include('../config.php');
include('../utils.php');

$carpetaImagen = "../uploads/portada/";
$carpetaArchivo = "../uploads/archivo/";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Paquete
        $paquete = $_POST;

        $titulo = $paquete['titulo'];
        $autor = $paquete['autor'];
        $anoedicion = $paquete['anoedicion'];
        $categoria = $paquete['categoria'];
        $editorial = $paquete['editorial'];
        $formato = $paquete['formato'];
        $idioma = $paquete['idioma'];
        $isbn = $paquete['isbn'];
        $numpaginas = $paquete['numpaginas'];
        $pais = $paquete['pais'];
        $sinopsis = $paquete['sinopsis'];

        $portada = $_FILES['portada'];
        $cargarLibro  = $_FILES['cargarlibro'];

        // Comenzar transacción
        $connection->beginTransaction();

        //*Editorial
        // Verificar que ya exista el autor
        $instruccion = "SELECT * FROM editorial where LOWER(nombreEditorial) LIKE LOWER(:nomb)";

        $nombreEditorial = "%$editorial%";
        // Si si existe, agarrar su ID
        $query = $connection->prepare($instruccion);
        $query->bindParam("nomb", $nombreEditorial, PDO::PARAM_STR);
        $query->execute();
        $respuesta = $query->fetch(PDO::FETCH_ASSOC);

        if ($respuesta) {
            $idEditorial = $respuesta['idEditorial'];
        } else {
            // Si no existe, darlo de alta y tomar su nuevo ID
            $instruccion = "INSERT INTO editorial (nombreEditorial) VALUES (:nom)";
            $query = $connection->prepare($instruccion);

            $nombreEditorial = primeraMayus($editorial);
            $query->bindParam("nom", $nombreEditorial, PDO::PARAM_STR);
            $query->execute();

            $idEditorial = $connection->lastInsertId();
        }

        //* Crear el libro en BD y tomar el ID
        $instruccion = "INSERT INTO libro(tituloLibro, Editorial_idEditorial, Formato_idFormatos, Idioma_idIdioma, Categoria_idCategoria, numeroPaginas, isbn, anioEdicion, sinopsis, Pais_idPais ) VALUES (:tit, :edit, :form, :idi, :cat, :numpag, :isbn, :ano, :sinop, :pa)";

        $query = $connection->prepare($instruccion);
        $query->bindParam("tit", $titulo, PDO::PARAM_STR);
        $query->bindParam("edit", $idEditorial, PDO::PARAM_STR);
        $query->bindParam("form", $formato, PDO::PARAM_STR);
        $query->bindParam("idi", $idioma, PDO::PARAM_STR);
        $query->bindParam("cat", $categoria, PDO::PARAM_STR);
        $query->bindParam("numpag", $numpaginas, PDO::PARAM_STR);
        $query->bindParam("isbn", $isbn, PDO::PARAM_STR);
        $query->bindParam("ano", $anoedicion, PDO::PARAM_STR);
        $query->bindParam("sinop", $sinopsis, PDO::PARAM_STR);
        $query->bindParam("pa", $pais, PDO::PARAM_STR);
        $query->execute();
        $idLibro = $connection->lastInsertId();


        //* Portada

        // Generar nuevo nombre
        $extension = pathinfo($portada['name'], PATHINFO_EXTENSION);
        $nuevoNombre = $carpetaImagen . $idLibro . '.' . $extension;

        // Subir portada
        if (!move_uploaded_file($portada['tmp_name'], $nuevoNombre)) {
            throw new Exception('Error al subir portada');
        }

        //* Archivo
        // Generar nuevo nombre
        $extension = pathinfo($cargarLibro['name'], PATHINFO_EXTENSION);
        $nuevoNombre = $carpetaArchivo . $idLibro . '.' . $extension;

        // Subir archivo
        if (!move_uploaded_file($cargarLibro['tmp_name'], $nuevoNombre)) {
            throw new Exception('Error al subir el archivo');
        }


        //* Autor
        // Verificar que ya exista el autor
        $instruccion = "SELECT * FROM autor where nombre LIKE :nomb";

        $nombreAutor = "%$autor%";
        // Si si existe, agarrar su ID
        $query = $connection->prepare($instruccion);
        $query->bindParam("nomb", $nombreAutor, PDO::PARAM_STR);
        $query->execute();
        $respuesta = $query->fetch(PDO::FETCH_ASSOC);

        if ($respuesta) {
            $idAutor = $respuesta['idAutor'];
        } else {
            // Si no existe, darlo de alta y tomar su nuevo ID
            $instruccion = "INSERT INTO autor (nombre, paisProcedencia) VALUES (:nom, NULL)";
            $query = $connection->prepare($instruccion);

            $nombreAutor = primeraMayus($autor);
            $query->bindParam("nom", $nombreAutor, PDO::PARAM_STR);
            $query->execute();

            $idAutor = $connection->lastInsertId();
        }

        // Crear el registro en autorlibro
        $instruccion = "INSERT INTO autorlibro (idLibro, idAutor)
        VALUES (:lib, :aut)";
        $query = $connection->prepare($instruccion);
        $query->bindParam("lib", $idLibro, PDO::PARAM_STR);
        $query->bindParam("aut", $idAutor, PDO::PARAM_STR);
        $query->execute();
        $respuesta = $query->fetch(PDO::FETCH_ASSOC);

        $connection->commit();

        $res = ['status' => 1, 'paquete' => $_POST];
    } catch (Exception $e) { // Something happened!
        $connection->rollBack();
        $res = ['status' => 0, 'msg' => "Error de servidor", "error" => $e->getMessage()];
    }
} else {
    $res = ['status' => 0, 'msg' => "Error de envío POST", "error" => $_SERVER['REQUEST_METHOD']];
}

// Send the response back with the info
echo json_encode($res);
