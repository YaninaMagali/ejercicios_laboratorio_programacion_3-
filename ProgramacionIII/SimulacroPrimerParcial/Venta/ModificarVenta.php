<?php
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/DAO.php';
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function ConsultarVentaExacta($numero_pedido, $mail, $sabor, $tipo)
{
    echo "ConsultarVentaExacta <br>";
    $resultado = null;

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `mail` = :mail AND `numero_pedido` = :numero_pedido AND `sabor` = :sabor AND `tipo` = :tipo;");
    $consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
    $consulta->bindValue(':numero_pedido',$numero_pedido, PDO::PARAM_INT);
    $consulta->bindValue(':sabor',$sabor, PDO::PARAM_STR);
    $consulta->bindValue(':tipo',$tipo, PDO::PARAM_STR);

    $consulta->execute();
    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    return $resultado;  
}

function ModificarVenta($numero_pedido, $mail, $sabor, $tipo, $cantidad)
{
    echo "ModificarVenta <br>";

    if(ConsultarVentaExacta($numero_pedido, $mail, $sabor, $tipo)!= false)
    {
        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("UPDATE ventas SET `cantidad` = :cantidad WHERE `mail` = :mail AND `numero_pedido` = :numero_pedido AND `sabor` = :sabor AND `tipo` = :tipo;");
        $consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
        $consulta->bindValue(':numero_pedido',$numero_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':sabor',$sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad',$cantidad, PDO::PARAM_INT);

        try{
            $consulta->execute();   
            echo "ModificarVenta OK <br>";
        }
        catch(Exception $e)
        {
            echo "Error en ModificarVenta<br>";

            var_dump($e);
        }

    }
}

?>