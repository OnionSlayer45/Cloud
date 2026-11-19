<?php
  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  }

  // --- CONEXIÓN Y CONSULTA A LA BASE DE DATOS ---
  // Descomenta y ajusta estas líneas con tus credenciales reales:
  /*
  $conexion = new mysqli("localhost", "root", "", "tu_base_de_datos");
  if ($conexion->connect_error) {
      die("Error de conexión: " . $conexion->connect_error);
  }
  $sql = "SELECT id, titulo, jugadores, duracion, categoria, descripcion, imagen FROM juegos_mesa ORDER BY titulo ASC";
  $resultado = $conexion->query($sql);
  */

  // Datos de ejemplo para visualizar el diseño mientras conectas tu BD
  $juegos_ejemplo = [
    [
      "titulo" => "Catan",
      "jugadores" => "3 - 4 jugadores",
      "duracion" => "60 - 120 min",
      "categoria" => "Estrategia / Comercio",
      "descripcion" => "Coloniza la isla de Catan recolectando recursos, construyendo caminos y negociando con otros jugadores.",
      "imagen" => "https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?auto=format&fit=crop&w=600&q=80"
    ],
    [
      "titulo" => "Carcassonne",
      "jugadores" => "2 - 5 jugadores",
      "duracion" => "30 - 45 min",
      "categoria" => "Colocación de losetas",
      "descripcion" => "Construye un paisaje medieval paso a paso y despliega a tus seguidores como caballeros, monjes o ladrones.",
      "imagen" => "https://images.unsplash.com/photo-1632501641765-e568d28b0015?auto=format&fit=crop&w=600&q=80"
    ],
    [
      "titulo" => "Ticket to Ride",
      "jugadores" => "2 - 5 jugadores",
      "duracion" => "45 - 60 min",
      "categoria" => "Familiar / Rutas",
      "descripcion" => "Reclama rutas ferroviarias a lo largo del mapa para conectar ciudades y cumplir tus boletos de destino.",
      "imagen" => "https://images.unsplash.com/photo-1606503153255-59d8b8b82176?auto=format&fit=crop&w=600&q=80"
    ],
    [
      "titulo" => "Azul",
      "jugadores" => "2 - 4 jugadores",
      "duracion" => "30 - 45 min",
      "categoria" => "Abstracto",
      "descripcion" => "Compite por decorar las paredes del Palacio Real de Évora seleccionando cuidadosamente azulejos de colores.",
      "imagen" => "https://images.unsplash.com/photo-1585504198199-20277593b94f?auto=format&fit=crop&w=600&q=80"
    ]
  ];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mi Ludoteca - Colección de Juegos de Mesa</title>
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

  /* --- BARRA SUPERIOR DE NAVEGACIÓN --- */
  .topbar {
    background: var(--surface);
    border-bottom: 1px solid var(--line);
    padding: 12px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 6px rgba(23,37,47,0.05);
  }
  .nav-acciones {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  .btn-nav {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    color: #fff;
    background: var(--c);
    transition: opacity .15s ease, transform .1s ease;
  }
  .btn-nav:hover { opacity: 0.9; transform: translateY(-1px); }
  .btn-nav span { font-size: 1.1rem; line-height: 1; }

  .alta { --c: var(--alta); }
  .consulta { --c: var(--consulta); }
  .cambio { --c: var(--cambio); }
  .baja { --c: var(--baja); }
  .descarga { --c: var(--descarga); }
  .proceso { --c: var(--proceso); }

  .logout {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    color: var(--baja);
    background: #fdf2f2;
    border: 1px solid #f5c6cb;
    transition: background .15s ease, color .15s ease;
  }
  .logout:hover {
    background: var(--baja);
    color: #fff;
  }

  /* --- ENCABEZADO --- */
  header {
    max-width: 1140px;
    margin: 0 auto;
    padding: 40px 24px 16px;
  }
  h1 {
    font-size: clamp(1.8rem, 4vw, 2.6rem);
    margin: 0 0 6px;
    letter-spacing: -0.02em;
  }
  header p {
    margin: 0;
    color: var(--muted);
    max-width: 60ch;
  }

  /* --- CUADRÍCULA DE COLECCIÓN DE JUEGOS --- */
  main {
    max-width: 1140px;
    margin: 0 auto;
    padding: 20px 24px 64px;
    display: grid;
    gap: 24px;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  }

  .juego-card {
    background: var(--surface);
    border: 1px solid var(--line);
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform .15s ease, box-shadow .15s ease;
  }
  .juego-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 22px rgba(23,37,47,.1);
  }
  .juego-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    background: #dce5eb;
    border-bottom: 1px solid var(--line);
  }
  .juego-body {
    padding: 18px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  .juego-categoria {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--consulta);
    margin-bottom: 4px;
  }
  .juego-titulo {
    margin: 0 0 10px;
    font-size: 1.25rem;
    color: var(--ink);
  }
  .juego-meta {
    display: flex;
    gap: 12px;
    font-size: 0.85rem;
    color: var(--muted);
    margin-bottom: 12px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--bg);
  }
  .juego-desc {
    margin: 0;
    font-size: 0.92rem;
    color: var(--muted);
    flex-grow: 1;
  }
