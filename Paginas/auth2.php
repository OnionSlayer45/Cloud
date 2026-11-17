<?php
    if(isset($_COOKIE["usuario"])){
    $usuario_usuario=$_COOKIE["usuario"];
    $pass=$_COOKIE["pass"];
    }
    else{

    $usuario_usuario =$_POST["usuario"];
    $pass = $_POST["password"];
    }
    $uscor = "Martin";
    $pascor = "1234";

    if (($uscor == $usuario_usuario) && ($pascor==$pass)){
        session_start();
        $_SESSION["logueado"]="si";
        $_SESSION["usuario"]=$uscor;
        setcookie("usuario",$usuario_usuario, time()+600);
        setcookie("pass",$pass,time()+600);
        header("Location:Inicio.php");
        exit();

    }

    else{
        header("Location:login.php?error=1");
        exit();
    }
?>