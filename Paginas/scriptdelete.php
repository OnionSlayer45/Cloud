<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

require "conexion.php";

if (!isset($conexion)) {
    die("Error: conexion.php no define la variable \$conexion.");
}

$nombre = mysqli_real_escape_string($conexion, $_POST["opcion"] ?? "");

try {
    mysqli_query($conexion, "DELETE FROM juegos WHERE nombre = '$nombre'");
    echo "Juego borrado con éxito.";
} catch (Throwable $e) {
    echo "Error al borrar: " . $e->getMessage();
}
?>
<p><a href="borrar.php">Volver a borrar</a></p>