<?php    

    # atrapo datos del formulario
    require "conexion.php";
    $matricula = $_POST["opcion"];

    // los parámetros son: 
    // IP de la BD, Usuario, Pass, Nombre de la BD
    require "infoconexion.php";
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = "delete from tablaprueba where matricula = {$matricula};";
    $resultado = mysqli_query($conexion, $consulta);

    header("Location: seleccionaregistro.php?msj=1");
    exit();



?>