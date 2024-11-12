<?php
$data = $_GET;


require 'conexionBD.php';
$baseDatos = new DataBase();
$instituciones = $baseDatos->consultarBD('SELECT * FROM instituciones ');



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Alumno</title>
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
            background-color: #FF5733;
            /* Color rojo para eliminar */
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #D54A29;
            /* Color rojo más oscuro para hover */
        }

        /* Espaciado entre los campos */
        tr+tr {
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
            <h4>Ingrese el Alumno a Eliminar</h4>
            <table>
                <tr>
                    <td><label for="institucion">Institucion a Borrar:</label><br>
                        <select name="institucion" id="institucion">
                            <option value="">Seleccione Institucion:</option>
                            <?php
                            foreach ($instituciones as $instituto) {
                                echo "<option value=" . $instituto['id_institucion'] . ">" . $instituto['nombre_institucion'] . "</option>";
                            }
                            ?>
                        </select>
                </tr>
                <tr>
                    <td><label for="id_alumnos">Alumno a Borrar:</label><br>
                        <select name="id_alumnos" id="id_alumnos" disabled>
                            <option value="">Seleccione Alumno</option>
                        </select>
                        
                </tr>
                <tr>
                    <input type="hidden" name="clase" value="borrarAlumnos">
                    <input type="hidden" name="id_institucion" value="<?php echo $data['id_institucion']; ?>">
                    <td><br><button type="submit">Borrar Alumno</button></td>
                </tr>
            </table>
        </form>
    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const institutoSelect = document.getElementById('institucion');
        const alumnosSelect = document.getElementById('id_alumnos');

        institutoSelect.addEventListener('change', () => {
            if (institutoSelect.value) {
                alumnosSelect.disabled = false

            } else { alumnosSelect.disabled = true }
            
            alumnosSelect.innerHTML=' <option value="">Seleccione Alumno</option>'
            console.log(institutoSelect.value);

            if (institutoSelect.value) {
                fetch('http://localhost/sistemaDeAsistencias/getAlumnos.php', {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_institucion: institutoSelect.value,

                    })
                })
                    .then(Response => Response.json())
                    .then(data => {

                        data.forEach(alumno => {
                            const option = document.createElement('option')
                            option.value = alumno.id_alumnos;
                            option.textContent= alumno.nombre+' '+alumno.apellido
                            alumnosSelect.appendChild(option);                            
                        });
                        

                    }).catch(error => console.log('Error:', error));

            }


        })

     
    })

</script>

</html>