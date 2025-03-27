<?php
// Iniciar variables de sesión
// session_start();

// Incluir archivo de configuracion
include('../config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $box = json_decode(file_get_contents('php://input'), true);

    try {
        // Paquete
        $paquete = $_POST;

        $titulo = $paquete['titulo'];
        $autor = $paquete['autor'];
        $anoedicion =$paquete['anoedicion'];
        $categoria = $paquete['categoria'];
        $editorial = $paquete['editorial'];
        $formato = $paquete['formato'];
        $idioma = $paquete['idioma'];
        $isbn = $paquete['isbn'];
        $numpaginas = $paquete['numpaginas'];
        $pais = $paquete['pais'];
        $sinopsis =$paquete['sinopsis'];
        //TODO Poner todos los campos


        $instruccion = "INSERT INTO libro(tituloLibro, Editorial_idEditorial, Formato_idFormatos, Idioma_idIdioma, Categoria_idCategoria, numeroPaginas, isbn, añoEdicion, sinopsis, Pais_idPais )
                    VALUES (:titulo, :editorial, :formato, :idioma, :categoria, :numpaginas, :isbn, :anoedicion, :sinopsis, :pais)";
        
        //* Portada
        // Generar 
        // Subir portada
        // Obtener el nombre

        //Archivo



        //* Autor
        // Verificar que ya exista el autor
        $instruccion= "SELECT * FROM autor where nombre=:nombre";
        // Si si existe, agarrar su ID


        // Si no existe, darlo de alta y tomar su nuevo ID
        $instruccion = "INSERT INTO autor (nombre, paisProcdencia) VALUES (:nombre, NULL)";


        // Crear el libro en BD y tomar el ID

        // Crear el registro en autorlibro

        $instruccion = "INSERT INTO autorlibro (idLibro, idAutor)
        VALUES (:libro, :autor)" ;
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