</style>
</head>
<body>

  <!-- BARRA SUPERIOR: Acciones a la izquierda, Cerrar sesión a la derecha -->
  <nav class="topbar" aria-label="Barra de herramientas">
    <div class="nav-acciones">
      <a class="btn-nav alta" href="registrar.php" title="Da de alta un nuevo juego">
        <span aria-hidden="true">+</span> Agregar
      </a>
      <a class="btn-nav consulta" href="buscar.php" title="Busca y revisa los juegos">
        <span aria-hidden="true">?</span> Consultar
      </a>
      <a class="btn-nav cambio" href="actualizar.php" title="Actualiza los datos de un juego">
        <span aria-hidden="true">✎</span> Modificar
      </a>
      <a class="btn-nav baja" href="borrar.php" title="Borra un juego de forma definitiva">
        <span aria-hidden="true">×</span> Eliminar
      </a>
      <a class="btn-nav descarga" href="descargar.php" title="Obtén los archivos disponibles">
        <span aria-hidden="true">↓</span> Descargar
      </a>
      <a class="btn-nav proceso" href="serverless.php" title="Procesar información">
        <span aria-hidden="true">⚙</span> Procesar
      </a>
    </div>

    <a class="logout" href="cerrarsesion.php">Cerrar sesión</a>
  </nav>

  <header>
    <h1>Mi Colección de Juegos de Mesa</h1>
    <p>Catálogo de títulos registrados en la base de datos.</p>
  </header>

  <main>
    <?php
      /* --- BLOQUE PARA USAR CON TU BASE DE DATOS REAL ---
      if ($resultado && $resultado->num_rows > 0) {
        while($juego = $resultado->fetch_assoc()) {
          echo '<article class="juego-card">';
          echo '  <img class="juego-img" src="' . htmlspecialchars($juego["imagen"]) . '" alt="Portada de ' . htmlspecialchars($juego["titulo"]) . '">';
          echo '  <div class="juego-body">';
          echo '    <span class="juego-categoria">' . htmlspecialchars($juego["categoria"]) . '</span>';
          echo '    <h2 class="juego-titulo">' . htmlspecialchars($juego["titulo"]) . '</h2>';
          echo '    <div class="juego-meta">';
          echo '      <span>👥 ' . htmlspecialchars($juego["jugadores"]) . '</span>';
          echo '      <span>⏱ ' . htmlspecialchars($juego["duracion"]) . '</span>';
          echo '    </div>';
          echo '    <p class="juego-desc">' . htmlspecialchars($juego["descripcion"]) . '</p>';
          echo '  </div>';
          echo '</article>';
        }
      } else {
        echo '<p>No hay juegos de mesa registrados en la base de datos todavía.</p>';
      }
      $conexion->close();
      */

      // --- RENDERIZADO DE EJEMPLO (Elimina este foreach cuando actives el bloque de arriba) ---
      foreach ($juegos_ejemplo as $juego): 
    ?>
      <article class="juego-card">
        <img class="juego-img" src="<?= htmlspecialchars($juego['imagen']) ?>" alt="Portada de <?= htmlspecialchars($juego['titulo']) ?>">
        <div class="juego-body">
          <span class="juego-categoria"><?= htmlspecialchars($juego['categoria']) ?></span>
          <h2 class="juego-titulo"><?= htmlspecialchars($juego['titulo']) ?></h2>
          <div class="juego-meta">
            <span>👥 <?= htmlspecialchars($juego['jugadores']) ?></span>
            <span>⏱ <?= htmlspecialchars($juego['duracion']) ?></span>
          </div>
          <p class="juego-desc"><?= htmlspecialchars($juego['descripcion']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
  </main>

</body>
</html>