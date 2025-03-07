<?php
// Host
$host = "localhost";
// Usuario
$user = "root";
// Contraseña
$password = "";
// Base de Datos
$bdd = "biblioteca";

// Intentar conexion
$connection;
try {
    $connection = new PDO("mysql:host=" . $host . ";dbname=" . $bdd, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    exit("Error: " . $e->getMessage());
}

?>
