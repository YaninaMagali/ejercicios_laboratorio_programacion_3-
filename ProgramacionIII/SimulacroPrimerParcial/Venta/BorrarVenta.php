<?php
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Archivador.php';

function BorrarVenta($numero_pedido)
{
    //Valido si existe el pedido
    // Si existe, DELETE FROM
    // Mover foto a /BACKUPVENTAS

    // Reconstruir el path con los datos de la base?
    $fileName = 'moldetomateyani2021-10-17';
    $a = new Archivador;
    $a->CambiarDeDirectorio('Venta/ImagenesDeLaVenta/'.$fileName, 'Venta/BACKUPVENTAS');

}


?>