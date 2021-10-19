<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function ValidarDatosVenta()
{
    $estadoData =  false;

    if(
        isset($_POST['mail']) 
        && isset($_POST['sabor']) 
        && isset($_POST['tipo']) 
        && isset($_POST['cantidad'])
    )
    {
        $estadoData =  true;
    }
    return $estadoData;
}

function ValidarDatosVentaPut($_PUT)
{
    $estadoData =  false;

    if(
        isset   ($_PUT['mail']) 
        && isset($_PUT['sabor']) 
        && isset($_PUT['tipo']) 
        && isset($_PUT['cantidad'])
        && isset($_PUT['numero_pedido'])
    )
    {
        $estadoData =  true;
    }

    return $estadoData;
}

function AltaVentaPost()
{
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/AltaVenta.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/FuncionesPizza.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/DAO.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Archivador.php';
    $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
    
    if(ValidarDatosVenta()
    && ConsultarPizzaEnJsonPost() == "Si hay"
    && PizzaConsultar::ValidarHayStock($_POST['sabor'], $_POST['tipo'], $listaPizzas, $_POST['cantidad'])
    )
    {
        $fecha = date("Y-m-d");
        $venta = AltaVenta::CrearVenta($fecha, $_POST['mail'], $_POST['sabor'], $_POST['tipo'], $_POST['cantidad']);
        $dao = new DAO();
        $dao->InsertarVenta($venta);

        $a =  new Archivador();
        $user = getUserFromEmail($_POST['mail']);
        $fileName = $_POST['tipo'] . $_POST['sabor'] . $user . $fecha;
        $a->GuardarArchivo('foto','Venta/ImagenesDeLaVenta/', $fileName);
        
    }
}

function ModificarVentaPut()
{
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/ModificarVenta.php';
    //echo "entro a ModificarVentaPut ";

    parse_str(file_get_contents("php://input"), $_PUT);
    
    if(ValidarDatosVentaPut($_PUT)
    && isset($_PUT['numero_pedido']))
    {
        if(ModificarVenta($_PUT['numero_pedido'], $_PUT['mail'], $_PUT['sabor'], $_PUT['tipo'], $_PUT['cantidad']))
        {
            echo "Modificacion exitosa ";
        }
        else{
            echo "No se pudo modificar. Verificar si existe el registro ";
        }
    }
    
}

function BorrarVentaDelete()
{
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Venta/BorrarVenta.php';
    parse_str(file_get_contents("php://input"), $_DELETE);
    var_dump($_DELETE);
    echo $_DELETE['numero_pedido'];
    if(isset($_DELETE['numero_pedido']))
    {
        if(BorrarVenta($_DELETE['numero_pedido']))
        {
            echo "se borro ok";
        }
        else
        {
            echo "NO se pudo borrar";
        }
    }
}

?>