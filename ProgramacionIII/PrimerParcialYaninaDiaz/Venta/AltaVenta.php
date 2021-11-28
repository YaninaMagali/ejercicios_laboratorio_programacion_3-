<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Venta
{
    public $id;
    public $fecha;
    public $numero_pedido;
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $tieneDescuento;
    public $id_cupon;
    public $total;
    public $foto;

    public function __construct(){}

    public static function CrearVentaConCupon($fechaParam, $numeroPedidoParam, $mailParam, $saborParam, $tipoParam, $cantidadParam, $descuentoParam, $total, $id_cupon, $foto){
        $v = new Venta();
        $v->fecha = $fechaParam;
        $v->numero_pedido = $numeroPedidoParam;
        $v->mail = $mailParam;
        $v->sabor = $saborParam;
        $v->tipo = $tipoParam;
        $v->cantidad = $cantidadParam;
        $v->tieneDescuento = $descuentoParam;
        $v->total = $total;
        $v->id_cupon = $id_cupon;
        $v->foto = $foto;
        //var_dump($v);
        return $v;
    } 

    public static function ConsultarVentasPorNumeroPedido($numero){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `numero_pedido` = :numero_pedido;");
        $consulta->bindValue(':numero_pedido', $numero, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetchObject('Venta') ;
        //var_dump($resultado);
        return $resultado;    
}
}



?>