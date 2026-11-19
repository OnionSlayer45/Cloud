<?php
require "conexion.php";
require "generos.php";
session_start();
if (!isset($_SESSION["logueado"])) {
    header("location:login.php");
    exit();
}

$original = $_POST["opcion"];
$stmt = mysqli_prepare($conexion, "SELECT * FROM juegos WHERE nombre = ?");
mysqli_stmt_bind_param($stmt, "s", $original);
mysqli_stmt_execute($stmt);
$juego = mysqli_fetch_array(mysqli_stmt_get_result($stmt));
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
          echo "<option $sel>" . htmlspecialchars($g) . "</option>";
      }
      ?>
    </select>
  </div>

  <div class="campo">
    <label for="jugadores_min">Jugadores mínimos</label>
    <input type="number" id="jugadores_min" name="jugadores_min" min="1" value="<?= (int)$juego["jugadores_min"] ?>" required>
  </div>

  <div class="campo">
    <label for="jugadores_max">Jugadores máximos</label>
    <input type="number" id="jugadores_max" name="jugadores_max" min="1" value="<?= (int)$juego["jugadores_max"] ?>" required>
  </div>

  <div class="campo">
    <label for="duracion_promedio">Duración promedio (minutos)</label>
    <input type="number" id="duracion_promedio" name="duracion_promedio" min="1" value="<?= (int)$juego["duracion_promedio"] ?>" required>
  </div>

  <div class="campo">
    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="descripcion" rows="4"><?= htmlspecialchars($juego["descripcion"]) ?></textarea>
  </div>

  <div class="campo">
    <label for="imagen">Imagen (URL)</label>
    <input type="url" id="imagen" name="imagen" value="<?= htmlspecialchars($juego["imagen"]) ?>">
  </div>

  <button type="submit">Guardar cambios</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>