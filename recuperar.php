<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Recuperar Contraseña</title>
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
                    <div class="position-relative p-3 border">
                        <button
                            type="button"
                            class="btn-close position-absolute top-0 end-0"
                            aria-label="Close"
                        ></button>
                        <h5>Introduzca su correo</h5>
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
                        <button type="submit" class="btn btn-primary">
                            Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
