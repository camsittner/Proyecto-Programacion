<?php
require 'conexionBD.php';
$baseDatos=new DataBase();

header('content-type: application/json');

$data = file_get_contents("php://input");
$items = json_decode($data, true);
$fecha= date("Y-m-d");

$presentes = $baseDatos->consultarBD("SELECT * FROM asistencias a INNER JOIN alumnos al on al.id_alumnos=a.id_alumno WHERE fecha='$fecha' and presente ='presente'");

echo json_encode($presentes);

