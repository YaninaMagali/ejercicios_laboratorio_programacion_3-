<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\ArchivoJSON.php';

class PizzaConsultar
{
    public static function ConsultarSiPizzaExiste($sabor, $tipo)
    {

        $existe = $sabor;
        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
        
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

    public static function ConsultarSiPizzaExiste2($sabor, $tipo){

        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
        $saborRetorno;
        $tipoRetorno;
        $j = count($listaPizzas);

        for($i = 0; $i < $j; $i++){
            if($sabor == $listaPizzas[$i]->sabor 
            && $tipo == $listaPizzas[$i]->tipo){
                return "Si hay";
            }
            else{
                if($sabor != $listaPizzas[$i]->sabor){
                    $saborRetorno = "No hay sabor $sabor " ;
                }
                if($tipo != $listaPizzas[$i]->tipo){
                    $tipoRetorno = "No hay tipo $tipo";
                }
                if($i == $j -1){
                    echo $tipoRetorno .$saborRetorno;
                }
            }
        }
    }

    public static function ConsultarStockActualPizza($sabor, $tipo, $listaPizzas)
    {
        $stockActual = 0;
        $j = count($listaPizzas);
        $index = -1; 
        for($i = 0; $i < $j; $i++)
        {
            if($sabor == $listaPizzas[$i]->sabor
            && $tipo == $listaPizzas[$i]->tipo)
            {
                return $listaPizzas[$i]->cantidad;
                
            }
        }
        //echo $stockActual;
        return $stockActual;
    }
}


?>