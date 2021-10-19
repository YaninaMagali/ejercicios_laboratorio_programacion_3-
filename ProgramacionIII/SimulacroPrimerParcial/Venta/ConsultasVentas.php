<?php
require_once 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\SimulacroPrimerParcial/DAO.php';

function ConsultarCantidadPizzasVendidas()
{
    echo "ConsultarCantidadPizzasVendidas";

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT SUM(cantidad) AS total FROM ventas;");
    $consulta->execute();
    //$fila = $consulta->fetch(PDO::FETCH_ASSOC);
    //echo $fila['total'];
    return $consulta->fetchColumn();

}

function ObtenerListaVentasPorFechaOrdenadaPorSabor($fecha1, $fecha2)
{
    //echo "ObtenerListaVentasPorFechaOrdenadaPorSabor <br>";

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `fecha` >= :fecha1 AND `fecha` <= :fecha2 ORDER BY `sabor` ;");
    $consulta->bindValue(':fecha1',$fecha1, PDO::PARAM_STR);
    $consulta->bindValue(':fecha2',$fecha2, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    return $resultado;

}

function ListaVentasPorUsuario($usuarioMail)
{
    //echo "ListaVentasPorUsuario <br>";

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `mail` = :mail;");
    $consulta->bindValue(':mail',$usuarioMail, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    return $resultado;  
}

function ListaVentasPorSabor($sabor)
{
    //echo "ListaVentasPorSabor <br>";

    $dao = new DAO();
    $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `sabor` = :sabor;");
    $consulta->bindValue(':sabor',$sabor, PDO::PARAM_STR);
    $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($resultado);
    return $resultado;    
}

?>

