// Dialogo de Carga
const dialogoCarga = document.querySelector("#contenedor-carga");
// Dialogo de Exito
const dialogoExito = new bootstrap.Modal("#dialogo-exito", {});
// Dialogo de Error
const dialogoError = new bootstrap.Modal("#dialogo-error", {});

// Formulario
const formulario = document.querySelector("#formulario");

// Campos
const formPortada = document.querySelector("#portada");
const formTitulo = document.querySelector("#titulo");
const formAutor = document.querySelector("#autor");
const formIsbn = document.querySelector("#isbn");
const formEditorial = document.querySelector("#editorial");
const formNumerodepaginas = document.querySelector("#numpaginas");
const formAnodeedicion = document.querySelector("#anoedicion");
const formCategoria = document.querySelector("#categoria");
const formFormato = document.querySelector("#formato");
const formPais = document.querySelector("#pais");
const formIdioma = document.querySelector("#idioma");
const formSinopsis = document.querySelector("#sinopsis");
const formCargarlibro = document.querySelector("#cargarlibro");
const mensajeError = document.querySelector("#mensajeError");

const botonCerrar = document.querySelector("#boton-cerrar-exito");
botonCerrar.addEventListener("click", (e) => darclick(e));

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

    fetch("api/cargar.php", opciones)
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
                "Ha ocurrido un error al cargar el libro: " + error;
            dialogoError.show();
        })
        .finally(() => {
            // Oculta el loading
            dialogoCarga.classList.add("d-none");
        });
}

function darclick(event) {
    window.location.href = "inicio.php";
}
