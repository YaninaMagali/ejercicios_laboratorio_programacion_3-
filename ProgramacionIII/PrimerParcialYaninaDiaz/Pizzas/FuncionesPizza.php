<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/PizzaCarga.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Archivador.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\ArchivoJSON.php';
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/PizzaConsultar.php';


function ValidarDatosAltaPizzaPost()
{
    $estadoData = false;
    if(isset($_POST['sabor'])
    && isset($_POST['tipo'])
    && isset($_POST['precio'])
    && isset($_POST['cantidad']))
    {
        $estadoData = true;
    }
    return $estadoData;
}

function ValidarDatosConsultaPost()
{
    $estadoData = false;
    if(isset($_POST['sabor'])
    && isset($_POST['tipo']))
    {
        $estadoData = true;
    }
    return $estadoData;
}

function AltaPizzaPost()
{
    if(ValidarDatosAltaPizzaPost())
    {
        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
        $id = Pizza::GenerarId($listaPizzas);
        $pizza = Pizza::CargarPizza($id, $_POST['sabor'], $_POST['tipo'], $_POST['precio'], $_POST['cantidad']);
        
        if(! Pizza::ConsultarSiPizzaExiste($_POST['sabor'], $_POST['tipo'], $listaPizzas))
        {
            array_push($listaPizzas, $pizza);
            ArchivoJSON::EscribirJson($listaPizzas, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
            $a =  new Archivador();
            $fileName = $_POST['tipo'] . $_POST['sabor'];
            $a->GuardarArchivo('foto','Pizzas/ImagenesDePizzas/', $fileName);
        }
        else
        {
            Pizza::SumarStockPizza($pizza, $listaPizzas);
            ArchivoJSON::EscribirJson($listaPizzas, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Pizzas/Pizza.json');
        }
        
    }
}

function ConsultaPizzaPost()
{
    if(ValidarDatosConsultaPost())
    {
        echo PizzaConsultar::ConsultarSiPizzaExiste2($_POST['sabor'], $_POST['tipo']);
    }
}


?>