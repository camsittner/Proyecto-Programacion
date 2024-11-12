<?php

require 'conexionBD.php';
$baseDatos=new DataBase();

header('content-type: application/json');

$data = file_get_contents("php://input");
$items = json_decode($data, true);

$alumnos = $baseDatos->consultarBD('SELECT * FROM alumnos WHERE id_institucion=' . $items['id_institucion']);
echo json_encode($alumnos);
