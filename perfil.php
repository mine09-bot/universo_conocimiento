<?php
session_start();
require "utils.php";
require "config.php";
verificarSesion();


$idUsuario = $_SESSION['idUsuario'];
$stmt = $connection->prepare("SELECT foto FROM usuario WHERE idUsuario = :id");
$stmt->execute([':id' => $idUsuario]);
$foto = $stmt->fetchColumn();
$idUsuario = $_SESSION['idUsuario'];

$instruccion = "SELECT
                    usuario.idFacultad,
                    usuario.pais,
                    usuario.foto,
                    usuario.linkedIn,
                    usuario.facebook,
                    facultades.nombreFacultad,
                    pais.nombrePais,
                    universidad.nombreUniversidad,
                    universidad.logoUni
                FROM usuario 
                LEFT JOIN facultades  ON usuario.idFacultad = facultades.idFacultades
                LEFT JOIN pais  ON usuario.pais = pais.idPais
                LEFT JOIN universidad  ON facultades.idUniversidad = universidad.idUniversidad
                WHERE usuario.idUsuario = :idUsuario
";

$query = $connection->prepare($instruccion);
$query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$query->execute();
$respuesta = $query->fetch(PDO::FETCH_ASSOC); // solo uno

$nomfacu = $respuesta['nombreFacultad'] ?? 'Sin facultad';
$nompais = $respuesta['nombrePais'] ?? 'Sin país';
$nomUni = $respuesta['nombreUniversidad'] ?? 'Sin universidad';
$foto = $respuesta['foto'];
$logo = $respuesta['logoUni'];
$linked = $respuesta['linkedIn'];
$face = $respuesta['facebook'];


$sqlLibros = "SELECT COUNT(*) AS total FROM subidas WHERE Usuario_idUsuario = :idUsuario";
$Libros = $connection->prepare($sqlLibros);
$Libros->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$Libros->execute();
$librosSubidos = $Libros->fetch(PDO::FETCH_ASSOC)['total'];


$sqlVisitas = "SELECT visitas FROM usuario WHERE idUsuario = :idUsuario";
$Libros = $connection->prepare($sqlVisitas);
$Libros->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$Libros->execute();
$consultas = $Libros->fetch(PDO::FETCH_ASSOC)['visitas'];




?>
<!DOCTYPE html>
<html lang="es-MX" data-bs-theme="dark">

<head>
    <?php echo generarEncabezado('Perfil'); ?>

</head>

<body>
    <div class="container-fluid" style="height: 100vh" id="main-container">
        <div class="row d-flex flex-nowrap" style="min-height: 100vh">
            <div class="col p-0 d-flex flex-column">
                <!-- Barra Superior -->
                <?php echo generarBarraNav(); ?>
                <!-- Contenido -->
                <div class="container-sm flex-grow-1 mt-lg-4">
                    <div class="row">
                        <div class="col-12 gap-3">
                            <!-- Comienza aquí -->
                            <div class="d-grid gap-1">
                                <div class="mb-4 border-bottom border-primary d-flex justify-content-between">
                                    <span class="h4 m-0">Información personal</span>
                                    <a class="btn btn-dark icon-link" href="editorperfil.php">
                                        Editar
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>

                                <div class="container mt-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="col-auto mb-3">
                                            <img src="uploads/perfil/<?php echo $foto; ?>" alt="Foto de perfil" class="img-fluid rounded-circle shadow"
                                                style="width: 150px; height: 150px;
                                                                 object-fit: cover;">
                                        </div>
                                        <div class="col">
                                            <h2 class="m-0">
                                                <?php echo $_SESSION['nombre'] . ' ' . $_SESSION['apellidoPaterno'] . ' ' . $_SESSION['apellidoMaterno']; ?>
                                            </h2>
                                            <h5 class="mb-1 card-subtitle text-body-secondary"><?php echo $nomfacu; ?></h5>
                                            <p class="card-subtitle m-0 text-body-secondary"><span class="fi fi-mx me-2 rounded-1"></span></span><?php echo $nompais; ?></p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a class="btn" href="<?php echo $linked; ?>" role="button">
                                                <i class="fa-brands fa-linkedin" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn" href="mailto:<?php echo $_SESSION['correoElectronico'] ?>" role="button">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                            <a class="btn" href="<?php echo $face; ?>" role="button">
                                                <i class="fa-brands fa-facebook" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div class="btn btn-dark icon-link mb-3" style="transform: rotate(0);">
                                            <img src="uploads/universidad/<?php echo $logo; ?>" alt="Foto de perfil" class="img fluid rounded"
                                                style="width: 1.5rem; height: 1.5rem;">
                                            <?php echo $nomUni; ?>
                                            <a class="stretched-link" href="https://www.buap.mx"></a>
                                        </div>
                                        <div class="mt-3 row gap-4">
                                            <div class="col-auto card p-3">
                                                <span class="fs-4">
                                                    <i class="fa-solid fa-upload text-primary"></i>
                                                    <?php echo $librosSubidos; ?></span>
                                                <span class="mb-2"><strong>Libros Subidos</strong></span>
                                            </div>
                                            <div class="col-auto card p-3">
                                                <span class="fs-4">
                                                    <i class="fa-solid fa-eye text-primary"></i>
                                                    <?php echo $consultas; ?></span>
                                                <span class="mb-2"><strong>Libros Consultados</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- contenedor-->
                        </div>
                    </div>

                </div>

                <?php echo generarFooter(); ?>
            </div>
        </div>
</body>

</html>