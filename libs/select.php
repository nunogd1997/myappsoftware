<?php
session_start();
ini_set("default_charset", "utf-8");
include("../include/conexion/querys.php");
include("../include/conexion/conexion.php");
$conectores     = new conexion();
$parametros_db1 = $conectores->get_conection(0);
$query = new Query2($parametros_db1[0], $parametros_db1[1], $parametros_db1[2]);

if (isset($_POST['tag']) && $_POST['tag'] != '') {
    $tag = $_POST['tag'];
    switch ($tag) {
        case "getInfo":            
            $nick = $_POST['nick'];
            $pass = $_POST['pass'];
            getInfo($query, $nick, $pass);
            break;      
    }
} else {
    $util->msj("nt",TRUE);
}


function getInfo($query, $nick, $pass) {
    $columnas = "nombre";
    $condicion = "where nick='$nick' and pass = '$pass'";
    $tabla = "usuario";
    $result = $query->consultar($columnas, $condicion, $tabla, TRUE);
    //die($result);
    if(count($result) > 0){
        echo $result;
    } else {
        echo json_encode("vacio");
    }
}
