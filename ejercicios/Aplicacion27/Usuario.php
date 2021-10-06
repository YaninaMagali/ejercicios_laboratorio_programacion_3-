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

    // public function __construct($id, $nombre, $apellido, $clave, $fecha_registro, $localidad, $mail)
    // {
    //     $this->id = $id;    
    //     $this->nombre = $nombre ;
    //     $this->apellido = $apellido;
    //     $this->clave = $clave;
    //     $this->fecha_registro = $fecha_registro;
    //     $this->localidad = $localidad;
    //     $this->mail = $mail;
    // }

    public static function Operar()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];

        switch($metodo)
        {
            case 'GET':
                //preguntar por la opcion
                $queryParams = $_POST['opcion'];
                //hacer consulta
                $dao = new UsuarioDAO();
                echo "dao en case GET<br>";
                var_dump($dao);
                $dao->ConsultarUsuarios();
                break;
        }
    }

}

Usuario::Operar();

?>