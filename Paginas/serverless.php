<?php require "generos.php";
  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
    exit();
  } ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Recomendar juego</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="formulario">
  <form id="formulario">
    <h1>¿A qué jugamos?</h1>
    <p class="ayuda">Dinos cuántos son y cuánto tiempo tienen.</p>

    <div class="campo">
      <label for="jugadores">Cantidad de jugadores</label>
      <input type="number" id="jugadores" min="1" required>
    </div>

    <div class="campo">
      <label for="minutos">Tiempo disponible (minutos)</label>
      <input type="number" id="minutos" min="1" required>
    </div>

    <div class="campo">
      <label for="genero">Género</label>
      <select id="genero">
        <option value="">Cualquiera</option>
        <?php foreach ($GENEROS as $g) { echo "<option>$g</option>"; } ?>
      </select>
    </div>

    <button type="submit">Recomendar</button>
  </form>

  <p id="estado" class="mensaje"></p>
  <ul id="resultados"></ul>

  <a class="boton secundario" href="Inicio.php">Inicio</a>
</div>

<script>
// Cambia esta URL por la Function URL de tu Lambda
const URL_FUNCION = "https://TU-FUNCTION-URL.lambda-url.us-east-1.on.aws/";

document.getElementById("formulario").addEventListener("submit", async (e) => {
  e.preventDefault();
  const estado = document.getElementById("estado");
  const lista = document.getElementById("resultados");
  lista.innerHTML = "";
  estado.className = "mensaje";
  estado.textContent = "Buscando...";

  const params = new URLSearchParams({
    jugadores: document.getElementById("jugadores").value,
    minutos: document.getElementById("minutos").value,
    genero: document.getElementById("genero").value,
  });

  try {
    const respuesta = await fetch(URL_FUNCION + "?" + params);
    const datos = await respuesta.json();
    if (!respuesta.ok) throw new Error(datos.error);

    if (datos.total === 0) {
      estado.className = "mensaje error";
      estado.textContent = "No hay juegos que cumplan esas condiciones.";
      return;
    }
    estado.textContent = "Te recomendamos:";
    datos.juegos.forEach((j) => {
      const li = document.createElement("li");
      li.textContent = `${j.nombre} (${j.genero}) · hasta ${j.jugadores} jugadores · ${j.duracion} min`;
      lista.appendChild(li);
    });
  } catch (error) {
    estado.className = "mensaje error";
    estado.textContent = "Error: " + error.message;
  }
});
</script>
</body>
</html>