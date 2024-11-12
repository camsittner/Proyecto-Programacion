<?php
$data = $_POST;

require 'conexionBD.php';
$baseDatos = new DataBase();
$mostrar = $baseDatos->consultarBD('SELECT * FROM instituciones ');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instituciones</title>
    <style>
        /* CSS para dar formato a la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        .instituciones-lista {
            list-style-type: none;
            padding: 0;
        }

        .institucion-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .institucion-item:hover {
            background-color: #f1f1f1;
        }

        .institucion-nombre {
            font-size: 18px;
            color: #333;
            font-weight: bold;
            text-transform: capitalize;
        }

        .institucion-link {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .institucion-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Listado de Instituciones</h1>

        <ul class="instituciones-lista">
            <?php
            foreach($mostrar as $institucion) {
                $id = $institucion['id_institucion'];
                $nombreInstitucion = $institucion['nombre_institucion']; 
            ?>
                <li class="institucion-item">
                    <span class="institucion-nombre"><?php echo $nombreInstitucion; ?></span>
                    <a href="AltaAlumnos.php?id_institucion=<?php echo $id; ?>" class="institucion-link">Ingresar</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

</body>
</html>
