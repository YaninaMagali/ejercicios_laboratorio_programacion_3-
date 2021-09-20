<?php
 
require_once "clase01.php";
echo "INICIO <br>";
 
$miAuto = new Auto("citroen","azul");
$miAuto2 = new Auto("citroen","verde");
 
$miAuto3 = new Auto("citroen","azul", 2.22);
$miAuto4 = new Auto("citroen","azul", 1.22);
 
$miAuto5 = new Auto("citroen","rojo", 40.22, date("d M Y"));
 
echo $miAuto3->AgregarImpuestos(1500);
echo "<br>";
echo $miAuto4->AgregarImpuestos(1500);
echo "<br>";
echo $miAuto5->AgregarImpuestos(1500);
echo "<br>";
 
echo "Suma de autos 1 y 2 con impuestos <br>";
echo $miAuto->AgregarImpuestos(1500) + $miAuto2->AgregarImpuestos(1500);
echo "<br>";
 
if($miAuto->Equals($miAuto2)
&& $miAuto->Equals($miAuto5)
)
{ echo "Los tres autos son iguales <br>";}
else{ echo "NO son iguales <br>";}
 
 
Auto::MostrarAuto($miAuto);
Auto::MostrarAuto($miAuto3);
Auto::MostrarAuto($miAuto5);

Auto::CrearAutoYGuardarEnCSV("PEUGOT", "GRIS", 35555000, "FuncionCrearAutoYGuardar.csv")
?>
