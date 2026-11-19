<?php require "generos.php"; 
 session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<form class="formulario" action="scriptregistrar.php" method="post">
  <h1>Registrar juego de mesa</h1>

  <?php
  if (isset($_GET["msj"])) {
      echo '<p class="mensaje">Juego registrado con éxito</p>';
  }
  if (isset($_GET["error"])) {
      echo '<p class="mensaje error">Error: ' . htmlspecialchars($_GET["error"]) . '</p>';
  }
  ?>

  <div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" required>
  </div>

  <div class="campo">
    <label for="genero">Género</label>
    <select id="genero" name="genero" required>
      <option value="" disabled selected>Selecciona un género</option>
      <?php foreach ($GENEROS as $g) { echo "<option>$g</option>"; } ?>
    </select>
  </div>

  <div class="campo">
    <label for="jugadores">Cantidad de jugadores</label>
    <input type="number" id="jugadores" name="jugadores" min="1" required>
  </div>

  <div class="campo">
    <label for="duracion">Duración de la partida (minutos)</label>
    <input type="number" id="duracion" name="duracion" min="1" required>
  </div>

  <button type="submit">Registrar</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>