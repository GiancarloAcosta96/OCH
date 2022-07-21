<?php
require_once "../capa_conexion/conexion.php";
require_once "../capa_logica/crudQuiebre.php";
$obj = new crudQuiebre();

$datos = array(
    $_POST['fechaInicio'], //0
    $_POST['idusu'], //1
    $_POST['ncvalidacions'], //2
    $_POST['ncobservacionesvals'], //3
    $_POST['idquiebre'], //4
    $_POST['casosf'] //5
);

try {
    $resultado = $obj->agregarQuiebreValidacion($datos);
    echo json_encode($resultado);
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
