<?php
require_once './db/DAO.php';

class Criptomoneda{

    public $id;
    public $precio;
    public $nombre;
    public $imagen;
    public $nacionalidad;

    public function InsertarCripto(){

        try{
            $dao = new DAO();
            $query = $dao->prepararConsulta("INSERT INTO criptos (precio, nombre, imagen, nacionalidad) 
            VALUES (:precio, :nombre, :imagen, :nacionalidad)");
            $query->bindValue(':precio', $this->precio, PDO::PARAM_INT);
            $query->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
            $query->bindValue(':imagen', $this->imagen, PDO::PARAM_STR);
            $query->bindValue(':nacionalidad', $this->nacionalidad, PDO::PARAM_STR);
            $query->execute();

            return $dao->obtenerUltimoId();
        }
        catch(Exception $e){
            throw $e;
        }

    }

    public static function CrearCripto($precio, $nombre, $imagen, $nacionalidad){
       
        $cripto = false;
        if($precio != null && $nombre != null && $imagen != null && $nacionalidad != null){
            $cripto = new Criptomoneda();
            $cripto->precio = $precio;
            $cripto->nombre = $nombre;
            $cripto->imagen = $imagen;
            $cripto->nacionalidad = $nacionalidad;
        }

        return $cripto;
    }

    public static function SelectCriptos(){ 

        try{
            $dao = new DAO();
            $query = $dao->prepararConsulta("SELECT * FROM criptos");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'Criptomoneda');
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public static function SelectCriptosPorNacionalidad($nacionalidad){ 

        try{
            $dao = new DAO();
            $query = $dao->prepararConsulta("SELECT * FROM criptos WHERE nacionalidad = :nacionalidad");
            $query->bindValue(':nacionalidad', $nacionalidad, PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'Criptomoneda');
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public static function SelectCriptosPorId($id){ 

        try{
            $dao = new DAO();
            $query = $dao->prepararConsulta("SELECT * FROM criptos WHERE id = :id");
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, 'Criptomoneda');
        }
        catch(Exception $e){
            throw $e;
        }
    }
}

?>