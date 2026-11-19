<?php
require "conexion.php";
require "generos.php";
 session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }

$original  = $_POST["opcion"];
$resultado = mysqli_query($conexion, "SELECT * FROM juegos WHERE nombre = '$original'");
$juego     = mysqli_fetch_array($resultado);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<form class="formulario" action="scriptactualizar.php" method="post">
  <h1>Editar juego</h1>

  <input type="hidden" name="original" value="<?= htmlspecialchars($juego["nombre"]) ?>">

  <div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($juego["nombre"]) ?>" required>
  </div>

  <div class="campo">
    <label for="genero">Género</label>
    <select id="genero" name="genero" required>
      <?php
      foreach ($GENEROS as $g) {
          $sel = ($g == $juego["genero"]) ? "selected" : "";
          echo "<option $sel>$g</option>";
      }
      ?>
    </select>
  </div>

  <div class="campo">
    <label for="jugadores">Cantidad de jugadores</label>
    <input type="number" id="jugadores" name="jugadores" min="1" value="<?= $juego["jugadores"] ?>" required>
  </div>

  <div class="campo">
    <label for="duracion">Duración de la partida (minutos)</label>
    <input type="number" id="duracion" name="duracion" min="1" value="<?= $juego["duracion"] ?>" required>
  </div>

  <button type="submit">Guardar cambios</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>