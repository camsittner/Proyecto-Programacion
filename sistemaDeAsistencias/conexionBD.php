<?php

class DataBase {
    private $host = 'localhost';
    private $db_name = 'asistencia';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function __construct() {
        $this->connect();
    }
    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, 
                                  $this->username, 
                                  $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
    public function consultarBD($consultaSQL){
        try{
            $consulta= $this->conn->prepare($consultaSQL);
            $consulta->execute();
            $resultadoConsulta = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultadoConsulta;
            }catch(PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        }
}
