
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Alumno</title>
    <style>
        /* Estilos generales para la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Contenedor principal */
        .container {
            width: 90%;
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Título */
        h1 {
            text-align: center;
            color: #4CAF50;
            font-size: 32px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        /* Resultados */
        .resultado {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #e3f7e5;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            font-size: 18px;
        }

        .resultado strong {
            font-weight: bold;
        }

        /* Estado del Alumno */
        .estado-alumno {
            margin-top: 15px;
            padding: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            border-radius: 8px;
            color: #856404;
            font-size: 18px;
        }

        /* Detalles del Alumno */
        .detalles-alumno {
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .detalles-alumno div {
            margin-bottom: 10px;
            font-size: 18px;
        }

        /* Responsividad: Ajustes para pantallas pequeñas */
        @media (max-width: 600px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .detalles-alumno div {
                font-size: 16px;
            }

            .resultado, .estado-alumno {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Detalles del Alumno</h1>
    </div>

</body>
</html>

<?php
$data = $_GET;
require 'conexionBD.php';
$baseDatos = new DataBase();
$id_alumno = $data['id_alumnos'];

$mostrar = $baseDatos->consultarBD("SELECT * FROM alumnos WHERE id_alumnos=$id_alumno");
$contador = 0;
$acumulador = 0;
$promedio = 0;

if ($mostrar[0]['nota1'] > 0) {
    $acumulador = $mostrar[0]['nota1'];
    $contador = $contador + 1;
}

if ($mostrar[0]['nota2'] > 0) {
    $contador = $contador + 1;
    $acumulador = $acumulador + $mostrar[0]['nota2'];
}
if ($mostrar[0]['nota3'] > 0) {
    $contador = $contador + 1;
    $acumulador = $acumulador + $mostrar[0]['nota3'];
}

if ($contador <> 0) {
    $promedio = $acumulador / $contador;
    echo "<div class='resultado'><strong>Promedio de Notas:</strong> " . number_format($promedio, 2) . "</div>";

    // Mostrar el estado del alumno según el promedio de notas
    if ($promedio < 6) {
        echo "<div class='estado-alumno'>El alumno está libre en notas.</div>";
    } else {
        if ($promedio >= 7) {
            echo "<div class='estado-alumno'>El alumno está promocionado en notas.</div>";
        } else {
            echo "<div class='estado-alumno'>El alumno está regularizado en notas.</div>";
        }
    }
}

$diasDeClases = $baseDatos->consultarBD("SELECT count(distinct fecha) total from asistencias");

$asistenciasAlumnos = $baseDatos->consultarBD("SELECT count(distinct fecha) total from asistencias where id_alumno = $id_alumno");
$a = array_pop($asistenciasAlumnos);
$b = array_pop($diasDeClases);
$porsentaje = $a['total'] / $b['total'] * 100;

echo "<br>"."<br>"."<div class='resultado'><strong>Porcentaje de Asistencias:</strong> " . number_format($porsentaje, 2) . "%</div>";
 // Mostrar el estado del alumno según el promedio de asistencias

 if ($porsentaje >= 70) {
    echo "<div class='estado-alumno'>El alumno está promocionado en asistencias.</div>";
} else {
    if ($porsentaje < 60) {
        echo "<div class='estado-alumno'>El alumno está libre en asistencias.</div>";
    } else {
        echo "<div class='estado-alumno'>El alumno está regularizado en asistencias.</div>";
    }
}

echo "<div class='detalles-alumno'>";
foreach ($mostrar as $alumnos) {
    echo "<div><strong>ID Alumno:</strong> " . $alumnos['id_alumnos'] . "</div>";
    echo "<div><strong>Nombre:</strong> " . $alumnos['nombre'] . "</div>";
    echo "<div><strong>Apellido:</strong> " . $alumnos['apellido'] . "</div>";
    echo "<div><strong>Fecha de Nacimiento:</strong> " . $alumnos['fecha_nacimiento'] . "</div>";
    echo "<div><strong>DNI:</strong> " . $alumnos['dni'] . "</div>";
    echo "<div><strong>Institución:</strong> " . $alumnos['id_institucion'] . "</div>";
}
echo "</div>";
?>

