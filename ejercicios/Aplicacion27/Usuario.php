<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "UsuarioDAO.php";

class Usuario
{
    public $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $fecha_registro;
    public $localidad;
    public $mail;

    public static function ObtenerUsuarios()
    {  
        $dao = new UsuarioDAO();
        return $dao->ConsultarUsuarios();    
    }

    public static function MostrarUsuariosHtml($usuarios)
    {
        foreach ($usuarios as $usuario)
        {
            echo '<li style="color:red">'. $usuario->id .
             $usuario->nombre . " " .
             $usuario->apellido . " " .
             $usuario->clave . " " .
             $usuario->fecha_registro . " " .
             $usuario->localidad . " " .
             $usuario->mail . " " .
             '</li>';
        }

    }

    public static function CrearUsuario($nombre, $apellido, $clave, $fecha_registro, $localidad, $mail)
    {
        //echo "CrearUsuario " . $nombre;
        //return new Usuario($nombre, $apellido, $clave, $fecha_registro, $localidad, $mail);
        $u =  new Usuario($nombre, $apellido, $clave, $fecha_registro, $localidad, $mail);
        
        echo "/////////////////// <br>";
        echo "CrearUsuario <br>";
        var_dump($u);
        return $u;
    }


}
?>