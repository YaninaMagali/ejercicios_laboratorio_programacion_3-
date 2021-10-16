<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/PizzaCarga.php';


class PizzaConsultar
{
    public static function ConsultarSiPizzaExiste($sabor, $tipo, $listaPizzas)
    {

        $existe = null;

        foreach($listaPizzas as $pizzaAux)
        {
            if($sabor == $pizzaAux->sabor
            && $tipo == $pizzaAux->tipo)
            {
                $existe = "SI hay";
                break;
            }
            else
            {
                $existe = $pizza->sabor;
            }
        }
        return $existe;
    }

    public static function ConsultarStockPizza($pizza, $listaPizzas)
    {
        $stockActual = 0;

        $index = -1; 
        for($i = 0; $i < count($listaPizzas); $i++)
        {
            if($pizza->sabor == $listaPizzas[$i]->sabor
            && $pizza->tipo == $listaPizzas[$i]->tipo)
            {
                $stockActual = $listaPizzas[$i]->cantidad;
                break;
            }
        }
        return $stockActual;
    }
}

?>