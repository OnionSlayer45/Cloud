<?php require "generos.php"; 
 session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buscar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<form class="formulario" action="resultadotabla.php" method="post">
  <h1>Buscar juego de mesa</h1>
  <p class="ayuda">Deja los campos vacíos para ver todos los juegos.</p>

  <div class="campo">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre">
  </div>

  <div class="campo">
    <label for="genero">Género</label>
    <select id="genero" name="genero">
      <option value="">Todos los géneros</option>
      <?php foreach ($GENEROS as $g) { echo "<option>$g</option>"; } ?>
    </select>
  </div>

  <button type="submit">Buscar</button>
  <a class="boton secundario" href="Inicio.php">Inicio</a>
</form>
</body>
</html>