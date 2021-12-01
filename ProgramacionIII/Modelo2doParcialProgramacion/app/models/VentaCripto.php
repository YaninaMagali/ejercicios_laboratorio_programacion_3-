<?php

class VentaCripto{
    public $id;
    public $fecha;
    public $cantidad;
    public $idCripto;


    public function InsertarVenta(){

        try{
            $dao = new DAO();
            $query = $dao->prepararConsulta("INSERT INTO ventas (fecha, cantidad, idCripto) 
            VALUES (:fecha, :cantidad, :idCripto)");
            $query->bindValue(':fecha', $this->fecha, PDO::PARAM_INT);
            $query->bindValue(':cantidad', $this->cantidad, PDO::PARAM_STR);
            $query->bindValue(':idCripto', $this->idCripto, PDO::PARAM_INT);
            $query->execute();

            return $dao->obtenerUltimoId();
        }
        catch(Exception $e){
            throw $e;
        }

    }


    public static function CrearVenta($cantidad, $idCripto){
        $v = new VentaCripto();
        $fechaA =  date("Y-m-d H:i:s");
        $v->fecha = $fechaA;
        $v->cantidad = $cantidad;
        $v->idCripto = $idCripto;
        return $v;
    }

    
}
?>