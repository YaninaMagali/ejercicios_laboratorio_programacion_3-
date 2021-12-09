<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Archivador
{
    function GuardarArchivo($archivo, $dir_subida)
    {
        // echo "/////////////////// archiov <br>";
        // echo $archivo . "<br>";
        // echo "//////////// dir subida <br>";
        echo $dir_subida . "<br>";
        $pudoGuardar = false;
        //$dir_subida = 'archivos-subidos/';
        $fichero_subido = $dir_subida . basename($_FILES[$archivo]['name']);

        if(is_file($fichero_subido))
        {
            echo "existe el file \n";
            die();
        }

        // if (!file_exists($dir_subida)) {
        //     mkdir($dir_subida, 0777, true);
            
        // }

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
?>
