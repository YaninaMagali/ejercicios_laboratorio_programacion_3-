<?php

function ValidarRecepcionSaborYTipo()
{
    $estadoDatos = false;

    if(isset($_POST['sabor'])
    && isset($_POST['tipo']))
    {
        $estadoDatos = true;
    }
    return $estadoDatos;
}

function ValidarDatosCrearPizzaGet()
{
    $estadoData = false;
    if(isset($_GET['sabor'])
    && isset($_GET['tipo'])
    && isset($_GET['precio'])
    && isset($_GET['cantidad']))
    {
        $estadoData = true;
    }
    return $estadoData;

}

function ValidarDatosCrearPizzaPost()
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

function ConsultarPizzaEnJsonPost()
{
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/PizzaConsultar.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
    if(ValidarRecepcionSaborYTipo())
    {
        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        //echo(PizzaConsultar::ConsultarSiPizzaExiste($_POST['sabor'], $_POST['tipo'], $listaPizzas));
        return PizzaConsultar::ConsultarSiPizzaExiste($_POST['sabor'], $_POST['tipo'], $listaPizzas);
        
    }
}

function CargarPizzaEnJsonGet()
{
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/PizzaCarga.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
    if(ValidarDatosCrearPizzaGet())
    {
        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        $id = Pizza::GenerarId($listaPizzas);
        //echo $id;
        $pizza = Pizza::CargarPizza($id,$_GET['sabor'], $_GET['tipo'], $_GET['precio'], $_GET['cantidad']);
        
        
        if(! Pizza::ConsultarSiPizzaExiste($pizza, $listaPizzas))
        {
            echo "<br> Cargo Pizza nueva en Json <br>";
            ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        }
        else
        {
            echo "<br> actualizar Stock <br>";
            Pizza::ActualizarStockPizza($pizza, $listaPizzas);
            ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        }
        
    }
}

function CargarPizzaEnJsonPost()
{

    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Pizza/PizzaCarga.php';
    require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/ArchivoJSON.php';
    if(ValidarDatosCrearPizzaPost())
    {
        $listaPizzas = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        $id = Pizza::GenerarId($listaPizzas);
        //echo $id;
        $pizza = Pizza::CargarPizza($id,$_POST['sabor'], $_POST['tipo'], $_POST['precio'], $_POST['cantidad']);
        
        
        if(! Pizza::ConsultarSiPizzaExiste($pizza, $listaPizzas))
        {
            echo "<br> Cargo Pizza nueva Post <br>";
            ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
            $a =  new Archivador();
            $fileName = $_POST['tipo'] . $_POST['sabor'];
            $a->GuardarArchivo('foto','Pizza/ImagenesDePizzas/', $fileName);
        }
        else
        {
            echo "<br> actualizar Stock <br>";
            Pizza::ActualizarStockPizza($pizza, $listaPizzas);
            ArchivoJSON::EscribirJson($pizza, 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial\Pizza/Pizza.json');
        }
        
    }

}

?>