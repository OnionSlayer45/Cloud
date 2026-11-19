<?php
  //if(isset($_COOKIE["usuario"])){
  //header("Location: auth.php");
  //}

  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
  }
    
?>