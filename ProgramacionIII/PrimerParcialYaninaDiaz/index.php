<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/FuncionesPizza.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/FuncionesVenta.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/ConsultasVentas.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/DevolverPizza.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/ConsultasDevoluciones.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Cupon/ConsultarCupones.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/ModificarDevolucion.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/BorrarVenta.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\ConsultasEspeciales.php';




class Index
{
    public static function Index()
    {
        $metodo = $_SERVER["REQUEST_METHOD"];
        switch($metodo)
        {
            case 'POST': 
                $opcion = $_POST["opcion"];
                switch($opcion)
                {
                    case'alta':
                        AltaPizzaPost();
                        break;
                    case'consulta':
                        ConsultaPizzaPost();
                        break;
                    case 'altaVenta':
                        AltaVentaPostCupon();
                        break;
                    case 'devolucion':
                        Devolucion::DevolverPizza();
                        break;
                }
            case 'GET': 
                $opcion = $_GET["opcion"];
                switch($opcion)
                {
                    case'devoluciones':
                        var_dump(ConsultasDevoluciones::ListarDevolucionesConCupones());
                        break;
                    case'devolucionesPorUsuario':
                        var_dump(ConsultasDevoluciones::ListarDevolucionesOrdenadasPorUsuario());
                        break;
                    case 'devolucionesPorFecha':
                        var_dump(ConsultasDevoluciones::ListarDevolucionesOrdenadasPorFecha());
                        break;
                    case 'cupones':
                        var_dump(ConsultarCupones::ConsultarTodosCupones());
                        break;
                    case 'cuponesPorUsuario':
                        var_dump(ConsultarCupones::ConsultarCuponesOrdenadosPorUsuario());
                        break;
                    case 'cuponesPorFecha':
                        //var_dump(ConsultarCupones::ConsultarCuponesOrdenadosPorFecha( $_GET["fecha"]));
                        $consulta = new ConsultarCupones();
                        var_dump($consulta->ConsultarCuponesJsonOrdenadosPorFecha());
                        break;
                    case 'imagenes':
                        var_dump(ConsultasEspeciales::ListarImagenes($_GET["tipo"]));
                        break;
                    case 'ventasEliminadas':
                        var_dump(ConsultasEspeciales::ConsultarVentasEliminadas());
                        break;
                    case 'ListarDevolucionesYCupones':
                        var_dump(ConsultasEspeciales::ListarDevolucionesYCupones());
                        break;
                }
                break;
            case 'PUT': 
                ModificarDevolucion::ModificarDevolucion();
                break;
            case 'DELETE':
                BorrarVenta::EliminarVenta();
                break;
        }
    }
}   
Index::Index();
//echo(ConsultarCantidadPizzasVendidasPorDia('2021-10-17'));
//echo(ConsultarCantidadPizzasVendidasPorDia());
//var_dump(ObtenerListaVentasPorFechaOrdenadaPorSabor('2021-10-17', '2021-10-20'));

