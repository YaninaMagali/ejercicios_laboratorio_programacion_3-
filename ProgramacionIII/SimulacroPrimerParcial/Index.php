<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Index
{
    public static function Index()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];

        switch($metodo)
        {
            case 'POST':
                require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/PizzaConsultar.php';
                require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
                if(isset($_POST['sabor'])
                && isset($_POST['tipo']))
                {
                    $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza.json');
                    PizzaConsultar::ConsultarSiPizzaExiste($_POST['sabor'], $_POST['tipo'], $listaPizzas);
                }
                break;
            case 'GET': 
                require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/PizzaCarga.php';
                require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
                if(isset($_GET['sabor'])
                && isset($_GET['tipo'])
                && isset($_GET['precio'])
                && isset($_GET['cantidad']))
                {
                    $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza.json');
                    $id = Pizza::GenerarId($listaPizzas);
                    echo $id;
                    $pizza = Pizza::CargarPizza($id,$_GET['sabor'], $_GET['tipo'], $_GET['precio'], $_GET['cantidad']);
                    
                    
                    if(! Pizza::ConsultarSiPizzaExiste($pizza, $listaPizzas))
                    {
                        ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza.json');
                    }
                    else
                    {
                        echo "<br> actualizar Stock <br>";
                        Pizza::ActualizarStockPizza($pizza, $listaPizzas);
                        ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza.json');
                    }
                    
                }
                break;
        }
        }
}   
Index::Index();

?>  