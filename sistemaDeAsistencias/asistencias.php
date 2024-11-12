<?php
        


require 'conexionBD.php';
$baseDatos = new DataBase();

header('Content-Type: application/json');

$data = file_get_contents("php://input");
$items = json_decode($data, true);
//var_dump($items);

$id_alumno = $items['id_alumno'];
$fecha = date("Y-m-d");
$fechaCumpleaños = $items['fecha_nacimiento']; 

// Verificar si ya existe un registro para hoy (fecha) para el alumno
$asistencias = $baseDatos->consultarBD("SELECT * FROM asistencias WHERE id_alumno = $id_alumno AND fecha = '$fecha'");


if ($items['presente']) {
    // Si la asistencia está marcada como presente, pero existe un registro de ausente, eliminamos la asistencia anterior
    if (!empty($asistencias)) {
        $baseDatos->consultarBD("DELETE FROM asistencias WHERE id_alumno = $id_alumno AND fecha = '$fecha'");
    }

    // Insertar nueva asistencia como 'presente'
    $resultado = $baseDatos->consultarBD("INSERT INTO asistencias (id_alumno, fecha, presente) VALUES ($id_alumno, '$fecha', 'presente')");

    echo json_encode(['resultado' => 'exito', 'mensaje' => 'Asistencia marcada como presente']);
} elseif (!$items['presente']) {
    // Si la asistencia está marcada como ausente, eliminamos cualquier registro de presencia previo
    if (!empty($asistencias)) {
        $baseDatos->consultarBD("DELETE FROM asistencias WHERE id_alumno = $id_alumno AND fecha = '$fecha'");
    }

    // Insertar nueva asistencia como 'ausente'
    $resultado = $baseDatos->consultarBD("INSERT INTO asistencias (id_alumno, fecha, presente) VALUES ($id_alumno, '$fecha','ausente' )");

    echo json_encode(['resultado' => 'exito', 'mensaje' => 'Asistencia marcada como ausente']);
} else {
    // Si no se envía ni 'presente' ni 'ausente', se responde con un error
    echo json_encode(['resultado' => 'error', 'mensaje' => 'Debe marcar la asistencia como presente o ausente']);
}

