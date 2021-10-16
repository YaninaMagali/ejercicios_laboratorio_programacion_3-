<?php

class DAO
{
    public $objetoPDO;

    public function __construct()
    {
        $this->objetoPDO = new PDO('mysql:host=localhost;dbname=simulacro1;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->objetoPDO->exec("SET CHARACTER SET utf8");
        $this->objetoPDO->exec("SET CHARACTER SET utf8");
      
    }

    public function PrepararConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }

    public function InsertarVenta($venta)
    {
        //var_dump($venta);
        //echo $venta->mail;
        //echo "/////////// <br>";
        //var_dump($venta);
        //echo "/////////// <br>";
        
        $consulta = $this->PrepararConsulta("INSERT INTO ventas(`fecha`,`mail`, `sabor`, `tipo`, `cantidad`)
        VALUES (:fecha,  :mail, :sabor, :tipo, :cantidad);");
        $consulta->bindValue(':fecha',$venta->fecha, PDO::PARAM_STR);
        //$consulta->bindValue(':numero_pedido',$venta->numero_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':mail',$venta->mail, PDO::PARAM_STR);
        $consulta->bindValue(':sabor', $venta->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$venta->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':cantidad', $venta->cantidad, PDO::PARAM_INT);

        try{
            $consulta->execute();   
            echo "InsertarVenta OK <br>";
        }
        catch(Exception $e)
        {
            echo "Error en InsertarVenta<br>";

            var_dump($e);
        }
    }
}
?>