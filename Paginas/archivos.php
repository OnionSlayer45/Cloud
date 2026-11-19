<?php
session_start();
if (!isset($_SESSION["logueado"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";

// Debe ser la misma carpeta que usa descargar.php
$carpeta = "/var/www/pdfs";

// ---- Leer los PDFs de la carpeta ----
$archivos = [];
$base = realpath($carpeta);

if ($base !== false) {
    foreach (scandir($base) as $nombre) {
        $ruta = $base . DIRECTORY_SEPARATOR . $nombre;

        if (is_file($ruta) && strtolower(pathinfo($nombre, PATHINFO_EXTENSION)) === "pdf") {
            $archivos[] = [
                "nombre" => $nombre,
                "tamano" => filesize($ruta),
                "fecha"  => filemtime($ruta),
            ];
        }
    }
}

// Más recientes primero
usort($archivos, fn($a, $b) => $b["fecha"] <=> $a["fecha"]);

function formatearTamano(int $bytes): string
{
    if ($bytes >= 1048576) return number_format($bytes / 1048576, 1) . " MB";
    if ($bytes >= 1024)    return number_format($bytes / 1024, 0) . " KB";
    return $bytes . " B";
}

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Descargar PDF</title>
  <style>
    :root {
      --fondo: #f5f6f8;
      --superficie: #ffffff;
      --texto: #1c2430;
      --suave: #5d6878;
      --linea: #dde1e8;
      --acento: #1f5fbf;
      --acento-hover: #174a96;
    }
    @media (prefers-color-scheme: dark) {
      :root {
        --fondo: #14181f;
        --superficie: #1c222c;
        --texto: #e8ebf0;
        --suave: #9aa5b5;
        --linea: #2d3542;
        --acento: #6aa2f0;
        --acento-hover: #8bb8f5;
      }
    }
    * { box-sizing: border-box; }
    body {
      margin: 0;
      padding: 2rem 1rem;
      background: var(--fondo);
      color: var(--texto);
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      line-height: 1.5;
    }
    main { max-width: 46rem; margin: 0 auto; }
    h1 { font-size: 1.5rem; margin: 0 0 .25rem; }
    .subtitulo { margin: 0 0 1.5rem; color: var(--suave); }
    #buscar {
      width: 100%;
      padding: .65rem .8rem;
      margin-bottom: 1rem;
      font: inherit;
      color: var(--texto);
      background: var(--superficie);
      border: 1px solid var(--linea);
      border-radius: 6px;
    }
    #buscar:focus-visible, .descargar:focus-visible {
      outline: 3px solid var(--acento);
      outline-offset: 2px;
    }
    ul { list-style: none; margin: 0; padding: 0;
         background: var(--superficie); border: 1px solid var(--linea); border-radius: 6px; }
    li { display: flex; align-items: center; gap: 1rem; padding: .85rem 1rem;
         border-bottom: 1px solid var(--linea); }
    li:last-child { border-bottom: 0; }
    .info { flex: 1; min-width: 0; }
    .nombre { font-weight: 600; overflow-wrap: anywhere; }
    .detalle { font-size: .875rem; color: var(--suave); }
    .descargar {
      flex-shrink: 0;
      padding: .5rem 1rem;
      color: #fff;
      background: var(--acento);
      border-radius: 6px;
      text-decoration: none;
      font-weight: 600;
    }
    @media (prefers-color-scheme: dark) { .descargar { color: #0d1117; } }
    .descargar:hover { background: var(--acento-hover); }
    .vacio { padding: 1.5rem 1rem; color: var(--suave); }
    .error { margin: 0 0 1rem; padding: .75rem 1rem; border: 1px solid #c0392b;
             border-radius: 6px; color: #c0392b; background: var(--superficie); }
    @media (max-width: 30rem) {
      li { flex-direction: column; align-items: stretch; }
      .descargar { text-align: center; }
    }
  </style>
</head>
<body>
  <main>
    <h1>Archivos PDF disponibles</h1>
    <p class="subtitulo">Elige el archivo que quieres descargar.</p>

    <?php if (isset($_GET["error"])): ?>
      <p class="error" role="alert">No se encontró el archivo solicitado. Elige otro de la lista.</p>
    <?php endif; ?>

    <?php if (count($archivos) === 0): ?>
      <p class="vacio">No hay archivos PDF disponibles por ahora.</p>
    <?php else: ?>
      <input type="search" id="buscar" placeholder="Buscar por nombre" aria-label="Buscar por nombre">

      <ul id="lista">
        <?php foreach ($archivos as $a): ?>
          <li data-nombre="<?= e(mb_strtolower($a["nombre"])) ?>">
            <div class="info">
              <div class="nombre"><?= e($a["nombre"]) ?></div>
              <div class="detalle">
                <?= e(formatearTamano($a["tamano"])) ?>, modificado el <?= date("d/m/Y", $a["fecha"]) ?>
              </div>
            </div>
            <a class="descargar"
               href="descargar.php?archivo=<?= urlencode($a["nombre"]) ?>"
               aria-label="Descargar <?= e($a["nombre"]) ?>">Descargar</a>
          </li>
        <?php endforeach; ?>
      </ul>
      <p class="vacio" id="sin-resultados" hidden>Ningún archivo coincide con la búsqueda.</p>
    <?php endif; ?>
  </main>

  <script>
    const buscar = document.getElementById("buscar");
    if (buscar) {
      const filas = document.querySelectorAll("#lista li");
      const aviso = document.getElementById("sin-resultados");
      buscar.addEventListener("input", () => {
        const q = buscar.value.trim().toLowerCase();
        let visibles = 0;
        filas.forEach(li => {
          const coincide = li.dataset.nombre.includes(q);
          li.hidden = !coincide;
          if (coincide) visibles++;
        });
        aviso.hidden = visibles > 0;
      });
    }
  </script>
</body>
</html>