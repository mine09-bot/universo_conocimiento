// Dialogo de Carga
const dialogoCarga = document.querySelector("#contenedor-carga");

// Dialogo Facultades
const dialogoFacu = new bootstrap.Modal(
    document.getElementById("dialogo-facultades")
);

// Dialogo de Exito
const dialogoExito = new bootstrap.Modal(
    document.getElementById("dialogo-exito")
);
// Dialogo de Error
const dialogoError = new bootstrap.Modal(
    document.getElementById("dialogo-error")
);
const mensajeError = document.querySelector("#mensajeError");

// Formularios
const fUni = document.querySelector("#form_uni"); // Uni
const fFacu = document.querySelector("#form_facu"); // Facu

// Tabla
const tablaFacu = document.querySelector("#tablaFacultades");

// Sin Facultades
const sinFacu = document.querySelector("#no-facultades");

const botonCerrar = document.querySelector("#boton-cerrar-exito");
botonCerrar.addEventListener("click", (e) => darclick(e));
tablaFacu.addEventListener("click", (e) => clickTabla(e));
fUni.addEventListener("submit", (e) => guardarUni(e));
fFacu.addEventListener("submit", (e) => guardarFacu(e));

const oFacultades = [];

async function guardarUni(event) {
    // Previene que la página se recargue
    event.preventDefault();

    dialogoCarga.classList.remove("d-none");

    // Empaquetar
    const paquete = new FormData(fUni);

    paquete.append("facultades", JSON.stringify(oFacultades));

    const opciones = {
        method: "post",
        body: paquete,
    };

    // Enviar
    fetch("api/reguni.php", opciones)
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
                "Ha ocurrido un error al crear la universidad: " + error;
            dialogoError.show();
        })
        .finally(() => {
            // Oculta el loading
            dialogoCarga.classList.add("d-none");
        });
}

async function guardarFacu(event) {
    // Previene que la página se recargue
    event.preventDefault();

    // Empaquetar
    const paquete = new FormData(fFacu);

    // Objeto
    const oForm = {
        id: -1,
        nombre: paquete.get("nombreFacultad"),
        direccion: paquete.get("direccion"),
        codigoPostal: paquete.get("codigoPostal"),
        telefono: paquete.get("telefono"),
    };

    const indiceEditar = document.querySelector("#indice").value;
    if (indiceEditar == "") {
        // Creacion
        oFacultades.push(oForm);
    } else {
        // Edicion
        oFacultades[indiceEditar] = oForm;
    }

    actualizarTabla();

    fFacu.reset();
    dialogoFacu.hide();
}

function actualizarTabla() {
    // Borrar tabla
    tablaFacu.innerHTML = "";

    // Verificar que no este vacia
    if (oFacultades.length == 0) sinFacu.classList.remove("d-none");
    else sinFacu.classList.add("d-none");

    // Volver a llenar
    oFacultades.forEach((eFacultad, i) => {
        tablaFacu.innerHTML += `
            <tr>
                <td>${eFacultad["nombre"]}</td>
                <td>${eFacultad["direccion"]}</td>
                <td>${eFacultad["codigoPostal"]}</td>
                <td>${eFacultad["telefono"]}</td>
                <td>
                    <div class="btn btn-sm btn-secondary bookia-editar"><i class="fa-solid fa-pencil" aria-hidden="true"></i></div>
                    <div class="btn btn-sm btn-danger bookia-borrar"><i class="fa-solid fa-trash" aria-hidden="true"></i></div>
                </td>
            </tr>
        `;
    });
}
function llenarFormularioFacultad(facultad, idx) {
    document.querySelector("#indice").value = idx;
    document.querySelector("#nombreFacultad").value = facultad.nombre;
    document.querySelector("#direccion").value = facultad.direccion;
    document.querySelector("#codigoPostal").value = facultad.codigoPostal;
    document.querySelector("#telefono").value = facultad.telefono;
}

function clickTabla(eEvent) {
    // Fila
    const indice = eEvent.target.closest("tr").rowIndex - 1;

    // TODO Editar
    if (eEvent.target.closest(".btn.bookia-editar")) {
        // Obtener los datos del objeto en el espacio 'indice'
        const datosFacultad = oFacultades[indice];
        console.log(datosFacultad);

        // Llenar los inputs del formulario
        llenarFormularioFacultad(datosFacultad, indice);

        // Mostrar el modal del formulario
        dialogoFacu.show();
    }

    // Borrar
    if (eEvent.target.closest(".btn.bookia-borrar")) {
        // Quitarlo del objeto
        oFacultades.splice(indice, 1);

        // Actualizar la tabla
        actualizarTabla();
    }
}

function darclick(event) {
    // window.location.href = "login.php";
}
