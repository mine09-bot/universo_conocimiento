<?php
// Iniciar variables de sesión
// session_start();

// Incluir archivo de configuracion
include('../config.php');

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
        $nombre = $paquete['nombre'];
        $libro = $paquete['libro'];
        $autor = $paquete['autor'];
        

        //* Crear el libro en BD y tomar el ID
        $instruccion = "INSERT INTO libro(tituloLibro, Editorial_idEditorial, Formato_idFormatos, Idioma_idIdioma, Categoria_idCategoria, numeroPaginas, isbn, anioEdicion, sinopsis, Pais_idPais ) VALUES (:tit, :edit, :form, :idi, :cat, :numpag, :isbn, :ano, :sinop, :pa)";

        $query = $connection->prepare($instruccion);
        $query->bindParam("tit", $titulo, PDO::PARAM_STR);
        $query->bindParam("edit", $editorial, PDO::PARAM_STR);
        $query->bindParam("form", $formato, PDO::PARAM_STR);
        $query->bindParam("idi", $idioma, PDO::PARAM_STR);
        $query->bindParam("cat", $categoria, PDO::PARAM_STR);
        $query->bindParam("numpag", $numpaginas, PDO::PARAM_STR);
        $query->bindParam("isbn", $isbn, PDO::PARAM_STR);
        $query->bindParam("ano", $anoedicion, PDO::PARAM_STR);
        $query->bindParam("sinop", $sinopsis, PDO::PARAM_STR);
        $query->bindParam("pa", $pais, PDO::PARAM_STR);
        $query->execute();
        $respuesta=$query->fetch(PDO::FETCH_ASSOC);


        
        //* Portada
        // Generar nombre unico

        // Subir portada
        // Obtener el nombre

        //Archivo
        
        

        //* Autor
        // Verificar que ya exista el autor
        $instruccion = "SELECT * FROM autor where nombre=:nomb";
        // Si si existe, agarrar su ID
        $query = $connection->prepare($instruccion);
        $query->bindParam("nomb", $nombre, PDO::PARAM_STR);
        $query->execute();
        $respuesta=$query->fetch(PDO::FETCH_ASSOC);
        
        // Si no existe, darlo de alta y tomar su nuevo ID
        $instruccion = "INSERT INTO autor (nombre, paisProcedencia) VALUES (:nom, NULL)";
        $query = $connection->prepare($instruccion);
        $query->bindParam("nom", $nombre, PDO::PARAM_STR);
        $query->execute();
        $respuesta=$query->fetch(PDO::FETCH_ASSOC);

        // Crear el registro en autorlibro

        $instruccion = "INSERT INTO autorlibro (idLibro, idAutor)
        VALUES (:lib, :aut)";
        $query = $connection->prepare($instruccion);
        $query->bindParam("lib", $libro, PDO::PARAM_STR);
        $query->bindParam("aut", $autor, PDO::PARAM_STR);
        $query->execute();
        $respuesta=$query->fetch(PDO::FETCH_ASSOC);
        //* Aqui ya no
        //TODO Preparar la conexion




        /*
        // Guardar variables
        $usuario = $box['user'];
        $password = $box['pass'];
        
        // Convertir el password a MD5
        $md5pass = md5($password);
        
        // Verificar si el usuario ingreso un ID o un email
        $instruccion = "SELECT 
        p.id AS user_id,
        p.email,
        p.password,
        p.active,
        p.idLevel,
        p.idCitizen,
        c.id,
        c.name,
        c.lastName,
                        c.lastNameMat,
                        c.dob,
                        c.gender,
                        c.picture,
                        e.id AS entity_id,
                        e.name AS entity_name,
                        pos.id AS position_id,
                        pos.name AS position_name
                     FROM Profile AS p LEFT JOIN Citizen AS c ON p.idCitizen=c.id
                     LEFT JOIN CitizenEntity AS ce ON ce.idCitizen=c.id
                     LEFT JOIN Entity AS e ON e.id=ce.idEntity
                     LEFT JOIN Position AS pos ON pos.id=ce.idPosition 
                     WHERE p.email=:usuario AND p.password=:md5pass";

        // Preparar conexion
        $query = $connection->prepare($instruccion);
        // Remplazar los textos por variables
        $query->bindParam("usuario", $usuario, PDO::PARAM_STR);
        $query->bindParam("md5pass", $md5pass, PDO::PARAM_STR);
        // Ejecutar la consulta
        $query->execute();

        // Guardar el resultado
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // Verificar si la base de datos retorno un usuario
        if (!$result) {
            // No hay usuario, algo es incorrecto
            $response['success'] = false;
            $response['message'] = 'Informacion Incorrecta';
        } else {
            // Las credenciales son validas

            // Verificar que el usuario no este bloqueado
            if ($result['active'] == 1) {
                // No esta bloqueado, iniciar sesion
                $response['success'] = true;
                $response['message'] = $result['email'];

                // Generar variables de sesion
                foreach ($result as $key => $value) {
                    $_SESSION[$key] = $value;
                }

                // Set a new variable for portal type
                $portalType = $_SESSION['entity_id'] != NULL ? $_SESSION['entity_id'] : 2;
                $_SESSION['portalType'] = $portalType;
            } else {
                // Existe un bloqueo
                $response['success'] = false;
                $response['message'] = "Inactivo";
            }
        }
            */
        $res = ['status' => 1, 'paquete' => $_POST];
    } catch (Exception $e) { // Something happened!
        $res = ['status' => 0, 'msg' => "Error de servidor", "error" => $e->getMessage()];
    }
} else {
    $res = ['status' => 0, 'msg' => "Error de envío POST", "error" => $_SERVER['REQUEST_METHOD']];
}

// Send the response back with the info
echo json_encode($res);
