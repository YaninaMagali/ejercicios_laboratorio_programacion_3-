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

    public static function CrearVenta($id, $fecha, $numero_pedido, $mail, $sabor, $tipo, $cantidad)
    {
        $v = new AltaVenta();
        $v->id = $id;
        $v->fecha = $fecha;
        $v->numero_pedido= $numero_pedido;
        $v->$mail = $mail;
        $v->$sabor = $sabor;
        $v->$tipo = $tipo;
        $v->$cantidad = $cantidad;
        return $v;
    }

}
?>