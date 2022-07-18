<?php

require_once "../capa_conexion/conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

$ano = $_GET["ano"];
$periodo = $_GET["periodo"];
$validacionf = $_GET["validacionf"];
$tienda = $_GET["tienda"];


if ($validacionf === 'PENDIENTE') {
    $sqlquiebreMovil = " SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where  year(ncquiebre.fecha_ingreso)<='$ano' 
        and ncquiebre.validacion='$validacionf' 
        and ncquiebre.zonal='$tienda'
        ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'ATENDIDO') {
    $sqlquiebreMovil = " SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where  year(ncquiebre.fecha_ingreso)<='$ano' 
        and ncquiebre.validacion='$validacionf' 
        and ncquiebre.zonal='$tienda'
        ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'CURSO') {
    $sqlquiebreMovil = " SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where  year(ncquiebre.fecha_ingreso)<='$ano' 
        and ncquiebre.validacion='$validacionf' 
        and ncquiebre.zonal='$tienda'
        ORDER BY ncquiebre.fecha_ingreso DESC";
} else if ($validacionf === 'DEVUELTO') {
    $sqlquiebreMovil = " SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where  year(ncquiebre.fecha_ingreso)<='$ano' 
        and ncquiebre.validacion='$validacionf' 
        and ncquiebre.zonal='$tienda'
        ORDER BY ncquiebre.fecha_ingreso DESC";
} else {
    $sqlquiebreMovil = " SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where year(ncquiebre.fecha_ingreso)<='$ano' 
        and ncquiebre.validacion='PENDIENTE'

        UNION

        SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where month(ncquiebre.fecha_validacion)='$periodo' 
        and year(ncquiebre.fecha_validacion)='$ano' 
        and ncquiebre.validacion='ATENDIDO'

        UNION

        SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where month(ncquiebre.fecha_ingreso)='$periodo' 
        and year(ncquiebre.fecha_ingreso)='$ano' 
        and ncquiebre.validacion='CURSO'

        UNION

        SELECT 
        ncquiebre.id_quiebre,
        ncquiebre.fecha_ingreso, 
        ncquiebre.ruc,
        ncquiebre.razon_social,
        ncquiebre.modalidad,
        ncquiebre.cargo_fijo, 
        ncquiebre.estado,
        ncquiebre.validacion,
        s.nombre,
        u.personal
        from quiebre_movil as ncquiebre 
        left join supervisor as s on ncquiebre.id_supervisor=s.id_supervisor
        left join usuario as u on u.id_usuario=ncquiebre.id_usuario
        where month(ncquiebre.fecha_validacion)='$periodo' 
        and year(ncquiebre.fecha_validacion)='$ano' 
        and ncquiebre.validacion='DEVUELTO' ";
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
                            <th>INGRESO</th>
                            <th>RUC</th>
                            <th>RAZON SOCIAL</th>
                            <th>EJECUTIVO REAL</th>
                            <th>SUPERVISOR</th>
                            <th>CARGO FIJO</th>
                            <!-- <th>ESTADO</th> -->
                            <th>VALIDADO</th>
                            <th>DETALLE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($resultquiebreMovil)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar[1] ?></td>
                                <td><?php echo $mostrar[3] ?></td>
                                <td><?php echo $mostrar[2] ?></td>
                                <td><?php echo $mostrar[9] ?></td>
                                <td><?php echo $mostrar[8] ?></td>
                                <td><?php echo $mostrar[5] ?></td>
                                <!-- <td>?php echo $mostrar[6] ?></td> -->
                                <td><?php echo $mostrar[7] ?></td>
                                <td style="text-align: center;">
                                    <span class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEditar" onclick="TraerDatosTabla('<?php echo $mostrar[0] ?>')"> <span class="fa fa-check-circle"></span>
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