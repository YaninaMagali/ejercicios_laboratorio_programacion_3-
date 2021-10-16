<?php

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
        echo "ACa inserto en la DB <br>";
        $fecha = date("Y-m-d");
        $venta = AltaVenta::CrearVenta($fecha, $_POST['mail'], $_POST['sabor'], $_POST['tipo'], $_POST['cantidad']);
        $dao = new DAO();
        $dao->InsertarVenta($venta);
        //ActualizarStock en Json
        //PizzaCarga::ActualizarStockPizza($pizza, $listaPizzas)
        $a =  new Archivador();
        //tipo+sabor+mail(solo
        $user = getUserFromEmail($_POST['mail']);
        
        $fileName = $_POST['tipo'] . $_POST['sabor'] . $user . $fecha;
        $a->GuardarArchivo('foto','Venta/ImagenesDeLaVenta/', $fileName);
        
    }


}

?>