<?php

require_once "clase01.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 
class Garage
{
   private $razonSocial;
   private $precioPorHora;
   private $autos = [];
 
   function __construct()
   {
       $params = func_get_args();
       $num_params = func_num_args();
       $funcion_constructor ='__construct'.$num_params;
 
       if(method_exists($this,$funcion_constructor))
       {
           call_user_func_array(array($this,$funcion_constructor),$params);
       }
   }
 
   function __construct1($razonSocial)
   {
       $this->__construct2($razonSocial, 0.00);
   }
 
   function __construct2($razonSocial, $precioPorHora)
   {
       $this->razonSocial = $razonSocial;
       $this->precioPorHora = $precioPorHora;
   }
 
   function MostrarGarage()
   {
       echo $this->razonSocial."<br>";
       echo "$this->precioPorHora <br>";
       var_dump($this->autos)." <br>";
       echo "Cantidad de autos: ".count($this->autos)." <br>";
   }
 
   function Equals($auto)
   {
       $estaEnElGaraje = -1;
 
       if(count($this->autos) > 0)
       {
           for($i=0; $i<count($this->autos); $i++)
           {
               if($this->autos[$i]->Equals($auto))
               {
                   $estaEnElGaraje = $i;
                   break;
               }
           }
       }
 
 
 
       return $estaEnElGaraje;
   }
 
 
   function Add($auto)
   {
       if($this->Equals($auto) == -1)
       {
           $this->autos[count($this->autos)] = $auto;
       }
   }
 
   function Remove($auto)
   {
       $existe = $this->Equals($auto);
       if($existe > -1)
       {
           unset($this->autos[$existe]);
       }
 
   }
 
}//class
 
 
 
 
?>
