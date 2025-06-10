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
fUni.addEventListener("submit", (e) => guardarUni(e));
fFacu.addEventListener("submit", (e) => guardarFacu(e));

async function guardarUni(event) {
    // Previene que la página se recargue
    event.preventDefault();

    dialogoCarga.classList.remove("d-none");

    return;
    // Empaquetar
    const paquete = new FormData(formulario);

    const opciones = {
        method: "post",
        body: paquete,
    };

    // Enviar
    fetch("api/agregafacu.php", opciones)
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

async function guardarFacu(event) {
    // Previene que la página se recargue
    event.preventDefault();

    // Empaquetar
    const paquete = new FormData(fFacu);

    console.log(paquete);

    tablaFacu.innerHTML += `
        <tr>
            <td>${paquete.get("nombreFacultad")}</td>
            <td>${paquete.get("direccion")}</td>
            <td>${paquete.get("codigoPostal")}</td>
            <td>${paquete.get("telefono")}</td>
            <td>
                <div class="btn btn-sm btn-secondary"><i class="fa-solid fa-pencil" aria-hidden="true"></i></div>
                <div class="btn btn-sm btn-danger"><i class="fa-solid fa-trash" aria-hidden="true"></i></div>
            </td>
        </tr>
    `;

    sinFacu.classList.add("d-none");

    dialogoFacu.hide();
}

function darclick(event) {
    window.location.href = "login.php";
}
