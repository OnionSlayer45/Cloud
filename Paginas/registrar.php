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
    <title>Registro de estudiante</title>

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

    <form class="formulario" action="/Paginas/DB/registrar.php" method="post">

        <h1>Registro de estudiante</h1>

        <div class="campo">
            <label for="matricula">Matrícula</label>
            <input type="text" id="matricula" name="matricula" required>
        </div>

        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="campo">
            <label for="edad">Edad</label>
            <select id="edad" name="edad" required>
                <option value="">Selecciona tu edad</option>
                <option value="18">18 años</option>
                <option value="19">19 años </option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
            </select>
        </div>

        <button type="submit">Registrar</button>
    <?php
        if(isset($_GET["msj"])){
            echo "Registro agregado con éxito";
        }
    ?>
    </form>

</body>
</html>
