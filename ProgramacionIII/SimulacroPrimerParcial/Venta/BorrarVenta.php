<?php
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/Archivador.php';

function BorrarVenta($numero_pedido)
{
    
    if(BorrarVentaDeDB($numero_pedido))
    {
        // Reconstruir el path con los datos de la base?
        $fileName = 'moldetomateyani2021-10-17';
        $a = new Archivador;
        $a->CambiarDeDirectorio('Venta/ImagenesDeLaVenta/'.$fileName, 'Venta/BACKUPVENTAS/'.$fileName);
    }
}

function BorrarVentaDeDB($numero_pedido)
{
    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("DELETE FROM ventas WHERE `numero_pedido` = :numero_pedido;");
    $consulta->bindValue(':numero_pedido',$numero_pedido, PDO::PARAM_INT);

    return $consulta->execute();
}


?>