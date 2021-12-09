<?php
header("Access-Control-Allow-Origin: *");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('ROOT', 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ejercicios\\');
require_once ROOT ."Aplicacion19/archivosCSV.php";
require_once ROOT ."Aplicacion23/ArchivoJSON.php";
require_once ROOT ."Aplicacion23/Archivador.php";
define('ARCHIVO_CSV', 'ListaUsuarios.csv');
echo "App 23 <br>";



class Usuario
{
    //public $id;
    //public $fecha;
    public $nombre;
    public $clave;
    public $mail;

    function __construct($nombre, $clave, $mail)
    {
       // $this->id = $id;
       // $this->fecha = $fecha;
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
        //leer archivo
        // guardar esa info en un array
        //recorrer el array para buscar el dato que me pasan por param
        //recien ahi mostrarlo
        foreach ($usuarios as &$valor) 
        {
            echo "entro al foreach";
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


    public static function GenerarId()
    {
        $usuariosAux = Usuario::CargarUsuarios();
        
    }

    public static function OrdenarUsuariosDesc()
    {

    }

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'POST':
                //hacer validaciones aparte
                if (isset($_POST['nombre']) 
                && isset($_POST['clave'])
                && isset($_POST['mail'])
                )
                {
                    echo "/////////////////////// <br>";
                    var_dump($_POST);
                    echo "/////////////////////// <br>";
                    $usuario = Usuario::AgregarUsuario($_POST['nombre'], $_POST['clave'], $_POST['mail']);
                    $a =  new Archivador();
                    //var_dump(isset($_FILES['archivo']));
                    $a->GuardarArchivo('archivo','usuario/fotos/');
                    ArchivoJson::EscribirJson($usuario, "Ejercicio23_Usuarios.json");
                }
                break;
                
                
            case 'GET':
                var_dump($_GET);
                ArchivoJson::LeerJson("Ejercicio23_Usuarios.json");
                break;

        }
    }
}//class

Usuario::Operar();

?>