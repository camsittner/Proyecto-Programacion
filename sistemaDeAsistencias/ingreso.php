<?php
$data=$_POST;
require 'conexionBD.php';
$baseDatos=new DataBase();



// Función para limpiar los datos de entrada
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Verificar si se recibieron los valores por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores enviados por POST
    $usuario = clean_input($_POST["usuario"]);
    $contrasena = clean_input($_POST["contrasena"]);

    // Crear una instancia de la clase Database
    $database = new Database();
    // Obtener la conexión
    $conn = $database->connect();

    try {
    
        // Preparar la consulta SQL
        $stmt = $conn->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
        // Vincular los parámetros
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);
        //die(var_dump($usuario_db));
        // Verificar si se encontró el usuario y si la contraseña coincide
        //if ($usuario_db && password_verify($contrasena, $usuario_db['contrasena'])) {
        if ($usuario_db['contrasena'] == $contrasena) {
            // Establecer variables de sesión
            //$_SESSION["usuario"] = $usuario;
            echo "Login exitoso.";
            // Redirigir al usuario a otra página después del login exitoso
            header("Location: instituciones.php");
            exit();
        } else {
            echo " Usuario o contraseña inválidos.";
            echo "<script>alert('¡Error!');</script>";
        }
    } catch (PDOException $e) {
        echo "Error de conexión2: " . $e->getMessage();
    }

} 
