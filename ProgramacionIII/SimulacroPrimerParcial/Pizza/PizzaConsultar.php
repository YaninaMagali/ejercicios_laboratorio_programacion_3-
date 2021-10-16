<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/PizzaCarga.php';


class PizzaConsultar
{
    public static function ConsultarSiPizzaExiste($sabor, $tipo, $listaPizzas)
    {

        //echo $sabor;
        //echo $tipo;
        $existe = $sabor;
        
        foreach($listaPizzas as $pizzaAux)
        {
            if($sabor == $pizzaAux->sabor
            && $tipo == $pizzaAux->tipo)
            { 
                $existe = "Si hay";
                break;
            }
        }
        return $existe;
    }

    public static function ConsultarStockActualPizza($sabor, $tipo, $listaPizzas)
    {
        $stockActual = 0;

        $index = -1; 
        for($i = 0; $i < count($listaPizzas); $i++)
        {
            if($sabor == $listaPizzas[$i]->sabor
            && $tipo == $listaPizzas[$i]->tipo)
            {
                $stockActual = $listaPizzas[$i]->cantidad;
                break;
            }
        }
        //echo $stockActual;

        return $stockActual;
    }

    public static function ValidarHayStock($sabor, $tipo, $listaPizzas, $cantidad)
    {
        $hay = false;
        if(PizzaConsultar::ConsultarStockActualPizza($sabor, $tipo, $listaPizzas) >= $cantidad)
        {
            $hay = true;
        }
        return $hay;
    }

}

?>