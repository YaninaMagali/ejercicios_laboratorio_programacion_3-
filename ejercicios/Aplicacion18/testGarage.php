<?php
require_once "Garage.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 
$garage = new Garage("Razon social Garage", 4.55);
$miAuto5 = new Auto("Ford","azul", 1.22);
$miAuto6 = new Auto("Ford","azul", 1.22);
 
echo"Mostrar: <br>";
$garage->MostrarGarage();
 
echo"<br>";
echo"<br>";
 
echo"Add: <br>";
$garage->Add($miAuto5);
 
 
echo"Mostrar: <br>";
$garage->MostrarGarage();
 
echo"<br>";
echo"<br>";
 
echo"Add: <br>";
$garage->Add($miAuto6);
 
echo"<br>";
echo"<br>";
 
echo"Mostrar: <br>";
$garage->MostrarGarage();
 
echo"Remove: <br>";
$garage->Remove($miAuto5);
 
echo"<br>";
echo"<br>";
 
echo"Mostrar: <br>";
$garage->MostrarGarage();
?>
