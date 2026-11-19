<?php
  //if(isset($_COOKIE["usuario"])){
  //header("Location: auth.php");
  //}

  session_start();
  if(!isset($_SESSION["logueado"])){
    header("location:login.php");
  }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar registros</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .formulario {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
        }

        .campo {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #444;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 16px;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: #4a90e2;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: none;
            border-radius: 7px;
            background: #4a90e2;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #357abd;
        }
    </style>
</head>

<body>

    <form class="formulario" action="resultadotabla.php" method="post">

        <h1>Buscar registro</h1>

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required>
        </div>

        <button type="submit">Buscar</button>

    </form>

</body>
</html>