<?php
session_start();
if (!isset($_SESSION["logueado"])) {
    header("Location: login.php");
    exit;
}

require "conexion.php";

$carpeta = "/var/www/pdfs"; // misma carpeta que en archivos.php

// basename() elimina cualquier ruta (../, /etc/, etc.) y deja solo el nombre
$nombre = basename($_GET["archivo"] ?? "");
$ruta   = $carpeta . "/" . $nombre;

if (strtolower(pathinfo($nombre, PATHINFO_EXTENSION)) !== "pdf" || !is_file($ruta)) {
    header("Location: archivos.php?error=1");
    exit;
}

header("Content-Type: application/pdf");
header('Content-Disposition: attachment; filename="' . $nombre . '"');
header("Content-Length: " . filesize($ruta));
readfile($ruta);