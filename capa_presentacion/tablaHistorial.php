<?php

require_once "../capa_conexion/conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

$param = $_GET["ruc"];

$sqlhistorial = " SELECT ll.fecha, ll.telefono,r.descripcion,ll.comentario
,ll.correo from llamada as ll inner join respuesta as r on 
ll.id_respuesta=r.id_respuesta 
where ll.ruc='$param'
ORDER BY fecha DESC";



$resulthistorial = mysqli_query($conexion, $sqlhistorial);


?>

<form class="form form-horizontal">
    <div class="panel panel-primary">
        <div class="panel-body">
            <div>
                <table class="table table-hover table-condensed table-bordered" id="iddatatable">
                    <thead style="background-color: #dc3545;color: white; font-weight: bold;">
                        <tr>
                            <th>FECHA</th>
                            <th>TELEFONO</th>
                            <th>RESPUESTA</th>
                            <th>COMENTARIO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($mostrar = mysqli_fetch_array($resulthistorial)) {
                        ?>
                            <tr>
                                <td><?php echo $mostrar[0] ?></td>
                                <td><?php echo $mostrar[1] ?></td>
                                <td><?php echo $mostrar[2] ?></td>
                                <td><?php echo $mostrar[3] ?></td>



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