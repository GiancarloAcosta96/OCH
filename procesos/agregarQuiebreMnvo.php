<?php

require_once "../capa_conexion/conexion.php";
require_once "../capa_logica/crudQuiebre.php";
$obj = new crudQuiebre();

try {
    $datosquiebre = array(
        $_POST['idusu'], //0
        $_POST['idsupervisor'], //1
        $_POST['estado'], //2
        $_POST['fechaInicio'], //3
        $_POST['ncfruc'], //4
        $_POST['ncfrazonsocial'], //5
        $_POST['quiebre_servicio'], //6
        $_POST['quiebre_numero_problema'], //7
        $_POST['fechaActivacion'], //8
        $_POST['quiebre_tipo_averia'], //9
        $_POST['fechaInicio'], //10
        $_POST['quiebre_problemas'], //11
        $_POST['quiebre_detalle'], //12
        $_POST['quiebre_contacto1'], //13
        $_POST['quiebre_celular1'], //14
        $_POST['quiebre_contacto2'], //15
        $_POST['quiebre_celular2'], //16
        $_POST['quiebre_ticket'], //17
        $_POST['quiebre_numero_ticket'], //18
        $_POST['fechaTicket'], //19
        $_POST['ncregion'], //20
        $_POST['quiebre_observaciones'] //21
    );
} catch (Exception $exce) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}

try {
    $resultado = $obj->agregarQuiebremovil($datosquiebre);
    echo json_encode($resultado);
    print_r($resultado);
    echo $resultado;
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
