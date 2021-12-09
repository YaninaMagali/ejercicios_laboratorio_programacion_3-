<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('ROOT', 'C:\xampp\htdocs\ejercicios\\');
require_once ROOT ."Aplicacion19/archivosCSV.php";

class Usuario
{
    private $nombre;
    private $clave;
    private $mail;

    

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

    public static function MostrarUsuario($nombre, $clave, $mail)
    {
        //leer archivo
        // guardar esa info en un array
        //recorrer el array para buscar el dato que me pasan por param
        //recien ahi mostrarlo
        echo $nombre;
        echo $clave;
        echo $mail;
    }

    public static function ObtenerListaUsuario()
    {
        ArchivoCSV::Leer():
    }

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'POST':
                //if (isset($_POST['nombre'])){}
                $usuario = Usuario::AgregarUsuario($_POST['nombre'], $_POST['clave'], $_POST['mail']);
                ArchivoCSV::Escribir($usuario, "Ejercicio20_Usuarios.csv");
                break;
            case 'GET':
                var_dump($_GET);
                //Usuario::MostrarUsuario($_GET['nombre'], $_GET['clave'], $_GET['mail']);

        }
    }
}//class

Usuario::Operar();

?>