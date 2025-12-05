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

    public function obtenerUsuarioPorId($usuario_id){
        $sql = 'SELECT * FROM usuarios WHERE id="'.$usuario_id.'"';
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
    public function modificarHobbiesUsuario($usuario_id, $hobbies_ids){
        try{
            // Primero eliminamos todos los hobbies del usuario
            $sql_delete = "DELETE FROM usuario_hobbies WHERE usuario_id = $usuario_id";
            $this->pdo->query($sql_delete);

            // Luego insertamos los nuevos hobbies
            if (!empty($hobbies_ids)) {
                /*Prueba de consulta preparada para evitar injecciones sql*/
                $sql_insert = "INSERT INTO usuario_hobbies (usuario_id, hobby_id) VALUES (:usuario_id, :hobby_id)";
                $stmt = $this->pdo->prepare($sql_insert);
                foreach ($hobbies_ids as $hobby_id) {
                    $stmt->bindParam("hobby_id", $hobby_id);
                    $stmt->bindParam("usuario_id", $usuario_id);
                    $stmt->execute();
                }
            }
        } catch(PDOException $e){
            throw $e;
        }
    }

    public function obtenerTodosLosHobbies(){
        $sql = "SELECT id, hobby FROM hobbies";
        try{
            $resultado = $this->pdo->query($sql);
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            throw $e;
        }
    }
}
?>
