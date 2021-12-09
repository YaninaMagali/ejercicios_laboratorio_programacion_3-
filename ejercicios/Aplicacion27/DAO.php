<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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

    public function RetornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }
}


?>