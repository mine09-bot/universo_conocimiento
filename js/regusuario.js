// Dialogo de Carga
const dialogoCarga = document.querySelector("#contenedor-carga");
// Dialogo de Exito
const dialogoExito = new bootstrap.Modal(
    document.getElementById("dialogo-exito")
);
// Dialogo de Error
const dialogoError = new bootstrap.Modal(
    document.getElementById("dialogo-error")
);

// Formulario
const formulario = document.querySelector("#formulario");

// Campos
const formNombre = document.querySelector("#nombre");
const formapPaterno = document.querySelector("#apellidoPaterno");
const formapMaterno = document.querySelector("#apellidoMaterno");
const formCorreo = document.querySelector("#correoElectronico");
const formTelefono = document.querySelector("#telefono");
const formContrasena = document.querySelector("#contrasena");
const formnomUsuario = document.querySelector("#nombreUsuario");
const formSexo = document.querySelector("#sexo");
const formPais = document.querySelector("#pais");
const formnivel = document.querySelector("#nivelUsuario");
const formfacultad = document.querySelector("#idFacultad");

const mensajeError = document.querySelector("#mensajeError");

const botonCerrar = document.querySelector("#boton-cerrar-exito");
botonCerrar.addEventListener("click", (e) => darclick(e));

//* Enviar formulario
formulario.addEventListener("submit", (e) => handleSubmit(e));

async function handleSubmit(event) {
    // Previene que la página se recargue
    event.preventDefault();

    dialogoCarga.classList.remove("d-none");

    // Empaquetar
    const paquete = new FormData(formulario);

    const opciones = {
        method: "post",
        body: paquete,
    };

    // Enviar
    fetch("api/registrousuario.php", opciones)
        .then((response) => {
            if (response.ok) return response.text();
            else throw new Error(response.status);
        })
        .then((textData) => {
            console.log(textData);

            const retrievedData = JSON.parse(textData);
            // Si hubo respuesta
            console.log(retrievedData);

            if (retrievedData.status == 1) dialogoExito.show();
            else throw new Error(retrievedData.error);
        })
        .catch((error) => {
            mensajeError.innerHTML =
                "Ha ocurrido un error al crear el usuario: " + error;
            dialogoError.show();
        })
        .finally(() => {
            // Oculta el loading
            dialogoCarga.classList.add("d-none");
        });
}

function darclick(event) {
    window.location.href = "login.php";
}
