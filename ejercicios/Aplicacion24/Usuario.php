<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'GET':
                $queryParam = 
                break;
        }
    }

}



?>