<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function GetMax($array, $datoAObtenerMax)
{
    var_dump($array);
    $max = 0;
    for($i=0; $i < count($array); $i++)
    {
        if($i == 0 ||
        $array[$i]->$datoAObtenerMax > $max)
        {
            $max = $array[$i]->$datoAObtenerMax;
        }
    }
    return $max;
}

// function GetMin($array, $datoAObtenerMax)
// {
//     $min = null;

//     for($i=0; $i < count($array); $i++)
//     {
//         if($i == 0 ||
//         $array[$i]->$datoAObtenerMax < $min)
//         {
//             $min = $array[$i]->$datoAObtenerMax;
//         }
//     }
//     return $min;
// }

function getUserFromEmail($mail)
{
    $user = strstr($mail, '@', true); // Desde PHP 5.3.0
    return $user; // mostrará name
}

?>