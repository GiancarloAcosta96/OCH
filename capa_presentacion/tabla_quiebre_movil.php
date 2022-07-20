<?php

require_once "../capa_conexion/conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

$ano = $_GET["ano"];
$periodo = $_GET["periodo"];
$estado = $_GET["estado"];
$idusu = $_GET["idusu"];

if ($estado === 'PENDIENTE') {
    $sqlquiebreMovil = " SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where  year(quiebre.fechaInicio)<='$ano' 
        and quiebre.validacion='$estado' 
        ORDER BY quiebre.fechaInicio DESC";
} else if ($estado === 'ATENDIDO') {
    $sqlquiebreMovil = " SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where  year(quiebre.fechaInicio)<='$ano' 
        and quiebre.validacion='$estado' 
        ORDER BY quiebre.fechaInicio DESC";
} else if ($estado === 'CURSO') {
    $sqlquiebreMovil = " SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where  year(quiebre.fechaInicio)<='$ano' 
        and quiebre.validacion='$estado' 
        ORDER BY quiebre.fechaInicio DESC";
} else if ($estado === 'DEVUELTO') {
    $sqlquiebreMovil = " SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where  year(quiebre.fechaInicio)<='$ano' 
        and quiebre.validacion='$estado' 
        ORDER BY quiebre.fechaInicio DESC";
} else {
    $sqlquiebreMovil = " SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre  
        where year(quiebre.fecha_ingreso)<='$ano' 
        and quiebre.validacion='PENDIENTE'

        UNION

        SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where month(quiebre.fecha_validacion)='$periodo' 
        and year(quiebre.fecha_validacion)='$ano' 
        and quiebre.validacion='ATENDIDO'

        UNION

        SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where month(quiebre.fecha_ingreso)='$periodo' 
        and year(quiebre.fecha_ingreso)='$ano' 
        and quiebre.validacion='CURSO'

        UNION

        SELECT 
        quiebre.id_quiebre,
        quiebre.fecha_inicio_averia, 
        quiebre.ruc,
        quiebre.razon_social,
        quiebre.servicio,
        quiebre.estado, 
        from quiebre as quiebre 
        where month(quiebre.fecha_validacion)='$periodo' 
        and year(quiebre.fecha_validacion)='$ano' 
        and quiebre.validacion='DEVUELTO' ";
}




$resultquiebreMovil = mysqli_query($conexion, $sqlquiebreMovil);

?>

<form class="form form-horizontal">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div>
                <table class="table table-hover table-condensed table-bordered" id="iddatatable">
                    <thead style="background-color: #fc9c1c;color: white; font-weight: bold;">
                        <tr>
                            <th>INICIO DE AVERÍA</th>
                            <th>RUC</th>
                            <th>RAZON SOCIAL</th>
                            <th>SERVICIO</th>
                            <th>ESTADO</th>
                            <th>DETALLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($resultquiebreMovil)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar[1] ?></td>
                                <td><?php echo $mostrar[2] ?></td>
                                <td><?php echo $mostrar[3] ?></td>
                                <td><?php echo $mostrar[4] ?></td>
                                <td><?php echo $mostrar[5] ?></td>
                                <td style="text-align: center;">
                                    <span class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalSeguimiento" onclick="TraerDatosTabla('<?php echo $mostrar[0] ?>')"> <span class="fa fa-check-circle"></span>
                                    </span>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#iddatatable').DataTable();
    });
</script>