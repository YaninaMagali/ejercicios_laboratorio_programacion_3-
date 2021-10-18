<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Archivador.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/ConsultasVentas.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/FuncionesPizza.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/FuncionesVenta.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/ModificarVenta.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/BorrarVenta.php';

class Index
{
    public static function Index()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        $paramMail = null;

        switch($metodo)
        {
            case 'POST':
                $operacionPost = ($_POST['operacion']);
                switch($operacionPost)
                {
                    case 'consultarPizza':
                        ConsultarPizzaEnJsonPost();
                        break;
                    case 'cargarPizzaPost':
                        CargarPizzaEnJsonPost();
                        break;
                    case 'altaVentaPost':
                        AltaVentaPost();
                        break;
                }
            case 'GET': 
                CargarPizzaEnJsonGet();
                break;
            case 'PUT': 
                if ('PUT' === $metodo) {
                    //parse_str(file_get_contents('php://input'), $_PUT);
                    //var_dump($_PUT); //$_PUT contains put fields 
                    ModificarVentaPut();
                }
                
                break;
            case 'DELETE': 
                BorrarVentaDelete();
                break;
        }
        }
}   
Index::Index();
//ConsultarCantidadPizzasVendidas();
//ObtenerListaVentasPorFechaOrdenadaPorSabor('2021-10-01', '2021-10-03');
//ListaVentasPorUsuario('yanina@pepe.com');
//ListaVentasPorSabor('queso');
//ConsultarVentaExacta(0, 'ariel@mail.com', 'queso', 'molde');
//ModificarVenta(0, 'ariel@mail.com', 'queso', 'molde', 200);
?>  