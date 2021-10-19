<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Utils.php';

class Pizza
{
    public $id;
    public $sabor;
    public $tipo;
    public $precio;
    public $cantidad;

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

    public static function ConsultarSiPizzaExiste($pizza, $listaPizzas)
    {

        $existe = false;
        foreach($listaPizzas as $pizzaAux)
        {
            if($pizza->sabor == $pizzaAux->sabor
            && $pizza->tipo == $pizzaAux->tipo)
            {
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    public static function GetIndice($pizza, $listaPizzas)
    {
        $index = -1; 
        for($i = 0; $i < count($listaPizzas); $i++)
        {
            //echo $i . "<br>";
            if($pizza->sabor == $listaPizzas[$i]->sabor
            && $pizza->tipo == $listaPizzas[$i]->tipo)
            {
                $index = $i;
                
                break;
            }
        }
        return $index;
    }

    public static function ActualizarStockPizza($pizza, $listaPizzas)
    {
        //var_dump($pizza);
        foreach($listaPizzas as $p)
        {
            if($pizza->sabor == $p->sabor
            && $pizza->tipo == $p->tipo)
            {
                //var_dump($p);
                $p->precio = $pizza->precio;
                $p->cantidad += $pizza->cantidad;
                break;
            }
        }
    }



    public static function GenerarId($listaPizzas)
    {
       return GetMax($listaPizzas, "id") + 1;
    }
}

?>