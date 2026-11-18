<?php
    // atrapamos info del formulario
    $nombre = $_POST["nombre"];

    

    // iniciamos la conexión
    // los parámetros son: 
    // IP de la BD, Usuario, Pass, Nombre de la BD
    $conexion = mysqli_connect("localhost", "root", "root", "basedatosclase");
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = "select * from tablaprueba where nombre like '%{$nombre}%';";
    $resultado = mysqli_query($conexion, $consulta);
    
    
    while($registro = mysqli_fetch_array($resultado)){
        echo $registro["matricula"] . " - ". $registro["nombre"] . " - " . $registro["edad"];
        echo "<br>";
        }

  
    
   
?>