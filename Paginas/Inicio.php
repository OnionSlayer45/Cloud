<?php
  //if(isset($_COOKIE["usuario"])){
  //header("Location: auth.php");
  //}

  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
  }
    
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestión de registros</title>
<style>
  :root {
    --bg: #eef3f6;
    --surface: #ffffff;
    --ink: #17252f;
    --muted: #5a6b76;
    --line: #cfdbe2;
    --alta: #1f7a5a;
    --consulta: #1d5fa8;
    --cambio: #b7791f;
    --baja: #b3382c;
    --descarga: #5b4aa0;
    --proceso: #0f7480;
  }
  * { box-sizing: border-box; }
  body {
    margin: 0;
    font-family: "Trebuchet MS", "Segoe UI", Tahoma, sans-serif;
    background: var(--bg);
    color: var(--ink);
    line-height: 1.5;
  }
  header { max-width: 960px; margin: 0 auto; padding: 56px 24px 24px; }
  h1 { font-size: clamp(2rem, 5vw, 3rem); margin: 0 0 8px; letter-spacing: -0.02em; }
  header p { margin: 0; color: var(--muted); max-width: 56ch; }
  main {
    max-width: 960px; margin: 0 auto; padding: 24px 24px 64px;
    display: grid; gap: 16px;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
  }
  a.opcion {
    display: block; text-decoration: none; color: inherit;
    background: var(--surface);
    border: 1px solid var(--line);
    border-left: 8px solid var(--c);
    border-radius: 6px;
    padding: 22px 22px 22px 20px;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  a.opcion:hover { transform: translateY(-3px); box-shadow: 0 8px 18px rgba(23,37,47,.12); }
  a.opcion:focus-visible { outline: 3px solid var(--c); outline-offset: 3px; }
  .icono { font-size: 1.8rem; line-height: 1; margin-bottom: 10px; color: var(--c); font-weight: 700; }
  h2 { margin: 0 0 4px; font-size: 1.2rem; color: var(--c); }
  a.opcion p { margin: 0; color: var(--muted); font-size: .95rem; }
  .alta { --c: var(--alta); } .consulta { --c: var(--consulta); } .cambio { --c: var(--cambio); }
  .baja { --c: var(--baja); } .descarga { --c: var(--descarga); } .proceso { --c: var(--proceso); }
  @media (prefers-reduced-motion: reduce) { a.opcion { transition: none; } a.opcion:hover { transform: none; } }
</style>
</head>
<body>
<header>
  <h1>Gestión de registros</h1>
  <p>Elige qué quieres hacer con tus datos.</p>
</header>

<main>
  <!-- Cambia cada href por la ruta real de tu página -->
  <a class="opcion alta" href="registrar.php">
    <div class="icono" aria-hidden="true">+</div>
    <h2>Agregar registro</h2>
    <p>Da de alta un nuevo registro.</p>
  </a>
  <a class="opcion consulta" href="buscar.php">
    <div class="icono" aria-hidden="true">?</div>
    <h2>Consultar registros</h2>
    <p>Busca y revisa los registros existentes.</p>
  </a>
  <a class="opcion cambio" href="actualizar.php">
    <div class="icono" aria-hidden="true">✎</div>
    <h2>Modificar registro</h2>
    <p>Actualiza los datos de un registro.</p>
  </a>
  <a class="opcion baja" href="borrar.php">
    <div class="icono" aria-hidden="true">×</div>
    <h2>Eliminar registro</h2>
    <p>Borra un registro de forma definitiva.</p>
  </a>
  <a class="opcion descarga" href="descargar.php">
    <div class="icono" aria-hidden="true">↓</div>
    <h2>Descargar archivos</h2>
    <p>Obtén los archivos disponibles.</p>
  </a>
  <a class="opcion proceso" href="serverless.php">
    <div class="icono" aria-hidden="true">⚙</div>
    <h2>Procesar información</h2>
    <p>Envía datos a un formulario para procesarlos.</p>
  </a>
</main>
</body>
</html>