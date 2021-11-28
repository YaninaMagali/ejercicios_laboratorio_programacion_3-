<?php


class ConsultasDevoluciones{

    public static function ListarDevolucionesConCupones(){
        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM devolucion
        INNER JOIN cupon ON cupon.id = devolucion.id_cupon ;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function ListarDevolucionesOrdenadasPorUsuario(){
        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM devolucion
        INNER JOIN ventas ON ventas.numero_pedido = devolucion.numero_pedido 
        ORDER BY ventas.mail DESC;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function ListarDevolucionesOrdenadasPorFecha(){
        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM devolucion 
        ORDER BY fecha DESC;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC); 
    }

    public static function ConsultarDevolucionPorUsuarioYPedido($numero_pedido, $mail){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT devolucion.* FROM devolucion
        INNER JOIN ventas ON ventas.numero_pedido = devolucion.numero_pedido 
        WHERE ventas.numero_pedido = :numero_pedido AND ventas.mail = :mail ;");
        $consulta->bindValue(':numero_pedido', $numero_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':mail', $mail, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Devolucion');
    }
}
?>