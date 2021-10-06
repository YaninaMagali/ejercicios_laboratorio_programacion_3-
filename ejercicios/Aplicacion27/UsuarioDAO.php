<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "DAO.php";

class UsuarioDAO
{
    public $DAO;

    public function __construct()
    {
        //Deberia levantar el connection String desde un archivo
        $this->DAO = new DAO('mysql', 'localhost', 'tp01sql', 'root', '');
    }

    public function ConsultarUsuarios()
	{
		$consulta = $this->DAO->PrepararConsulta("SELECT * from usuario");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
        //var_dump($consulta->fetchAll(PDO::FETCH_CLASS, "Usuario"));	
	}

}



?>