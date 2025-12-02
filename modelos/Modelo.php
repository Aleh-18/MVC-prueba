<?php
require_once __DIR__ . '/../config/Conectar.php';
class Modelo {
    protected $pdo;

    /*Conectar a la bd nada mas crear un Modelo*/
    public function __construct(){
        $c = new Conectar();
        $this->pdo = $c->conectar();
    }

    public function validarIniciarSesion($correo, $contrasenia){
        $sql = 'SELECT * FROM usuarios WHERE correo="'.$correo.'" AND contrasenia="'.$contrasenia.'"';
        try{
            $resultado = $this->pdo->query($sql);
            return $resultado->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw $e;
        }
    }

    /*El modelo envia datos de la bd al controlador para el controlador usarlo*/

    public function obtenerHobbiesPorUsuario($usuario_id){
        $sql = "SELECT h.hobby
            FROM usuario_hobbies uh
            JOIN hobbies h ON uh.hobby_id = h.id
            WHERE uh.usuario_id = $usuario_id";

        try{
            $resultado = $this->pdo->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw $e;
        }
    }

}
?>
