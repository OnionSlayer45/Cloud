<?php
require "conexion.php";
session_start();
if (!isset($_SESSION["logueado"])) {
    header("location:login.php");
    exit();
}

$nombre = "%" . $_POST["nombre"] . "%";
$genero = "%" . $_POST["genero"] . "%";
$stmt = mysqli_prepare($conexion, "SELECT * FROM juegos WHERE nombre LIKE ? AND genero LIKE ?");
mysqli_stmt_bind_param($stmt, "ss", $nombre, $genero);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
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
      <th>Nombre</th><th>Género</th><th>Jugadores</th><th>Duración</th><th>Descripción</th><th>Imagen</th><th>Acciones</th>
    </tr>
    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
    <tr>
      <td><?= htmlspecialchars($fila["nombre"]) ?></td>
      <td><?= htmlspecialchars($fila["genero"]) ?></td>
      <td><?= (int)$fila["jugadores_min"] ?>–<?= (int)$fila["jugadores_max"] ?></td>
      <td><?= (int)$fila["duracion_promedio"] ?> min</td>
      <td><?= htmlspecialchars($fila["descripcion"]) ?></td>
      <td>
        <?php if (!empty($fila["imagen"]) && preg_match('#^https?://#i', $fila["imagen"])) { ?>
          <a href="<?= htmlspecialchars($fila["imagen"]) ?>" target="_blank" rel="noopener">Ver</a>
        <?php } ?>
      </td>
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