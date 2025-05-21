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
const formFoto = document.querySelector("#foto");
const formNombre = document.querySelector("#nombre");
const formapPaterno = document.querySelector("#apellidoPaterno");
const formapMaterno = document.querySelector("#apellidoMaterno");
const formFacultad = document.querySelector("#idfacultad");
const formPais = document.querySelector("#pais");
const formUniversidad = document.querySelector("#nombreUniversidad");
const formLinkedIn = document.querySelector("#linkedIn");
const formFacebook = document.querySelector("#facebook");
const formCargarfoto = document.querySelector("#cargarfoto");

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
    fetch("api/editarperfil.php", opciones)
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
                "Ha ocurrido un error al cargar la foto: " + error;
            dialogoError.show();
        })
        .finally(() => {
            // Oculta el loading
            dialogoCarga.classList.add("d-none");
        });
}

function darclick(event) {
    window.location.href = "perfil.php";
}
