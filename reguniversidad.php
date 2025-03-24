<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<head>  
<?php echo generarEncabezado('Registro de Universidad'); ?>
</head>  
    <body>
        <div class="container-md mt-2">
            <form class="row g-1">
                <div class="col-6 d-flex flex-column gap-2">
                    <img
                        src="logoproyecto.webp"
                        alt="Bootstrap"
                        width="300"
                        height="300"
                    />
                </div>

                <div class="col-6 d-grid gap-3">
                    <div class="container">
                        <p>Registra tu Universidad</p>

                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Nombre
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Facultad
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInput"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >País
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Telefono</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Correo Electronico</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label
                                for="exampleInputPassword1"
                                class="form-label"
                                >Contraseña
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
