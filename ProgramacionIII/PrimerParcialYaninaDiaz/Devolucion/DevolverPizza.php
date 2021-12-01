<?php

use Illuminate\Support\Facades\Date;

require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/AltaVenta.php';

class Devolucion{

    public $id;
    public $fecha;
    public $numero_pedido;
    public $id_cupon;
    public $causa;
    public $foto;

    public static function ValidarDatosDevolucion(){
    
        $estadoDatos = false;
    
        if(isset($_POST['numero_pedido'])
        && isset($_POST['causa'])
        && Venta::ConsultarVentasPorNumeroPedido($_POST['numero_pedido'])){
            $estadoDatos = true;
        }
        var_dump($estadoDatos);
        return $estadoDatos;
    }
    
    static function DevolverPizza(){
    
        if(Devolucion::ValidarDatosDevolucion()){

            $cupones = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Cupon/cupones.json');
            $idCupon = Pizza::GenerarId($cupones);
            var_dump($idCupon);
            $c = Cupon::CrearCupon(10, $idCupon);
            //$idCupon = $c->InsertarCupon();
            array_push($cupones, $c);
            ArchivoJSON::EscribirJson($cupones, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Cupon/cupones.json');
            

            $devoluciones = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/devoluciones.json');
            $idDevolucion = Pizza::GenerarId($devoluciones);
            //CrearDevolucion($numero_pedido, $id_cupon, $causa)
            $devolucion = Devolucion::CrearDevolucion($idDevolucion, $_POST['numero_pedido'], $idCupon, $_POST['causa']);
            array_push($devoluciones, $devolucion);
            ArchivoJSON::EscribirJson($devoluciones, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/devoluciones.json');
            $devolucion->InsertarDevolucion();
            
            $a =  new Archivador();
            $a->GuardarArchivo('foto','Venta/ImagenesDevolucion/', "Pedido" . $_POST['numero_pedido']);
            
            return $devolucion->id_cupon;
            
        }
        else{
            echo "No existe pedido";
        }
}

    static function CrearDevolucion($idDevolucion,$numero_pedido, $id_cupon, $causa){
        
        $d = new Devolucion();
        $d->fecha = date("Y-m-d");
        $d->id = $idDevolucion;
        $d->numero_pedido = $numero_pedido;
        $d->id_cupon = $id_cupon;
        $d->causa = $causa;
        
        return $d;

    }

    function InsertarDevolucion(){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("INSERT INTO devolucion(`numero_pedido`, `id_cupon`, `causa`, `fecha`)
        VALUES (:numero_pedido, :id_cupon, :causa, :fecha);");
        $consulta->bindValue(':numero_pedido',$this->numero_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':id_cupon', $this->id_cupon, PDO::PARAM_INT);
        $consulta->bindValue(':causa', $this->causa, PDO::PARAM_STR);
        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);

        try{
            $consulta->execute();   
            echo "InsertarDevolucion OK <br>";
        }
        catch(Exception $e)
        {
            echo "Error en InsertarDevolucion<br>";
            var_dump($e);
        }
    }

}


?>