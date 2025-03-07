<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Registro</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"
        ></script>
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
                        <p>Registro de Nuevo usuario</p>

                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Nombre</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Apellido Paterno</label
                            >
                            <input
                                type="text"
                                class="form-control"
                                id="exampleInput"
                                aria-describedby="emailHelp"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="exampleInput" class="form-label"
                                >Apellido Materno</label
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
                                >Nombre de Usuario</label
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
                                >Password</label
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
                                >Sexo</label
                            >
                            <select
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>Selecciona la opcion</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">Otro</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"
                                >Pais</label
                            >
                            <select
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected>Selecciona la opcion</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
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
