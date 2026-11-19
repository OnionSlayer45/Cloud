<?php
require "conexion.php";

$nombre = $_POST["nombre"];
$genero = $_POST["genero"];

$consulta = "SELECT * FROM juegos WHERE nombre LIKE '%$nombre%' AND genero LIKE '%$genero%'";
$resultado = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Resultados</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="contenedor">
  <h1>Resultados de la búsqueda</h1>

  <?php if (mysqli_num_rows($resultado) == 0) { ?>
    <p class="mensaje error">No se encontraron juegos.</p>
  <?php } else { ?>
  <div class="tabla-scroll">
  <table>
    <tr>
      <th>Nombre</th><th>Género</th><th>Jugadores</th><th>Duración</th><th>Acciones</th>
    </tr>
    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
    <tr>
      <td><?= $fila["nombre"] ?></td>
      <td><?= $fila["genero"] ?></td>
      <td><?= $fila["jugadores"] ?></td>
      <td><?= $fila["duracion"] ?> min</td>
      <td>
        <form action="formcambios.php" method="post">
          <input type="hidden" name="opcion" value="<?= htmlspecialchars($fila["nombre"]) ?>">
          <button type="submit">Editar</button>
        </form>
        <form action="scriptdelete.php" method="post" onsubmit="return confirm('¿Borrar este juego?');">
          <input type="hidden" name="opcion" value="<?= htmlspecialchars($fila["nombre"]) ?>">
          <button type="submit" class="peligro">Borrar</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
  </div>
  <?php } ?>

  <a class="boton" href="buscar.php">Nueva búsqueda</a>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</div>
</body>
</html>