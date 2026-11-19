<?php
require "conexion.php";
session_start();
if (!isset($_SESSION["logueado"])) {
    header("location:login.php");
    exit();
}

$original    = $_POST["original"];
$nombre      = trim($_POST["nombre"]);
$genero      = $_POST["genero"];
$min         = (int)$_POST["jugadores_min"];
$max         = (int)$_POST["jugadores_max"];
$duracion    = (int)$_POST["duracion_promedio"];
$descripcion = trim($_POST["descripcion"]);
$imagen      = trim($_POST["imagen"]);

if ($max < $min) {
    header("Location: actualizar.php?error=" . urlencode("El máximo de jugadores no puede ser menor que el mínimo"));
    exit;
}

$stmt = mysqli_prepare($conexion,
    "UPDATE juegos
     SET nombre = ?, genero = ?, jugadores_min = ?, jugadores_max = ?,
         duracion_promedio = ?, descripcion = ?, imagen = ?
     WHERE nombre = ?");
mysqli_stmt_bind_param($stmt, "ssiiisss", $nombre, $genero, $min, $max, $duracion, $descripcion, $imagen, $original);

if (mysqli_stmt_execute($stmt)) {
    header("Location: actualizar.php?msj=1");
} else {
    header("Location: actualizar.php?error=" . urlencode(mysqli_error($conexion)));
}
exit;