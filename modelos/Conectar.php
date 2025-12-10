<?php
require_once __DIR__ . '/../config/configbd.php';

class Conectar {
    protected $conexion;

    public function __construct(){
        try{
            $dsn = 'mysql:host=' . SERVERNAME . ';dbname=' . DATABASE . ';charset=utf8mb4';
            $this->conexion = new PDO($dsn, USER, PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            if($e->getCode() == 2002){
                echo "Error al conectar con la base de datos";
            }
        }
    }

    public function conectar(){
        return $this->conexion;
    }
}
?>
