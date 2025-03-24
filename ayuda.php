<?php
session_start();

require "utils.php";
verificarSesion();

?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">
<?php echo generarEncabezado('Ayuda'); ?>
    
    <body>
        <!-- Barra Superior -->
        <?php echo generarBarraNav(); ?>
        <!-- Contenido -->
        <div class="container-md mt-2">
            <!-- Empieza aqui -->
            <!--un acordeon-->
            <h5>Preguntas frecuentes</h5>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne"
                            aria-expanded="false"
                            aria-controls="flush-collapseOne"
                        >
                            Porque necesito crear una Cuenta para poder
                            solicitar Libros Fisicos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseOne"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            Para garantizar una gestión segura y eficiente del
                            préstamo, es necesario crear una cuenta. Esto
                            permite identificar al solicitante, registrar los
                            libros prestados, enviar notificaciones y facilitar
                            el historial de solicitudes.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo"
                            aria-expanded="false"
                            aria-controls="flush-collapseTwo"
                        >
                            Con que formatos de libros Electronicos contamos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseTwo"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            EPUB (Formato estandar y mas utilizado para e-books)
                            <br />MOBI (Compatible con dispositivos Kindle)
                            <br />AZW (Formato exclusivo de Amazon para Kindle)
                            <br />PDF ( Compatible con casi cualquier
                            dispositivo PC, móviles, e-readers) <br />TXT
                            (Comopatible con todos los dispositivos) <br />CBZ
                            (Compatibilidad con lectores de cómics digitales
                            como CDisplayEx, ComicRack, YACReader y Perfect
                            Viewer) <br />CBR (Esencialmente unn archivo RAR
                            Compatible con lectores de cómics digitales como
                            CDisplayEx, ComicRack, YACReader y Perfect Viewer)
                            <br />HTML (Compatible con todos los navegadores )
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree"
                            aria-expanded="false"
                            aria-controls="flush-collapseThree"
                        >
                            Como puedo descargar los Libros Electrónicos?
                        </button>
                    </h2>
                    <div
                        id="flush-collapseThree"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            1. Seleccionar el libro de interes. <br />2.
                            Verificar la informacion del Libro <br />3.
                            Seleccionar el formato en el cual desea descargarlo
                            <br />4.Descargar
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-terminos"
                            aria-expanded="false"
                            aria-controls="flush-terminos"
                        >
                            Terminos y condiciones
                        </button>
                    </h2>
                    <div
                        id="flush-terminos"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            1. Registro: El usuario debe registrarse con datos
                            reales y es responsable de su cuenta.

                            <br />2. Uso de Recursos: Los libros digitales
                            pueden leerse o descargarse según disponibilidad.
                            Los libros físicos están sujetos a préstamo según
                            las normas.

                            <br />3. Propiedad Intelectual: No se permite
                            copiar, distribuir o modificar el contenido sin
                            autorización.

                            <br />4. Conducta del Usuario: Se prohíbe el uso
                            indebido de la plataforma y cualquier actividad
                            ilícita.

                            <br />5. Sanciones: El incumplimiento de estas
                            normas puede llevar a la suspensión de la cuenta.

                            <br />6. Modificaciones: Nos reservamos el derecho
                            de actualizar estos términos en cualquier momento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#flush-contacto"
                            aria-expanded="false"
                            aria-controls="flush-contacto"
                        >
                            Contacto
                        </button>
                    </h2>
                    <div
                        id="flush-contacto"
                        class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample"
                    >
                        <div class="accordion-body">
                            administrador@Universidad.com
                        </div>
                    </div>
                </div>
            </div>
            <!--termina acordeon-->
        </div>

        <?php echo generarFooter(); ?>
    </body>
</html>
