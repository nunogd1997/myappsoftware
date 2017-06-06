<?php
class conexion{
    public $db = "";
    function get_conection($num=0){
        $this->db[] = array('mysql:host=localhost;dbname=myappsoftware;charset=utf8','root','');        
        return $this->db[$num];
    }
}
