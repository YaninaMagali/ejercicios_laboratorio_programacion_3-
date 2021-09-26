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
        $dato = null;
        $array = [];
        $json = null;

        try
        {
            $file = fopen($archivo, "r");
            $json = json_decode(file_get_contents($archivo), true);
            // while(!feof($file))
            // {
            //     $dato = $dato . fgets($file);
            //    // array_push($array,$dato);
            //    //var_dump($dato);
            // }
            //$json = json_decode($dato, true);
            var_dump($json);  
            
        }
        catch(Exception $e) 
        {
            echo 'Message: No se pudo abrir file';
        }
        finally
        {
            //var_dump($json);
           //$retorno = json_decode($data, true);
            if($file)
            {
                echo "cerrar archivo json <br>";
                fclose($file);
            }  
        }
    }
}//class

?>