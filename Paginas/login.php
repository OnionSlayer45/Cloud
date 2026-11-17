<?php
  //if(isset($_COOKIE["usuario"])){
  //header("Location: auth.php");
  //}

  session_start();
  if(isset($_SESSION["logueado"])){
    header("location:Inicio.php");
  }
    
?>





<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesión</title>
<style>
  :root{
    --ink: #182422;
    --panel: #0F3D33;
    --paper: #FBF9F4;
    --text-muted: #6B7770;
    --border: #D8D2C4;
  }

  *{ box-sizing: border-box; }

  body{
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
   background: radial-gradient(circle at 30% 20%, var(--panel-2) 0%, var(--panel) 60%);
    font-family: "Helvetica Neue", Arial, sans-serif;
    color: var(--ink);
    padding: 24px;
  }

  .card{
    width:100%;
    max-width: 360px;
    background: #fff;
    border-radius: 6px;
    padding: 40px 32px;
    box-shadow: 0 20px 50px rgba(15,61,51,0.15);
  }

  h1{
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 28px 0;
    text-align: center;
  }

  form{
    display:flex;
    flex-direction:column;
    gap: 18px;
  }

  .field{
    display:flex;
    flex-direction:column;
    gap: 6px;
  }

  .field label{
    font-size: 12.5px;
    font-weight: 600;
  }

  .field input{
    border: 1.5px solid var(--border);
    border-radius: 4px;
    background: transparent;
    padding: 10px 12px;
    font-size: 15px;
    color: var(--ink);
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s ease;
  }

  .field input::placeholder{
    color: #B7B0A1;
  }

  .field input:focus{
    border-color: var(--panel);
  }

  .field input:focus-visible{
    outline: 2px solid var(--panel);
    outline-offset: 2px;
  }

  button{
    margin-top: 8px;
    padding: 12px 20px;
    background: var(--panel);
    color: var(--paper);
    border: none;
    border-radius: 4px;
    font-size: 14.5px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
  }

  button:hover{
    background: #14493C;
  }

  button:active{
    transform: translateY(1px);
  }
</style>
</head>
<body>

<div class="card">
  <h1>Iniciar sesión</h1>

  <form id="loginForm" action="auth2.php" method="post">
    <div class="field">
      <label for="email">Correo electrónico</label>
      <input type="text" id="email" name="usuario" placeholder="Nombre de usuario." required>
    </div>

    <div class="field">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" placeholder="••••••••" required>
    </div>

    <button type="submit">Entrar</button>
    <?php         
        //mensaje de error

        if (isset ($_GET["error"])){
          echo "Usuario o contraseña incorrectos";

        }
    ?>
  </form>
</div>

</body>
</html>