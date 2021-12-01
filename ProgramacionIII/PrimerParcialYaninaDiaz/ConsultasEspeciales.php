<?php

class ConsultasEspeciales{
    
    public static function ConsultarVentasEliminadas(){

        try{
            $dao = new DAO();
            $consulta = $dao->PrepararConsulta("SELECT * FROM ventas WHERE `estado` = 1;");
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $resultado; 
        }
        catch(Exception $e)
        {
            throw $e;
        }

    }
    
    public static function ListarImagenes($tipo){

        if($tipo == 'actuales'){
            $path = 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/ImagenesDevolucion/';
        }
        else{
            $path = 'C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Venta/BackupVenta/';
        }

        $archivs = array_diff(scandir($path), array('.', '..')); 
  
        return $archivs;
    }

    public static function ListarDevolucionesYCupones(){

        $cupones = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Cupon/cupones.json');
        $devoluciones = ArchivoJson::LeerJson('C:\xampp\htdocs\ejercicios_laboratorio_programacion_3-\ProgramacionIII\PrimerParcialYaninaDiaz\Devolucion/devoluciones.json');

        $todo = [];
        $countI = count($devoluciones);
        $countJ = count($cupones);

        for($i = 0; $i<$countI; $i++){

            for($j = 0; $j<$countJ; $j++){

                if($devoluciones[$i]->id_cupon == $cupones[$j]->id)
                {
                    $dato = [$devoluciones[$i]->fecha, $devoluciones[$i]->numero_pedido, $devoluciones[$i]->causa, $cupones[$j]->id, $cupones[$j]->esta_usado];
                    array_push($todo, $dato);
                }
            }
        }
        return $todo;
    }






}

?>
