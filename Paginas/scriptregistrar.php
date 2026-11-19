<?php
require "conexion.php";

$nombre    = $_POST["nombre"];
$genero    = $_POST["genero"];
$jugadores = $_POST["jugadores"];
$duracion  = $_POST["duracion"];

$consulta = "INSERT INTO juegos VALUES ('$nombre', '$genero', $jugadores, $duracion)";

if (mysqli_query($conexion, $consulta)) {
    header("Location: registrar.php?msj=1");
}
exit;