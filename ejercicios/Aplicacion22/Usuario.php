<?php
///GDB app 22: https://onlinegdb.com/PP2LIf1aS 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once ROOT ."Aplicacion19/archivosCSV.php";
define('ROOT', 'C:\xampp\htdocs\ejercicios\\');
define('ARCHIVO_CSV', 'ListaUsuarios.csv');
echo "App 22 <br>";

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

    function __construct($nombre, $clave, $mail)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
    }

    public static function AgregarUsuario($nombre, $clave, $mail)
    {
        return new Usuario($nombre, $clave, $mail);
    }

    public static function MostrarUsuario($usuarios)
    {
        foreach ($usuarios as &$valor) 
        {
            echo $valor->nombre;
            echo $valor->clave;
            echo $valor->mail;
        }
        
    }

    /*Lee un CSV con usuarios y por cada elemento de ese array instancia un usuario y lo agrega a un array de usuarios
    Devuelve un array con usuarios */
    public static function CargarUsuarios()
    {
        $usuarios = [];
        $usuarios = ArchivoCSV::Leer2(ARCHIVO_CSV, $usuarios);
        $usuariosAux = [];
        foreach ($usuarios as $valor) 
        {
            array_push($usuariosAux,new Usuario($valor[0], $valor[1], $valor[2]));
        }
        return $usuariosAux;

    }

    /* Verifica si es un usuario registrado. Para esto primero trae los usuarios a un array y asi poder hacer la evaluacion.
    Retorna:
    “Verificado” si el usuario existe y coincide la clave también.
    “Error en los datos” si esta mal la clave.
    “Usuario no registrado si no coincide el mail“ */
    public static function VerificarUsuarioExistente($usuario)
    {
        $usuarios = Usuario::CargarUsuarios();
        $existe;

        foreach ($usuarios as $valor) 
        {
            if($usuario->mail == $valor->mail)
            {
                if($usuario->clave == $valor->clave)
                {
                    $existe = "Verificado";
                    break;
                }
                else
                {
                    $existe = "Error en los datos";
                    break;
                }  
            }
            else
            {
                $existe = "Usuario no registrado";
            }
            
        }
        return $existe;

    }

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'POST':
                $usuario = Usuario::AgregarUsuario($_POST['nombre'], $_POST['clave'], $_POST['mail']);
                if(Usuario::VerificarUsuarioExistente($usuario)== "Usuario no registrado")
                {
                    ArchivoCSV::Escribir($usuario, ARCHIVO_CSV);
                }
                break;
            case 'GET':
                $listado = $_GET['listado'];
                switch($listado)
                {
                    case 'usuarios':
                        $aux = [];
                        $aux = Usuario::CargarUsuarios();
                        break;
                }
                



        }
    }
}//class

Usuario::Operar();

?>