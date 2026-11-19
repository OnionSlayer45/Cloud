<?php
require "conexion.php";
 session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }

$nombre = $_POST["opcion"];

if (mysqli_query($conexion, "DELETE FROM juegos WHERE nombre = '$nombre'")) {
    header("Location: borrar.php?msj=1");
}
exit;