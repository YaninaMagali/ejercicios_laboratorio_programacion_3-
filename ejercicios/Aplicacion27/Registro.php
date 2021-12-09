<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ejercicios\Aplicacion27\Usuario.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ejercicios\Aplicacion27\UsuarioDAO.php';


 class Registro
 {

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];

        switch($metodo)
        {
            case 'POST':
                
                //($nombre, $apellido, $clave, $fecha_registro, $localidad, $mail);
                if (isset($_POST['nombre'])
                && isset($_POST['apellido']) 
                && isset($_POST['clave'])
                && isset($_POST['mail'])
                && isset($_POST['localidad'])
                && isset($_POST['fecha_registro'])
                )
                {
                    echo "entra al if del post <br>";
                    echo $_POST['nombre'];
                    echo $_POST['apellido'];
                    echo $_POST['clave'];
                    echo $_POST['mail'];
                    echo $_POST['localidad'];
                    echo $_POST['fecha_registro'];
                    $usuario = Usuario::CrearUsuario($_POST['nombre'], $_POST['apellido'], $_POST['clave'], $_POST['fecha_registro'], $_POST['localidad'], $_POST['mail']);
                    var_dump($usuario);
                    $dao = new UsuarioDAO();
                    //echo "/////////// usuario dentro del post<br>";
                    //var_dump($usuario);
                    $dao->InsertarUsuario($usuario);

                }
                break;
        }
    }

}


Registro::Operar();





?>