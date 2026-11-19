
<?php
require "conexion.php";

    // atrapamos info del formulario
    $nombre = $_POST["nombre"];
    // iniciamos la conexión
    // los parámetros son: 
    // IP de la BD, Usuario, Pass, Nombre de la BD
    $conexion = mysqli_connect("localhost", "root", "root", "basedatosclase");
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = "select * from tablaprueba where nombre like '%{$nombre}%';";
    $resultado = mysqli_query($conexion, $consulta);
          
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Resultados</title>
<style>
  :root {
    --fondo: #eef2f6;
    --tarjeta: #ffffff;
    --texto: #1c2b39;
    --suave: #5b6b7a;
    --borde: #c5d0db;
    --acento: #1f6f8b;
    --acento-oscuro: #17556b;
    --fila-alterna: #f5f8fb;
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

  .contenedor {
    width: 100%;
    max-width: 800px;
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

  .tabla-scroll {
    overflow-x: auto;
    border: 1px solid var(--borde);
    border-radius: 6px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: .95rem;
  }

  th, td {
    padding: .7rem .9rem;
    text-align: left;
  }

  thead th {
    background: var(--acento);
    color: #fff;
    font-weight: 600;
    white-space: nowrap;
  }

  tbody td {
    border-top: 1px solid var(--borde);
  }

  tbody tr:nth-child(even) {
    background: var(--fila-alterna);
  }

  tbody tr:hover {
    background: #e3eef4;
  }
</style>
</head>
<body>

<div class="contenedor">
  <h1>Resultados de la consulta</h1>
  <p>Registros obtenidos de la base de datos.</p>

  <div class="tabla-scroll">
    <table>
      <thead>
        <tr>
          <th>Matrícula</th>
          <th>Nombre</th>
          <th>Edad</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($registro = mysqli_fetch_array($resultado)){
              echo "<tr>";
              echo "<td>".$registro["matricula"]."</td>";
              echo "<td>".$registro["nombre"]."</td>";
              echo "<td>".$registro["edad"]."</td>";
              echo "</tr>";
          }

        ?>
        
      </tbody>
    </table>
  </div>
</div>

</body>

</html>