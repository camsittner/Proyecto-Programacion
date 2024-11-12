<?php
$data = $_GET;
require 'conexionBD.php';
$baseDatos = new DataBase();



if (isset($data['clase'])) {
    switch ($data['clase']) {
        case 'ingresarAlumnos':
            $ingresar = $baseDatos->consultarBD("INSERT INTO alumnos (nombre, apellido, fecha_nacimiento,dni , id_institucion) VALUES ('" . $data['nombre'] . "','" . $data['apellido'] . "','" . $data['fecha_nacimiento'] . "' , '" . $data['dni'] . " ',' " . $data['id_institucion'] . "')");
            echo "<br>";
            break;

        case 'editarAlumnos':
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $fecha_nacimiento = $data['fecha_nacimiento'];
            $dni = $data['dni'];
            $id_alumnos = $data['id_alumnos'];
            $id_institucion = $data['id_institucion'];

            $ingresar = $baseDatos->consultarBD("UPDATE alumnos
            set  nombre = '$nombre' , apellido = '$apellido', fecha_nacimiento ='$fecha_nacimiento', dni =$dni , id_institucion = $id_institucion WHERE id_alumnos = $id_alumnos");
            echo "<br>";
            break;

        case 'borrarAlumnos':
            var_dump($data);
            $id_alumnos = $data['id_alumnos'];
            $borrar = $baseDatos->consultarBD("DELETE FROM alumnos WHERE id_alumnos = $id_alumnos;");
            echo "<br>";
            break;

        case 'notasAlumnos':
            // Verifica si las notas están disponibles antes de realizar la actualización
            $nota1 = isset($data['nota1']) ? $data['nota1'] : null;
            $nota2 = isset($data['nota2']) ? $data['nota2'] : null;
            $nota3 = isset($data['nota3']) ? $data['nota3'] : null;
            $id_alumno = $data['id_alumnos'];

            // Construir la consulta dinámica en función de las notas proporcionadas
            $sql = "UPDATE alumnos SET ";
            $params = [];

            // Añadir las notas solo si tienen valor
            if ($nota1 !== null) {
                $sql .= "nota1 = :nota1, ";
                $params[':nota1'] = $nota1;
            }
            if ($nota2 !== null) {
                $sql .= "nota2 = :nota2, ";
                $params[':nota2'] = $nota2;
            }
            if ($nota3 !== null) {
                $sql .= "nota3 = :nota3, ";
                $params[':nota3'] = $nota3;
            }

            // Eliminar la última coma si hay notas que actualizar
            if (substr($sql, -2) === ', ') {
                $sql = substr($sql, 0, -2); // Elimina la coma final
            }

            // Añadir la condición WHERE
            $sql .= " WHERE id_alumnos = :id_alumno";
            $params[':id_alumno'] = $id_alumno;

            // Preparar y ejecutar la consulta
            $stmt = $baseDatos->conn->prepare($sql);
            $stmt->execute($params);

            // echo "Notas actualizadas correctamente.";
            break;
    }
}


$mostrar = $baseDatos->consultarBD('SELECT * FROM alumnos WHERE id_institucion=' . $data['id_institucion']);
foreach ($mostrar as $alumnos) {
    echo "<br>" . "<br>";
    foreach ($alumnos as $campo) {
        //    echo $campo . " |";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asistencia</title>
    <style>
        /* Estilo general del body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: -400;
            padding: 80;
        }

        /* Contenedor principal */
        .container {
            width: 110%;
            max-width: 1000px;
            margin: 0px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Títulos */
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 32px;
        }

        /* Estilo para cada fila de alumnos */
        .alumno {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alumno:last-child {
            border-bottom: none;
        }

        .alumno span {
            font-size: 16px;
            color: #333;
        }

        /* Botones de asistencia */
        button {
            padding: 15px 20px;
            background-color: #4CAF50;
            color: white;
            border: navy;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2196F3;
        }

        /* Botones de acción principal */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .action-buttons button {
            padding: 12px 20px;
            background-color: #2196F3;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        .action-buttons button:hover {
            background-color: #d32f2f;
        }

        /* Espaciado adicional */
        .spacer {
            margin-bottom: 20px;
        }

        /* Botón para volver */
        .back-button {
            text-align: center;
            padding: 8px 8px;

            color: white;
            font-size: 15px;
            text-decoration: none;
        }

        .back-button a:hover {
            background-color: #d32f2f;
        }

        /* Espaciado adicional */
        .spacer {
            margin-bottom: 20px;
        }

        .action-button {
            display: flex;
            justify-content: center;
            padding: 8px 10px;
            gap: 40px;
            margin-top: 20px;

        }

        .action-button a:hover {
            background-color: #d32f2f;
        }


        .action-buttonn a:hover {
            background-color: #d32f2f;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Lista de Alumnos</h1>

        <!-- Lista de alumnos -->
        <div class="alumnos-list">
            <?php
            $fecha = date("Y-m-d");
            $hoy_mes_dia = date("m-d", strtotime($fecha));
            // Aquí irían los alumnos con los botones de presencia
            foreach ($mostrar as $alumnos) {
                $fechaCumpleaños = $alumnos['fecha_nacimiento'];

                $cumple_mes_dia = date("m-d", strtotime($fechaCumpleaños));

                $cumple = false;

                if ($hoy_mes_dia == $cumple_mes_dia) {
                    $cumple = true;
                }


                echo "<div class='alumno'>";
                echo "<span>" . $alumnos['id_alumnos'] . " " . $alumnos['nombre'] . " " . $alumnos['apellido'] . " " . "<h4>" . "Notas:  " . $alumnos['nota1'] . " - " . $alumnos['nota2'] . " - " . $alumnos['nota3'] . "</h4>" . "</span>";
                echo "<div>";
                echo "<button onclick='registrarAsistencia(" . $alumnos['id_alumnos'] . ", true, $cumple)'>Presente</button>";
                echo "<button onclick='registrarAsistencia(" . $alumnos['id_alumnos'] . ", false)'>Ausente</button>";

                echo "<button onclick='window.location.href=\"estadoAlumno.php?id_alumnos=" . $alumnos['id_alumnos'] . "\"'>Estado</button>";
                echo "</div>";
                echo "</div>";


            }
            ?>
        </div>

        <div class="action-buttons">
            <form action="editarAlumnos.php" method="get">
                <button type="submit">Editar Alumno</button>

                <label for="id_alumnos"></label><br>
                <select name="id_alumnos" id="id_alumnos">
                    <option value="">Seleccione Alumno</option>
                </select>
            </form>
            <button
                onclick="location.href='ingresarAlumnos.html?id_institucion=<?php echo $data['id_institucion']; ?>'">Inscribir
                Alumno</button>
            <button
                onclick="location.href='borrarAlumnos.php?id_institucion=<?php echo $data['id_institucion']; ?>'">Borrar
                Alumno</button>
        </div>

        <d class="action-button">
            <button
                onclick="location.href='notasAlumnos.php?id_institucion=<?php echo $data['id_institucion']; ?>'">Notas</button>
            <button onclick="verificarAsistencias()"> Ver Asistencias Tomadas</button>
            <div class="back-button">
                <button onclick="location.href='instituciones.php'">Volver a Instituciones</button>
                <button onclick="location.href='index.html'">salir</button>
            </div>

    </div>

            <input type="hidden" id= "institucion" value= <?php echo $data['id_institucion']; ?> >
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const institucion=document.getElementById('institucion').value
            const alumnosSelect = document.getElementById('id_alumnos');
            fetch('http://localhost/sistemaDeAsistencias/getAlumnos.php', {
                method: 'POST',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    id_institucion:institucion

                })
            })
                .then(Response => Response.json())
                .then(data => {

                    data.forEach(alumno => {
                        const option = document.createElement('option')
                        option.value = alumno.id_alumnos;
                        option.textContent = alumno.nombre + ' ' + alumno.apellido
                        alumnosSelect.appendChild(option);
                    });


                }).catch(error => console.log('Error:', error));
        })



        function registrarAsistencia(id_alumno, presente, cumple) {
            if (cumple) { alert('es el cumpleaños') }
            fetch('http://localhost/sistemaDeAsistencias/asistencias.php', {
                method: 'POST',
                headers: {
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    id_alumno: id_alumno,
                    presente: presente


                })
            })
                .then(Response => Response.json())
                .then(data => { console.log(data); })
                .catch(error => console.log('Error:', error));
        }

        function verificarAsistencias() {
            fetch('http://localhost/sistemaDeAsistencias/presentes.php')
                .then(Response => Response.json())
                .then(data => {
                    console.log(data);

                    mensaje = "ASISTENCIAS TOMADAS: ";
                    data.forEach((alumnos, index) => {
                        mensaje = mensaje + '\n' + alumnos['nombre'] + ' ' + alumnos['apellido']
                    });
                    alert(mensaje);


                })
                .catch(error => console.log('Error:', error));


        }
    </script>

</body>

</html>