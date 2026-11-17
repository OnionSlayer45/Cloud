
<?php
    // atrapamos info del formulario
    $matricula = $_POST["matricula"];
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    

    // iniciamos la conexión
    // los parámetros son: 
    // IP de la BD, Usuario, Pass, Nombre de la BD
    $conexion = mysqli_connect("localhost", "root", "root", "basedatosclase");
    //$consulta1 = "insert into tablaprueba values({$matricula},'{$nombre}',{$edad});";
    $consulta = 'insert into tablaprueba values('.$matricula.', "'.$nombre.'", '.$edad.');';
    $resultado = mysqli_query($conexion, $consulta);
    
    // redirecciona
    header("Location: formbd.php?msj=1");
    exit();
?>



