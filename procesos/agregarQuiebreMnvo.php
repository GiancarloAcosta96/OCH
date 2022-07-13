<?php

require_once "../capa_conexion/conexion.php";
require_once "../capa_logica/crudQuiebre.php";
$obj = new crudQuiebre();


$datos = array(
    $_POST['idusu'], //0
    $_POST['idsupervisor'], //1
    $_POST['ncqlineas'], //2
    $_POST['ncmodalidadquiebre'], //3
    $_POST['nccargofijo'], //4
    $_POST['ncfrazonsocial'], //6
    $_POST['ncfruc'], //5
    $_POST['ncnomcontacto'], //7
    $_POST['nctelefono1'], //8
    $_POST['nccorreo'], //9
    $_POST['ncregion'], //10
    $_POST['ncobservaciones'], //11
    $_POST['ncoportunidad'], //12
    $_POST['ncdni'] //13
);


try {
    $resultado = $obj->agregarQuiebremovil($datos);
    echo json_encode($resultado);
    print_r($resultado);
    echo $resultado;
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
