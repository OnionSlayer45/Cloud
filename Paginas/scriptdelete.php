<?php
require "conexion.php";

$nombre = $_POST["opcion"];

if (mysqli_query($conexion, "DELETE FROM juegos WHERE nombre = '$nombre'")) {
    header("Location: borrar.php?msj=1");
}
exit;