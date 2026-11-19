<?php
require "conexion.php";
session_start();
if (!isset($_SESSION["logueado"])) {
    header("location:login.php");
    exit();
}

$nombre      = trim($_POST["nombre"]);
$genero      = $_POST["genero"];
$min         = (int)$_POST["jugadores_min"];
$max         = (int)$_POST["jugadores_max"];
$duracion    = (int)$_POST["duracion_promedio"];
$descripcion = trim($_POST["descripcion"]);
$imagen      = trim($_POST["imagen"]);

if ($max < $min) {
    header("Location: registrar.php?error=" . urlencode("El máximo de jugadores no puede ser menor que el mínimo"));
    exit;
}

$stmt = mysqli_prepare($conexion,
    "INSERT INTO juegos (nombre, genero, jugadores_min, jugadores_max, duracion_promedio, descripcion, imagen)
     VALUES (?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssiiiss", $nombre, $genero, $min, $max, $duracion, $descripcion, $imagen);

if (mysqli_stmt_execute($stmt)) {
    header("Location: registrar.php?msj=1");
} else {
    header("Location: registrar.php?error=" . urlencode(mysqli_error($conexion)));
}
exit;