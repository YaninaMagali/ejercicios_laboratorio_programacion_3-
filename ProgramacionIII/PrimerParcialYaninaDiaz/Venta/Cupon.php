<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Cupon{
    public $id;
    public $fecha;
    public $importe_descuento;
    public $esta_usado;

    static function ConsultarCupon($idCupon){

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM cupon WHERE `id` = :id;");
    $consulta->bindValue(':id',$idCupon, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchObject('Cupon') ;
    }

    static function ActualizarCuponAUsado($idCupon){
        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("UPDATE cupon SET esta_usado = 1 WHERE `id` = :id;");
        $consulta->bindValue(':id',$idCupon, PDO::PARAM_INT);
        $consulta->execute();
    }

    public function InsertarCupon(){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("INSERT INTO cupon(`importe_descuento`, `esta_usado`, `fecha`)
        VALUES (:importe_descuento, :esta_usado, :fecha);");
        $consulta->bindValue(':importe_descuento',$this->importe_descuento, PDO::PARAM_INT);
        $consulta->bindValue(':esta_usado', $this->esta_usado, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);

        try{
            $consulta->execute(); 
            return $dao->obtenerUltimoId();
              
            //echo "Insertar Cupon OK <br>";
        }
        catch(Exception $e)
        {
            //echo "Error en Insertar Cupon<br>";
            var_dump($e);
        }
    }

    public static function CrearCupon($importe_descuento, $id){
        $c = new Cupon();
        $c->id = $id;
        $c->importe_descuento = $importe_descuento;
        $c->esta_usado = 0;
        $c->fecha = date("Y-m-d");
        return $c;
    }


}
?>