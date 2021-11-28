<?php

class ModificarDevolucion{

    public static function ValidarDatosModificacion($_PUT){
        $estadoData = false;

        if(isset($_PUT['mail'])
        && isset($_PUT['numero_pedido'])){
            $estadoData = true;
        }
        return $estadoData;
    }

    public static function ModificarDevolucion(){
        
        parse_str(file_get_contents("php://input"), $_PUT);

        if(ModificarDevolucion::ValidarDatosModificacion($_PUT)
        && ConsultasDevoluciones::ConsultarDevolucionPorUsuarioYPedido($_PUT['numero_pedido'], $_PUT['mail'])
        )
        {
            echo "Llamar al UPDATE";
            ModificarDevolucion::UpdateDevolucion($_PUT['causa'], $_PUT['numero_pedido']);
        }
        else{
            echo "NO se puede modificar. Verificar pedido y usuario";
        }
    }

    public static function UpdateDevolucion($nuevaCausa, $numero_pedido){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("UPDATE devolucion SET causa = :causa
        WHERE numero_pedido = :numero_pedido ;");
        $consulta->bindValue(':numero_pedido', $numero_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':causa', $nuevaCausa, PDO::PARAM_STR);
        $consulta->execute();
    }





}

?>