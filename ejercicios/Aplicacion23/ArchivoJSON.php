<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class ArchivoJson
{
    static function EscribirJson($data, $archivo)
    {
        var_dump($data);

        try
        {
            $file = fopen($archivo, "a");
            fwrite($file, json_encode($data, JSON_UNESCAPED_UNICODE));
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
}//class

?>