<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class ArchivoJson
{
    static function EscribirJson($data, $archivo)
    {
        try
        {
            $aux = ArchivoJson::LeerJson($archivo);//Leo el json y guardo el contenido nw $aux
            array_Push($aux, $data); // inserto al final de $aux el nuevo dato que voy a agregar al json
            $file = fopen($archivo, "w"); // Abro el json
            fwrite($file, json_encode($aux, JSON_UNESCAPED_UNICODE)); // Escribo $aux en json pisandolo
        }
        catch(Exception $e) 
        {
            echo 'Message: No se pudo abrir file';
        }
        finally
        {
            if($file)
            {
                fclose($file);
            }  
        }

    }



    static function LeerJson($archivo)
    {
        $dato = null;
        $json = null;

        try
        {
            $file = fopen($archivo, "r");
            while(!feof($file))
            {
                $dato = $dato . fgets($file);
            }
            $json = json_decode($dato, true);
            var_dump($dato);
            echo '<br> //////////////// <br>';
            var_dump($json);
            
        }
        catch(Exception $e) 
        {
            echo 'Message: No se pudo abrir file';
        }
        finally
        {
            if($file)
            {
                fclose($file);
            }  
        }
        return $json;
    }

    
}//class

?>