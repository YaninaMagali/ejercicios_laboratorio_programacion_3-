<?php
///GDB: https://onlinegdb.com/i-jGR2Nd2


ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('ROOT', 'C:\xampp\htdocs\ejercicios\\');
require_once ROOT ."Aplicacion19/archivosCSV.php";

echo "App 21 <br>";
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

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'POST':
                $usuario = Usuario::AgregarUsuario($_POST['nombre'], $_POST['clave'], $_POST['mail']);
                ArchivoCSV::Escribir($usuario, "Ejercicio20_Usuarios.csv");
                break;
            case 'GET':
                $listado = $_GET['listado'];
                switch($listado)
                {
                    case 'usuarios':
                        $arrayUsuarios = [];
                        ///ArchivoCSV esta en Aplicacion19
                        $arrayUsuarios = ArchivoCSV::Leer2("Ejercicio20_Usuarios.csv", $arrayUsuarios);
                        echo "GET <br>";
                        var_dump($arrayUsuarios);
                        break;
                }
                



        }
    }
}//class

Usuario::Operar();

?>