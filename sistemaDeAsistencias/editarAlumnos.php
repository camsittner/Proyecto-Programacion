<?php 
$data=$_GET;
require 'conexionBD.php';
$baseDatos = new DataBase();
//var_dump($data);
$id_alumnos= $data['id_alumnos'];

$aux= $baseDatos->consultarBD("SELECT * FROM alumnos where id_alumnos= $id_alumnos");
$mostrar =$aux[0];

//value="<?php echo $mostrar['nombre']; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de Alumno</title>
    <style>
        /* Estilos generales para el body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Estilo para el contenedor del formulario */
        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Título del formulario */
        h4 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Estilo de la tabla del formulario */
        table {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        label {
            font-weight: bold;
            color: #555;
            font-size: 14px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Espaciado entre los campos */
        tr + tr {
            margin-top: 10px;
        }

        /* Estilo para la fila del botón */
        input[type="hidden"] {
            display: none;
        }

    </style>
</head>

<body>

    <div class="form-container">
        <form action="AltaAlumnos.php" method="get">
            <h4>Ingrese el Alumno a editar</h4>
            <table>
                <tr>
                    <td><label for="nombre">Nombre:</label><br>
                        <input type="text" id="nombre" name="nombre" required value="<?php echo $mostrar['nombre']; ?>" maxlength="20" ><br></td>
                </tr>

                <tr>
                    <td><label for="apellido">Apellido:</label><br>
                        <input type="text" id="apellido" name="apellido" required value="<?php echo $mostrar['apellido']; ?>" maxlength="20" ><br></td>
                </tr>

                <tr>
                    <td><label for="fecha_nacimiento">Fecha de Nacimiento:</label><br>
                        <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" required value="<?php echo $mostrar['fecha_nacimiento']; ?>" maxlength="20" ><br></td>
                </tr>

                <tr>
                    <td><label for="dni">DNI:</label><br>
                        <input type="text" id="dni" name="dni" required value="<?php echo $mostrar['dni']; ?>" maxlength="20" ><br></td>
                </tr>

                <tr>
                    <td><label for="id_institucion">ID de la Institución:</label><br>
                        <input type="text" id="id_institucion" name="id_institucion" required value="<?php echo $mostrar['id_institucion']; ?>" maxlength="20" ><br></td>
                </tr>

                <tr>
                    <input type="hidden" name="clase" value="editarAlumnos">
                    <input type="hidden" name="id_alumnos" value="<?php echo $mostrar['id_alumnos']; ?>" maxlength="20" >
                    <td><br><button type="submit">Editar Alumno</button></td>
                </tr>
            </table>
        </form>
    </div>

</body>

</html>