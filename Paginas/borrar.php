<?php
require "conexion.php";
$resultado = mysqli_query($conexion, "SELECT * FROM juegos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Borrar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<form class="formulario" action="scriptdelete.php" method="post" onsubmit="return confirm('¿Seguro que quieres borrar este juego?');">
  <h1>Borrar juego</h1>

  <?php
  if (isset($_GET["msj"])) {
      echo '<p class="mensaje">Juego borrado con éxito</p>';
  }
  if (isset($_GET["error"])) {
      echo '<p class="mensaje error">Error: ' . htmlspecialchars($_GET["error"]) . '</p>';
  }
  ?>
  <p class="ayuda">Elige un juego de la lista y presiona Borrar.</p>

  <div class="campo">
    <label for="opcion">Juego</label>
    <select id="opcion" name="opcion" required>
      <option value="" disabled selected>Selecciona un juego</option>
      <?php
      while ($registro = mysqli_fetch_array($resultado)) {
          echo '<option value="' . htmlspecialchars($registro["nombre"]) . '">' . $registro["nombre"] . ' - ' . $registro["genero"] . '</option>';
      }
      ?>
    </select>
  </div>

  <button type="submit" class="peligro">Borrar</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>