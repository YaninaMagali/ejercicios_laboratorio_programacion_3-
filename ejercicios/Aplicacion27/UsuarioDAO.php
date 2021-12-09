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
        $this->DAO = new DAO();
    }

    public function ConsultarUsuarios()
	{
		$consulta = $this->DAO->PrepararConsulta("SELECT * from usuario");
		$consulta->execute();			
		return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");	
	}

    public function InsertarUsuario($usuario)
    {
        echo "/////////// <br>";
        var_dump($usuario);
        echo "/////////// <br>";
        $consulta = $this->DAO->PrepararConsulta("INSERT INTO usuario(`nombre`, `apellido`, `clave`, `mail`, `fecha_registro`, `localidad`)
        VALUES (:nombre, :apellido, :clave, :mail, :fecha_registro, :localidad);");
        $consulta->bindValue(':nombre',$usuario->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $usuario->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave',$usuario->clave, PDO::PARAM_INT);
		$consulta->bindValue(':mail', $usuario->mail, PDO::PARAM_STR);
        //$consulta->bindValue(':fecha_registro', $usuario->fecha_registro, PDO::PARAM_DATE);
        //strtotime (date ("Y-m-d H:i:s")), pdo::PARAM_STR
        $consulta->bindValue(':localidad', $usuario->localidad, PDO::PARAM_STR);
        try{
            $consulta->execute();
        }
        catch(Exception $e)
        {
            echo "Error en UsuarioDAO<br>";

            var_dump($e);
        }
    }
}



?>