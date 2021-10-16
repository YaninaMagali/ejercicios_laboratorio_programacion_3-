<?php

class DAO
{
    public $objetoPDO;

    public function __construct()
    {
        $this->objetoPDO = new PDO('mysql:host=localhost;dbname=tp01sql;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->objetoPDO->exec("SET CHARACTER SET utf8");
        $this->objetoPDO->exec("SET CHARACTER SET utf8");
      
    }

    public function PrepararConsulta($sql)
    { 
        return $this->objetoPDO->prepare($sql); 
    }

    public function InsertarVenta($venta)
    {
        echo "/////////// <br>";
        var_dump($venta);
        echo "/////////// <br>";
        $consulta = $this->DAO->PrepararConsulta("INSERT INTO ventas(`mail`, `sabor`, `tipo`, `cantidad`)
        VALUES (:mail, :sabor, :tipo, :cantidad);");
        $consulta->bindValue(':mail',$venta->mail, PDO::PARAM_STR);
        $consulta->bindValue(':sabor', $venta->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$venta->tipo, PDO::PARAM_STR);
		$consulta->bindValue(':cantidad', $venta->cantidad, PDO::PARAM_INT);

        try{
            $consulta->execute();
        }
        catch(Exception $e)
        {
            echo "Error en InsertarVenta<br>";

            var_dump($e);
        }
    }
}
?>