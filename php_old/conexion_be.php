<?php


$conexion = mysqli_connect("localhost","root", "","biblioteca" );

if($conexion){
    echo 'Conectado exitosamente a la Base de Datos';
}else{
    echo 'No se ha podido conectar a la Base de Datos';
}
, 
?>
