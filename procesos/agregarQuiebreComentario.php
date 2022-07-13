<?php

require_once "../capa_conexion/conexion.php";
require_once "../capa_logica/crudQuiebre.php";
$obj = new crudQuiebre();


$datos = array(

    $_POST['idquiebre'], //0
    $_POST['ncobservacionesejes'], //1
    $_POST['nctelefono1s'], //2
    $_POST['nccorreos'], //3
    $_POST['ncqlineass'], //4
    $_POST['nccargofijos'], //5
    $_POST['ncdnis'] //5

);


try {
    $resultado = $obj->agregarQuiebreComentario($datos);
    echo json_encode($resultado);
    //print_r($resultado);
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
