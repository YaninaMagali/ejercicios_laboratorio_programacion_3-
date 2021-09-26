<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Archivador
{
    function GuardarArchivo($archivo, $dir_subida)
    {
        $pudoGuardar = false;
        //$dir_subida = 'archivos-subidos/';
        $fichero_subido = $dir_subida . basename($_FILES[$archivo]['name']);

        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) 
        {
            $pudoGuardar = true;
            echo "El fichero es válido y se subió con éxito.\n";
        } 
        else 
        {
            echo "¡Posible ataque de subida de ficheros!\n";
        }
        return $pudoGuardar;
    }

}

$a =  new Archivador();
$a.GuardarArchivo('archivo', 'Aplicacion23/archivos-subidos');

?>
