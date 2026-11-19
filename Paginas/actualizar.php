<?php
 session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }
require "conexion.php";
$resultado = mysqli_query($conexion, "SELECT * FROM juegos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Actualizar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<form class="formulario" action="formcambios.php" method="post">
  <h1>Cambiar datos de un juego</h1>

  <?php
  if (isset($_GET["msj"])) {
      echo '<p class="mensaje">Juego actualizado con éxito</p>';
  }
  if (isset($_GET["error"])) {
      echo '<p class="mensaje error">Error: ' . htmlspecialchars($_GET["error"]) . '</p>';
  }
  ?>
  <p class="ayuda">Elige un juego de la lista y presiona Cambiar.</p>

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

  <button type="submit">Cambiar</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>