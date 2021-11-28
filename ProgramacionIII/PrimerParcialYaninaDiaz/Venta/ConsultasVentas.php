<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function ConsultarCantidadPizzasVendidasPorDia($fecha = null){
    if(!$fecha){
        $fecha = date("Y-m-d");
    }
    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT SUM(cantidad) AS total FROM ventas WHERE `fecha` = :fecha;");
    $consulta->bindValue(':fecha',$fecha, PDO::PARAM_STR);
    $consulta->execute();
    return $consulta->fetchColumn();    
}

function ConsultarCantidadPizzasVendidas($fecha)
{
    if($fecha == null)
    {
        $fecha = $fecha = date("Y-m-d");
    }

    ConsultarCantidadPizzasVendidasPorDia($fecha);
    
}

function ObtenerListaVentasPorFechaOrdenadaPorSabor($fecha1, $fecha2)
{
    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `fecha` >= :fecha1 AND `fecha` <= :fecha2 ORDER BY `sabor` ;");
    $consulta->bindValue(':fecha1',$fecha1, PDO::PARAM_STR);
    $consulta->bindValue(':fecha2',$fecha2, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;

}

function ListaVentasPorUsuario($usuarioMail)
{
    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `mail` = :mail;");
    $consulta->bindValue(':mail',$usuarioMail, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;  
}

function ListaVentasPorSabor($sabor)
{
    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `sabor` = :sabor;");
    $consulta->bindValue(':sabor',$sabor, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;    
}




?>
