<?php

class BorrarVenta{

    public static function ValidarDatosEliminarVenta($_DELETE){
        $estadoData = false;

        if(isset($_DELETE['numero_pedido'])){
            $estadoData = true;
        }
        return $estadoData;
    }

    public static function EliminarVenta(){

        parse_str(file_get_contents("php://input"), $_DELETE);
        if(BorrarVenta::ValidarDatosEliminarVenta($_DELETE)){
            $ventaAux = Venta::ConsultarVentasPorNumeroPedido($_DELETE['numero_pedido']);
            if($ventaAux){
                BorrarVenta::DeleteVenta($_DELETE['numero_pedido']);
                $a =  new Archivador();
                $a->CambiarDeDirectorio('Venta/ImagenesDeLaVenta/'. $ventaAux->foto, 'Venta/BackupVenta/'. $ventaAux->foto);
                echo "Venta eliminada exitosamente";
            }
            else{
                echo "No se pudo eliminar venta. Verificar numero_pedido";
            }
        }
        else{
            echo "No se pudo eliminar venta";
        }

    }


public static function DeleteVenta($numero_pedido){

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("DELETE FROM ventas WHERE numero_pedido = :numero_pedido;");
    $consulta->bindValue(':numero_pedido', $numero_pedido, PDO::PARAM_INT);
    
    return $consulta->execute();
}



}
?>