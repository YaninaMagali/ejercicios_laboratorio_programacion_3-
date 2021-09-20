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
            //var_dump();
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
        try
        {
            $file = fopen($archivo, "a");
            while(!feof($file))
            {
                $data = fgets($file);
                
            }
        }
        catch(Exception $e) 
        {
            echo 'Message: No se pudo abrir file';
        }
        finally
        {
            json_decode($data, JSON_UNESCAPED_UNICODE);
            if($file)
            {
                fclose($file);
            }  
        }
    }
}//class

?>