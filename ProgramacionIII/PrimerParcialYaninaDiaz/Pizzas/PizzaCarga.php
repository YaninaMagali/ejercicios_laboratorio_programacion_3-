<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Pizza
{
    public function __construct(){}

    public static function CargarPizza($id, $sabor, $tipo, $precio, $cantidad)
    {
        $p = new Pizza();
        $p->id = $id;
        $p->sabor = $sabor;
        $p->tipo = $tipo;
        $p->precio = $precio;
        $p->cantidad = $cantidad;
        return $p;
    }

    public static function ConsultarSiPizzaExiste($sabor, $tipo, $listaPizzas)
    {
        $existe = false;
        
        foreach($listaPizzas as $pizzaAux)
        {
            if($sabor == $pizzaAux->sabor
            && $tipo == $pizzaAux->tipo)
            { 
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    public static function SumarStockPizza($pizza, $listaPizzas)
    {
        foreach($listaPizzas as $p)
        {
            if($pizza->sabor == $p->sabor
            && $pizza->tipo == $p->tipo)
            {
                $p->precio = $pizza->precio;
                $p->cantidad += $pizza->cantidad;
                break;
            }
        }
    }

    public static function BajarStockPizza($pizza, $listaPizzas)
    {
        foreach($listaPizzas as $p)
        {
            if($pizza->sabor == $p->sabor
            && $pizza->tipo == $p->tipo)
            {
                $p->precio = $pizza->precio;
                $p->cantidad -= $pizza->cantidad;
                break;
            }
        }
    }

    public static function GenerarId($listaPizzas)
    {
       return Pizza::GetMax($listaPizzas, "id") + 1;
    }

    public static function GetMax($array, $datoAObtenerMax)
    {
        $max = 0;
        for($i=0; $i < count($array); $i++)
        {
            if($i == 0 ||
            $array[$i]->$datoAObtenerMax > $max)
            {
                $max = $array[$i]->$datoAObtenerMax;
            }
        }
        return $max;
    }



}



?>