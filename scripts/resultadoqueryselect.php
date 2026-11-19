
<?php
    // atrapamos info del formulario
    $matricula = $_POST["matricula"];
    require "conexion.php";
    // iniciamos la conexión
    // los parámetros son: 
    // IP de la BD, Usuario, Pass, Nombre de la BD
    $conexion = mysqli_connect("localhost", "root", "root", "basedatosclase");
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = 'select * from tablaprueba;';
    $resultado = mysqli_query($conexion, $consulta);
    
   

?>
