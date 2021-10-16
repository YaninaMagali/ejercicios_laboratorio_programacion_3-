<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/ConsultasVentas.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/FuncionesPizza.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/FuncionesVenta.php';

class Index
{
    public static function Index()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        $paramMail = null;

        switch($metodo)
        {
            case 'POST':
                if(isset($_POST['mail'])) 
                {
                    AltaVentaPost();
                }
                else
                {
                    ConsultarPizzaEnJsonPost();
                }
                break;
            case 'GET': 
                CargarPizzaEnJsonGet();
                break;
        }
        }
}   
//Index::Index();
//ConsultarCantidadPizzasVendidas();
//ObtenerListaVentasPorFechaOrdenadaPorSabor('2021-10-01', '2021-10-03');
//ListaVentasPorUsuario('yanina@pepe.com');
//ListaVentasPorSabor('queso');
?>  