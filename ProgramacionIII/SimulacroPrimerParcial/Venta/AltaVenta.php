<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class AltaVenta
{
    public $id;
    public $fecha;
    public $numero_pedido;
    public $mail;
    public $sabor;
    public $tipo;
    public $cantidad;

    public function __construct(){}

    public static function CrearVenta($fechaParam, $mailParam, $saborParam, $tipoParam, $cantidadParam)
    {
        $v = new AltaVenta();
        //$v->id = $id;
        $v->fecha = $fechaParam;
        //$v->numero_pedido= $numero_pedido;
        $v->mail = $mailParam;
        $v->sabor = $saborParam;
        $v->tipo = $tipoParam;
        $v->cantidad = $cantidadParam;
        //echo "Crear venta ////////////////////////////////// <br>";
        //var_dump ($v);
        return $v;
    }

}
?>