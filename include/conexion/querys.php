<?php
date_default_timezone_set("America/Guatemala");

class Query2 extends PDO{

    private $dsn;
    private $usuario;
    private $contrasena;
    private $connection;
    private $counter = 0;
        
    public function __construct($dsn, $username, $passwd) {
        $this->dsn = $dsn;
        $this->usuario = $username;
        $this->contrasena = $passwd;
        try {
            $this->connection = parent::__construct($this->dsn, $this->usuario, $this->contrasena);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            //codigoDeError($exc->getCode());
            die();
        }
    }
    
    function consultar($columnas,$condicion, $tabla,$json=false,$mostrar=false,$Fetch=PDO::FETCH_ASSOC){
        try {
            $consulta = "SELECT $columnas FROM $tabla  $condicion";
            $this->connection = parent::prepare($consulta);
            $this->connection->execute();
            if($json){
                return json_encode($this->connection->fetchAll($Fetch),true);
            }else{
                return $this->connection->fetchAll($Fetch);
            }
            
        } catch (PDOException $exc) {
            if($mostrar){echo $consulta;}
            return false;
        }
    }
    
    function begin_trans() {
        return parent::beginTransaction();
    }
    
    function rollback_trans() {
        return parent::rollBack();
    }
    
    public function commit_trans() {
        return parent::commit();
    }
    
    public function lastInsertId($name = null) {
        parent::lastInsertId($name);
    }
}