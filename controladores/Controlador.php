<?php
require_once __DIR__ . '/../modelos/Modelo.php';

/*En el controlador creamos clases y dentro de las calses creamos funciones sobre esea clase*/
class Controlador { 
    public function logearse(){
        
        if(!isset($_POST['correo']) || !isset($_POST['contrasenia'])){
            echo "Los campos no se han rellenado";
            return; /*Si no existen los datos se devolveran a mostrar.php y se mostraran*/
        }

        $correo = $_POST['correo'];
        $contrasenia = $_POST['contrasenia'];

        /*Creamos un modelo y automaticamente conecta con la bd*/
        $usuarioModelo = new Modelo();

        try{
            $filaUsuario = $usuarioModelo->validarIniciarSesion($correo, $contrasenia);

            /*Si los datos son correctos los enviara a la proxima vista*/
            if($filaUsuario){
                // Obtenemos los hobbies del usuario
                $hobbies = $usuarioModelo->obtenerHobbiesPorUsuario($filaUsuario['id']);
                require __DIR__ . '/../vistas/sesionIniciada.php'; 
            } else {
                echo "El usuario no esta en la base de datos";
            }

        } catch(PDOException $e){
            echo "Error en la base de datos";
        }
    }
}
?>
