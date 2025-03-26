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

formulario.addEventListener("submit", e => handleSubmit(e));

function handleSubmit(event) {
    // Previene que la página se recargue
    event.preventDefault();

    
    console.log("EXITO")
}
