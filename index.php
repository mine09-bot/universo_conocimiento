<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login y Registro - MagtimusPro</title>
    <link rel="stylesheet" href="assets/css/estilos.css" />
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesion para entrar en la paginas</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesion</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aun no tienes una cuenta?</h3>
                    <p>Registrate para que puedas iniciar sesion</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>
            <img
                src="assets/images/logo.svg"
                alt="Bootstrap"
                width="300"
                height="300" />
            <h1>¡Bienvenido a Bookia!</h1>
            <p>Unidos por el saber</p>
            <p>En esta página podrás encontrar una gran variedad de libros de diferentes categorías, además de poder subir tus propios libros y compartirlos con el mundo.</p>
            <p>Si ya tienes una cuenta, inicia sesión para comenzar a disfrutar de la lectura.</p>

            <!--Formulario de registro-->
            <div class="contenedor__login-register">
                <form action="" class="formulario__login">
                    <h2>Iniciar Sesion</h2>
                    <input type="text" placeholder="Correo Electronico" />
                    <input type="password" placeholder="Contraseña" />
                    <button>Entrar</button>
                </form>
                <!--Registro-->
                <form action="" class="formulario__register">
                    <h2>Registrarse</h2>
                    <input type="text" placeholder="Nombre Completo" name="nombre_completo" />
                    <input type="text" placeholder="Correo Electronico" name="correo" />
                    <input type="text" placeholder="Usuario" name="usuario" />
                    <input type="password" placeholder="Contraseña" name="contrasena" />
                    <button>Registrarse</button>
                </form>
            </div>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
</body>

</html>