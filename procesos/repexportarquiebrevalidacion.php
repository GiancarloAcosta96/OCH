<?php
session_start();
$idusu = $_SESSION["idusu"];
require_once "../capa_conexion/conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= reportequiebre.xls");

$ano = $_POST["ncano"];
$periodo = $_POST["ncperiodo"];
$validacionf = $_POST["ncvalidacionf"];
$tienda = $_POST["tiendaf"];


if ($validacionf === 'PENDIENTE') {
    $sqlEXCEL = " SELECT    usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor= ncquiebre.id_supervisor
                            where  year(ncquiebre.fecha_ingreso)<='$ano' 
                            and ncquiebre.validacion='$validacionf' 
                            and ncquiebre.zonal='$tienda'
                            ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'ATENDIDO') {

    $sqlEXCEL = " SELECT    usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor= ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_validacion)='$periodo' and year(ncquiebre.fecha_validacion)='$ano' 
                            and ncquiebre.validacion='$validacionf' 
                            and ncquiebre.zonal='$tienda'
                            ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'CURSO') {

    $sqlEXCEL = " SELECT    usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor= ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_ingreso)='$periodo' and year(ncquiebre.fecha_ingreso)='$ano' 
                            and ncquiebre.validacion='$validacionf'  and ncquiebre.zonal='$tienda'
                            ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'DEVUELTO') {
    $sqlEXCEL = " SELECT    usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor= ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_ingreso)='$periodo' and year(ncquiebre.fecha_ingreso)='$ano' 
                            and ncquiebre.validacion='$validacionf'  and ncquiebre.zonal='$tienda'
                            ORDER BY ncquiebre.fecha_ingreso DESC";
} else {

    $sqlEXCEL = " SELECT    usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor = ncquiebre.id_supervisor 
                            where  year(ncquiebre.fecha_ingreso)<='$ano' 
                            and ncquiebre.validacion='PENDIENTE'  
                            and ncquiebre.zonal='$tienda'

                            UNION

                    SELECT  usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor = ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_validacion)='$periodo' 
                            and year(ncquiebre.fecha_validacion)='$ano' 
                            and ncquiebre.validacion='ATENDIDO' 
                            and ncquiebre.zonal='$tienda'

                            UNION

                    SELECT  usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor = ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_ingreso)='$periodo' 
                            and year(ncquiebre.fecha_ingreso)='$ano' 
                            and ncquiebre.validacion='CURSO' 
                            and ncquiebre.zonal='$tienda'

                            UNION

                    SELECT  usu.personal, 
                            sup.nombre, 
                            ncquiebre.fecha_ingreso,  
                            ncquiebre.fecha_actualizacion,
                            ncquiebre.ruc, 
                            ncquiebre.razon_social, 
                            ncquiebre.modalidad,
                            ncquiebre.tipo, 
                            ncquiebre.q_lineas, 
                            ncquiebre.cargo_fijo, 
                            ncquiebre.contacto, 
                            ncquiebre.telefono1, 
                            ncquiebre.correo, 
                            ncquiebre.dni, 
                            ncquiebre.comentario_ejecutivo, 
                            ncquiebre.estado, 
                            ncquiebre.validacion,
                            ncquiebre.fecha_validacion, 
                            ncquiebre.oportunidad, 
                            ncquiebre.casosf 
                            FROM quiebre_movil as ncquiebre 
                            inner join usuario as usu on usu.id_usuario = ncquiebre.id_usuario 
                            left JOIN supervisor as sup on sup.id_supervisor= ncquiebre.id_supervisor 
                            where month(ncquiebre.fecha_ingreso)='$periodo' 
                            and year(ncquiebre.fecha_ingreso)='$ano' 
                            and ncquiebre.validacion='DEVUELTO' 
                            and ncquiebre.zonal='$tienda'

";
}




$resultEXCEL = mysqli_query($conexion, $sqlEXCEL);

?>

<table class="table table-hover table-condensed table-bordered" id="iddatatable">
    <thead style="background-color: #dc3545;color: blue; font-weight: bold;">
        <tr>
            <th>PERSONAL</th>
            <th>SUPERVISOR</th>
            <th>FECHA INGRESO</th>
            <th>FECHA ULT ACTUALIZACION</th>
            <th>RUC</th>
            <th>RAZON SOCIAL</th>
            <th>MODALIDAD</th>
            <th>TIPO</th>
            <th>Q_LINEAS</th>
            <th>CARGO_FIJO</th>
            <th>CONTACTO</th>
            <th>TELEFONO 1</th>
            <th>CORREO</th>
            <th>DNI</th>
            <th>COMENTARIO EJECUTIVO</th>
            <th>ESTADO</th>
            <th>VALIDACION</th>
            <th>FECHA VALIDACION</th>
            <th>OPORTUNIDAD</th>
            <th>CASO SF</th>
        </tr>
    </thead>

    <tbody>
        <?php
        while ($mostrar = mysqli_fetch_array($resultEXCEL)) {
        ?>
            <tr>
                <td><?php echo utf8_decode($mostrar[0]) ?></td>
                <td><?php echo utf8_decode($mostrar[1]) ?></td>

                <td><?php echo utf8_decode($mostrar[2]) ?></td>
                <td><?php echo utf8_decode($mostrar[3]) ?></td>
                <td><?php echo utf8_decode($mostrar[4]) ?></td>
                <td><?php echo utf8_decode($mostrar[5]) ?></td>
                <td><?php echo utf8_decode($mostrar[6]) ?></td>
                <td><?php echo utf8_decode($mostrar[7]) ?></td>
                <td><?php echo utf8_decode($mostrar[8]) ?></td>
                <td><?php echo utf8_decode($mostrar[9]) ?></td>
                <td><?php echo utf8_decode($mostrar[10]) ?></td>
                <td><?php echo utf8_decode($mostrar[11]) ?></td>
                <td><?php echo utf8_decode($mostrar[12]) ?></td>
                <td><?php echo utf8_decode($mostrar[13]) ?></td>

                <td><?php echo utf8_decode($mostrar[14]) ?></td>
                <td><?php echo utf8_decode($mostrar[15]) ?></td>
                <td><?php echo utf8_decode($mostrar[16]) ?></td>
                <td><?php echo utf8_decode($mostrar[17]) ?></td>

                <td><?php echo utf8_decode($mostrar[18]) ?></td>
                <td><?php echo utf8_decode($mostrar[19]) ?></td>



            </tr>
        <?php
        }
        ?>
    </tbody>
</table>