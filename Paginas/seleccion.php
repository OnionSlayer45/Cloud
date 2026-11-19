<?php

    session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }
    require "conexion.php";
    $consulta = "select * from tablaprueba;";
    $resultado = mysqli_query($conexion, $consulta);
          
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Formulario</title>
<style>
  :root {
    --fondo: #eef2f6;
    --tarjeta: #ffffff;
    --texto: #1c2b39;
    --suave: #5b6b7a;
    --borde: #c5d0db;
    --acento: #1f6f8b;
    --acento-oscuro: #17556b;
    --peligro: #b3392f;
    --peligro-oscuro: #8f2c24;
    --exito: #1e7a46;
  }

  * { box-sizing: border-box; }

  body {
    margin: 0;
    min-height: 100vh;
    display: grid;
    place-items: center;
    padding: 1rem;
    background: var(--fondo);
    color: var(--texto);
    font-family: "Segoe UI", system-ui, -apple-system, Arial, sans-serif;
  }

  form {
    width: 100%;
    max-width: 420px;
    background: var(--tarjeta);
    border: 1px solid var(--borde);
    border-radius: 10px;
    padding: 2rem;
  }

  h1 {
    margin: 0 0 .25rem;
    font-size: 1.4rem;
  }

  p {
    margin: 0 0 1.5rem;
    color: var(--suave);
    font-size: .95rem;
  }

  label {
    display: block;
    margin-bottom: .4rem;
    font-weight: 600;
  }

  select {
    width: 100%;
    padding: .7rem .8rem;
    font-size: 1rem;
    color: var(--texto);
    background: #fff;
    border: 1px solid var(--borde);
    border-radius: 6px;
    margin-bottom: 1.5rem;
  }

  select:focus,
  button:focus-visible {
    outline: 3px solid rgba(31, 111, 139, .35);
    outline-offset: 1px;
    border-color: var(--acento);
  }

  .acciones {
    display: flex;
    gap: .75rem;
  }

  button {
    flex: 1;
    padding: .8rem;
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    background: var(--acento);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background .15s;
  }

  button:hover { background: var(--acento-oscuro); }
  button:active { transform: translateY(1px); }

  button.borrar { background: var(--peligro); }
  button.borrar:hover { background: var(--peligro-oscuro); }

  .mensaje {
    margin: 1rem 0 0;
    color: var(--exito);
    font-weight: 600;
  }
</style>
</head>
<body>

<form method="post">
  <h1>Administrar registros</h1>
  <p>Elige una opción de la lista y presiona Cambiar o Borrar.</p>

  <label for="opcion">Opción</label>
  <select id="opcion" name="opcion" required>
    <option value="" disabled selected>Selecciona una opción</option>
      <?php
          while($registro = mysqli_fetch_array($resultado)){
              echo '<option value="'.$registro["matricula"].'">'.$registro["matricula"]." - ".$registro["nombre"].'</option>';
          }

      ?>
  </select>

  <div class="acciones">
    <!-- Cada botón envía el mismo formulario a un destino distinto -->
    <button type="submit" formaction="formcambios.php">Cambiar</button>
    <button type="submit" formaction="scriptdelete.php" class="borrar">Borrar</button>
  </div>

  <?php
      if(isset($_GET["msj"])){
        echo '<p class="mensaje">Registro borrado con éxito</p>';
      }
  ?>
</form>

</body>
</html>