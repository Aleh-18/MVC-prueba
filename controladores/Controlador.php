<?php
require_once __DIR__ . '/../modelos/Modelo.php';

/*En el controlador creamos clases y dentro de las calses creamos funciones sobre esea clase*/
class Controlador { 
    public function funcionLogearse($usuario_id){
        
        /*Creamos un modelo y automaticamente conecta con la bd*/
        $loginModelo = new Modelo();

       /* Si viene ID por URL, obtener usuario directamente*/
        if($usuario_id){
            $filaUsuario = $loginModelo->obtenerUsuarioPorId($usuario_id);
        } else {
            // Si no viene ID, validar con correo y contraseña
            if(!isset($_POST['correo']) || !isset($_POST['contrasenia'])){
                echo "Los campos no se han rellenado";
                
            }
            $correo = $_POST['correo'];
            $contrasenia = $_POST['contrasenia'];

            try{
                $filaUsuario = $loginModelo->validarIniciarSesion($correo, $contrasenia);
            } catch(PDOException $e){
                echo "Error al validar la sesion";
            }
        }
        
        try{

            /*Si los datos son correctos los enviara a la proxima vista*/
            if($filaUsuario){          
                $hobbies = $loginModelo->obtenerHobbiesPorUsuario($filaUsuario['id']);
                require __DIR__ . '/../vistas/sesionIniciada.php'; 
            } else {
                echo "El usuario no esta en la base de datos";
            }

        } catch(PDOException $e){
            echo "Error en la base de datos";
        }
    }

    public function vistaModificar($usuario_id){
        
        if(!$usuario_id){
            echo "Usuario no especificado";
            return; 
        }

        $modificarModelo = new Modelo();

        
         try{
            /*Verificar que el usuario que quiere modificar existe con el id desde url*/
            $filaUsuario = $modificarModelo->obtenerUsuarioPorId($usuario_id);

            /*Si el usuario existe se carga la vista para modificar*/
            if($filaUsuario){            
                $hobbiesdeUsuario = $modificarModelo->obtenerHobbiesPorUsuario($filaUsuario['id']);
                $todosHobbies = $modificarModelo->obtenerTodosLosHobbies();
                
                
                
                require __DIR__ . '/../vistas/modificarHobbies.php'; 
            } else {
                echo "El usuario no esta en la base de datos";
            }

        } catch(PDOException $e){
            echo "Error en la base de datos";
        }
    }

    public function vistaModificado($usuario_id){
        /*Aqui no necesitamos el id para verificar la sesion sino para modificar sus datos*/

        if(!$usuario_id || !isset($_POST['hobbies'])){
            echo "Datos incompletos";
            return;
        }

        $hobbies_ids = $_POST['hobbies'];

        $modificarModelo = new Modelo();

        try{
            // Actualizar hobbies
            $modificarModelo->modificarHobbiesUsuario($usuario_id, $hobbies_ids);
            
            /*Obtener datos del usuario para pasar a la vista que es el*/
            /* mismo dato que se le ha pasado a esta funcion pero una para el controlador y otra para las vistas*/
            $filaUsuario = $modificarModelo->obtenerUsuarioPorId($usuario_id);
            
            require __DIR__ . '/../vistas/confirmacionDeModificaciones.php';
        } catch(PDOException $e){
            echo "Error en la base de datos: " . $e->getMessage();
        }
    }
}

?>
