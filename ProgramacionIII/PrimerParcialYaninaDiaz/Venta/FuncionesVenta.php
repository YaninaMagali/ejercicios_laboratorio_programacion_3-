<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/AltaVenta.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\DAO.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Archivador.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/Cupon.php';


function ValidarDatosVentaPost(){
    $estadoData =  false;

    if(
        isset($_POST['mail']) 
        && isset($_POST['sabor']) 
        && isset($_POST['tipo']) 
        && isset($_POST['cantidad'])
        && isset($_POST['numero_pedido'])
        )
    {
        $estadoData =  true;
    }

    return $estadoData;
}

function AltaVentaPostCupon(){
    $total = 0;
    $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
    
    if(ValidarDatosVentaPost()
    && PizzaConsultar::ConsultarSiPizzaExiste($_POST['sabor'], $_POST['tipo'], $listaPizzas)
    && PizzaConsultar::ConsultarStockActualPizza($_POST['sabor'], $_POST['tipo'], $listaPizzas) >= $_POST['cantidad'])
    {
        if(isset($_POST['id_cupon']))
        {
            $cupon = Cupon::ConsultarCupon($_POST['id_cupon']);
            if( $cupon != null && $cupon->esta_usado == 0){
                $total = CalcularTotalConDescuento($_POST['cantidad'], $_POST['precio'],$cupon->importe_descuento);
                Cupon::ActualizarCuponAUsado($_POST['id_cupon']);
            }
            else{
                $total = CalcularTotalSinDescuento($_POST['cantidad'], $_POST['precio']);
            }
        }
        else{
            $total = CalcularTotalSinDescuento($_POST['cantidad'], $_POST['precio']);
            
        }
        
        $fecha = date("Y-m-d");
        $mail = getUserFromEmail($_POST['mail']);
        $fileName = $_POST['tipo'] . $_POST['sabor'] . $mail . $fecha;
        $venta = Venta::CrearVentaConCupon($fecha, $_POST['numero_pedido'], $_POST['mail'], $_POST['sabor'], $_POST['tipo'], $_POST['cantidad'], $_POST['tiene_descuento'], $total, $_POST['id_cupon'], $fileName);
        $dao = new DAO();
        $dao->InsertarVenta($venta);
        $pizzaAux = Pizza::CargarPizza(1, $_POST['sabor'], $_POST['tipo'], $_POST['precio'], $_POST['cantidad']);
        Pizza::BajarStockPizza($pizzaAux, $listaPizzas);
        ArchivoJSON::EscribirJson($listaPizzas, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
        
        $a =  new Archivador();
        $a->GuardarArchivo('foto','Venta/ImagenesDeLaVenta/', $fileName);
    }
    
}

function CalcularTotalConDescuento($cantidad, $precio, $descuento){

    return  ($cantidad * $precio ) - $descuento;
}

function CalcularTotalSinDescuento($cantidad, $precio){

    return $cantidad * $precio;
}

function getUserFromEmail($mail)
{
    $user = strstr($mail, '@', true); 
    return $user;
}

?>