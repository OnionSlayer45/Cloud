<?php
require "conexion.php";

$original  = $_POST["original"];
$nombre    = $_POST["nombre"];
$genero    = $_POST["genero"];
$jugadores = $_POST["jugadores"];
$duracion  = $_POST["duracion"];

$consulta = "UPDATE juegos SET nombre = '$nombre', genero = '$genero',
             jugadores = $jugadores, duracion = $duracion
             WHERE nombre = '$original'";

if(mysqli_query($conexion, $consulta)) {
    header("Location: actualizar.php?msj=1");
}

exit;