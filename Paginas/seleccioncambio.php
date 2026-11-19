
<?php

    session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }
    require "infoconexion.php";
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
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

  button {
    width: 100%;
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
</style>
</head>
<body>

<form action="formcambios.php" method="post">
  <h1>Cambiar datos del registro</h1>
  <p>Elige una opción de la lista y presiona Cambiar.</p>

  <label for="opcion">Opción</label>
  <select id="opcion" name="opcion" required>
    <option value="" disabled selected>Selecciona una opción</option>
      <?php
          while($registro = mysqli_fetch_array($resultado)){
              echo '<option value="'.$registro["matricula"].'">'.$registro["matricula"]." - ".$registro["nombre"].'</option>';
          }

      ?>
  </select>

  <button type="submit">Cambiar</button>
</form>

</body>
</html>