<?php    
    // los parámetros son: 
    require "conexion.php";
    $matricula = $_POST["matricula"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    // IP de la BD, Usuario, Pass, Nombre de la BD
    require "infoconexion.php";
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = 'update tablaprueba set nombre = "'.$nombre.'", edad = '.$edad.' where matricula = '.$matricula.';';
    $resultado = mysqli_query($conexion, $consulta);
    header("Location: seleccioncambio.php?msj=1");
    exit();
?>