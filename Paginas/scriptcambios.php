<?php
  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit;
  }

  require "conexion.php";
  require "juegos_lib.php";

  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      header("Location: actualizar.php");
      exit;
  }

  $id = (int)($_POST["id"] ?? 0);
  [$d, $errores] = validar_juego($_POST);

  if (!$errores) {
      $st = $conexion->prepare("UPDATE juegos SET nombre=?, duracion=?, jugadores_min=?, jugadores_max=?, generos=? WHERE id=?");
      $st->bind_param("siiisi", $d["nombre"], $d["duracion"], $d["jugadores_min"], $d["jugadores_max"], $d["generos"], $id);
      if ($st->execute()) {
          header("Location: actualizar.php?msj=1");
          exit;
      }
      $errores[] = "No se pudo actualizar el juego.";
  }

  // Hubo errores: volvemos al formulario conservando lo que se escribió
  $_SESSION["flash_juego"] = ["id" => $id, "errores" => $errores, "valores" => $d];
  header("Location: formcambios.php?id=" . $id);
  exit;