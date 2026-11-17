<?php
    //script que cierra la sesión
    session_start();
    session_destroy();
    $_SESSION = [];
    header("Location: formularioautentica.php");
    exit();

?>