<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Recuperar Contraseña'); ?>
    

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
