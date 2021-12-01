<?php

class ConsultarCupones{

    public static function ConsultarTodosCupones(){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM cupon;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Cupon') ;
    }

    public static function ConsultarCuponesOrdenadosPorUsuario(){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT cupon.* FROM cupon
        INNER JOIN devolucion ON devolucion.id_cupon = cupon.id
        INNER JOIN ventas ON ventas.numero_pedido = devolucion.numero_pedido
        ORDER BY ventas.mail;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Cupon') ;
    }

    public static function ConsultarCuponesOrdenadosPorFecha($fechaFiltro){

        $dao = new DAO();
        $consulta = $dao->PrepararConsulta("SELECT * FROM cupon
        WHERE fecha >= :fecha
        ORDER BY fecha;");
        $consulta->bindValue(':fecha', $fechaFiltro, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Cupon') ;
    }

    function ConsultarCuponesJsonOrdenadosPorFecha(){

        $cupones = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Cupon/cupones.json');
        usort($cupones, array('ConsultarCupones', 'CompararPorFecha'));
        return $cupones;
    }

    function CompararPorFecha($c1, $c2){

        if ($c1->fecha == $c2->fecha) {
            return 0;
        }
        else{
            if($c1->fecha >= $c2->fecha){
                return 1;
            }
            else{
                return -1;
            }
        }
    }


}


?>