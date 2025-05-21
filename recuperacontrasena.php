<?php
session_start();
require 'utils.php';
require "config.php";

if (isset($_POST['correo'])) {
    $correo = $_POST['correo'];
    $instruccion = "SELECT * FROM usuario where correoElectronico=:x";

    $query = $connection->prepare($instruccion);
    $query->bindParam("x", $correo, PDO::PARAM_STR);
    $query->execute();
    $respuesta = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica si el correo existe en la base de datos
    $usuario = $respuesta['correoElectronico'];

    if ($usuario) {
        // Generar Token
        //TODO

        // Enviar correo
        $to = $correo;
        $subject = "Recuperar Contraseña";
        $message = "Hola, para restablecer tu contraseña, introduce el siguiente token: $token";
        $headers = "From: Bookia";
        mail($to, $subject, $message, $headers);


        // Guardar token en BDD
        //TODO
    } else {
        // Correo no existe
    }
    // Mostrar mensaje de éxito
    $msj = "Si el correo está registrado, se enviará un enlace para restablecer la contraseña.";
}

$paso1 = <<<HTML
    <label for="correo">Escribe tu correo:</label>
    <input type="email" name="correo" required style="width: 300px;">
    <div class="mb-3 mt-4">
        <button class="btn btn-primary " type="submit">Enviar enlace</button>
    </div>
    HTML;
?>

<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Recuperar Contraseña'); ?>
</head>

<body>
    <div class="container-md mt-2">
        <form class="row g-1" action="enviar_link.php" method="post">
            <div class="col-6 d-flex flex-column gap-2">
                <img
                    src="assets/images/logo.svg"
                    alt="Bootstrap"
                    width="150"
                    height="150" />
                <h3>¡Recuperar Contraseña!</h3>


                <?php
                // Verifica si el formulario fue enviado
                if (isset($_POST['correo'])) {
                    // Si el correo existe, muestra el mensaje de éxito
                    echo $paso2;
                } else {
                    // Si el formulario no fue enviado, muestra el formulario
                    echo $paso1;
                }
                ?>
            </div>
        </form>

    </div>
    <?php
    if (isset($msj)) {
        echo "<script>alert('$msj');</script>";
    }
    ?>
</body>

</html>