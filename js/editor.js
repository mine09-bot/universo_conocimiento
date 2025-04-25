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

formCargarlibro.addEventListener("change", () => {
    const file = formCargarlibro.files[0];

    if (!file) return;

    // Lista de tipos MIME permitidos
    const allowedTypes = [
        "PDF",
        "EPUB", // EPUB
        "MOBI", // MOBI
        "AZW3", // AZW
        "HTML",
        "PLAIN",
    ];

    // Sacar el tipo de archivo
    let fileType = "";

    // Verificar que exista el tipo de archivo. Si no existe, sacar la extensión
    if (!fileType) fileType = file.name.split(".").pop().toUpperCase();
    else fileType = fileType.split("/").pop().toUpperCase();

    if (allowedTypes.includes(fileType)) {
        console.log("Tipo permitido");
    } else {
        console.log("Tipo no permitido");
        formCargarlibro.value = ""; // Limpia el input
    }

    console.log(fileType);
    //TODO Mostrar el fileType en el Dropdown Formato
    // OBETENER EL TEXTO DE CADA OPCION DEL DROPDOWN
    // CADA TEXTO DEBE SER COTEJADO CON ALLOWEDTYPES
    // SI HAY COINCIDENCIA, SELECCIONAR ESA OPCION
    const totalFormatos = formFormato.options.length;

    for (let n = 0; n < totalFormatos; n++) {
        const option = formFormato.options[n];
        if (option.text.toUpperCase() === fileType) {
            formFormato.selectedIndex = n;
            break;
        }
    }
});

const mensajeError = document.querySelector("#mensajeError");

const botonCerrar = document.querySelector("#boton-cerrar-exito");
botonCerrar.addEventListener("click", (e) => darclick(e));

//* Enviar formulario
formulario.addEventListener("submit", (e) => handleSubmit(e));

async function handleSubmit(event) {
    // Previene que la página se recargue
    event.preventDefault();

    dialogoCarga.classList.remove("d-none");

    // Habilitar temporalmente la opción "Formato"
    formFormato.disabled = false;

    // Empaquetar
    const paquete = new FormData(formulario);

    const opciones = {
        method: "post",
        body: paquete,
    };

    // Deshabilitar nuevamente la opción "Formato"
    formFormato.disabled = true;

    // Enviar
    if (estaEditando()) {
        //* Editando
        console.log("el usuario esta editando");

        fetch("api/actualizar.php", opciones)
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
    } else {
        //* Creando

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
}

function darclick(event) {
    if (estaEditando())
        window.location.href = "detalles.php" + window.location.search;
    else window.location.href = "inicio.php";
}

function estaEditando() {
    return !!window.location.search;
}
