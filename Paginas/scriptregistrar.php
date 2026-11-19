<?php
require "conexion.php";

$nombre    = $_POST["nombre"];
$genero    = $_POST["genero"];
$jugadores = $_POST["jugadores"];
$duracion  = $_POST["duracion"];

$consulta = "INSERT INTO juegos (nombre, genero, jugadores, duracion)
             VALUES ('$nombre', '$genero', $jugadores, $duracion)";

if (mysqli_query($conexion, $consulta)) {
    header("Location: registrar.php?msj=1");
} else {
    header("Location: registrar.php?error=1");
}