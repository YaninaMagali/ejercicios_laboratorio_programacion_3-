<?php



ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
define('ROOT', 'C:\xampp\htdocs\ejercicios\\');
require_once ROOT ."Aplicacion19/archivosCSV.php";
 
class Auto
{
  private $color;// (String)
  private $precio; //(Double)
  private $marca; //(String).
  private $fecha; //(DateTime)
 
  function __construct()
  {
     //obtengo un array con los parámetros enviados a la función
     $params = func_get_args();
     //saco el número de parámetros que estoy recibiendo
     $num_params = func_num_args();
 
     //cada constructor va a tener el nombre __construct.1, o __construct.2
     $funcion_constructor ='__construct'.$num_params;
 
     //compruebo si hay un constructor con ese número de parámetros
     if (method_exists($this,$funcion_constructor))
     {
        //si existe esa función, la invoco, reenviando los parámetros que recibí en el constructor original 
        call_user_func_array(array($this,$funcion_constructor),$params);
     }
  }//__construct
 
  function __construct2($marca, $color)
  { 
     $this->__construct3($marca, $color, 0.00);
  }
 
 
  function __construct3($marca, $color, $precio)
  {
     $this->__construct4($marca, $color, $precio, date("Y/m/d"));
  }
 
  function __construct4($marca, $color, $precio, $fecha)
  {
     $this->marca = $marca;
     $this->color = $color;
     $this->precio = $precio;
     $this->fecha = $fecha;
  }
 
  function AgregarImpuestos($impuesto)
  {
     return $this->precio + $impuesto;
  }
 
  public static function MostrarAuto($auto)
  {
     echo "$auto->marca <br>";
     echo "$auto->color <br>";
     echo "$auto->precio <br>";
     echo "$auto->fecha <br>";
  }
 
  function Equals($auto)
  {
     $sonIguales = False;
 
     if($this == $auto)
     {
        $sonIguales = True;
     }
 
     return $sonIguales;
  }
 
 
  public static function Add($auto1, $auto2)
  {
     $suma = 0;
     if($auto1->marca == $auto2->marca
     && $auto1->color == $auto2->color)
     {
        $suma = $auto1->precio + $auto2->precio;
     }
     return $suma;
 
  }

  public static function CrearAutoYGuardarEnCSV($marca, $color, $precio, $path)
  {
      
      $miAuto = new Auto($marca, $color, $precio);
      ArchivoCSV::Escribir($miAuto, $path);
   }
 
}


 
?>
