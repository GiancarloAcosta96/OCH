<?php
   session_start();
$idusu = $_SESSION ["idusu"];
require_once "../capa_conexion/conexion.php";

$obj = new conectar();
$conexion = $obj->conexion();

header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= Contactabilidad.xls"); 

$supervisor=$_POST["supervisor"];
$desde=$_POST["desde"];
$hasta=$_POST["hasta"];

$date_hasta = strtotime('+1 day', strtotime($hasta));
$date_hasta = date('Y-m-d', $date_hasta);



//$sqlEXCEL ="SELECT t.nombre,'ONE CHANNEL' as 'canal',d.origen,u.personal,r.contactabilidad,r.negociacion,r.volverllamar,ll.ruc,ll.razon_social,ll.nombre_contacto,ll.telefono ,r.descripcion,ll.q_lineas,ll.q_lineas,d.fecha_asignacion,ll.fecha,'1' as 'numero',ll.comentario,ll.q_claro,ll.q_entel,ll.q_bitel FROM usuario as u INNER JOIN asigna as a on a.id_usuario=u.id_usuario INNER JOIN tienda as t on t.id_tienda=a.id_tienda INNER JOIN llamada as ll on ll.id_usuario = u.id_usuario INNER JOIN datos as d on d.ruc=ll.ruc and d.id_usuario = ll.id_usuario INNER JOIN respuesta as r on r.id_respuesta=ll.id_respuesta WHERE a.estado=0 and u.id_supervisor='$supervisor' and ll.fecha>='$desde' and ll.fecha<'$date_hasta' ";

$sqlEXCEL ="SELECT * FROM reporteusu_excel as rep WHERE  rep.id_supervisor='$supervisor' and rep.fecha>='$desde' and rep.fecha<'$date_hasta' ";


    $resultEXCEL=mysqli_query($conexion,$sqlEXCEL);



?>

<table class="table table-hover table-condensed table-bordered" id="iddatatable">
                    <thead style="background-color: #dc3545;color: blue; font-weight: bold;">
                        <tr>
                            <th>NOMBRE</th>
                            <th>CANAL</th>
                            <th>ORIGEN</th>
                            <th>PERSONAL</th>
                            <th>CONTACTABILIDAD</th>
                            <th>NEGOCIACION</th>
                            <th>VOLVER A LLAMAR</th>
                            <th>RUC</th>
                            <th>RAZON SOCIAL</th>
                            <th>NOMBRE CONTACTO</th>
                            <th>TELEFONO</th>
                            <th>DESCRIPCION</th>
                            <th>Q_MOVILES</th>
                            <th>Q_FIJAS</th>
                            <th>FECHA_ASIGNACION</th>
                            <th>FECHA CONTACTO</th>
                            <th>Q_INTENTOS</th>
                            <th>COMENTARIO</th>
                            <th>Q_CLARO</th>
                            <th>Q_ENTEL</th>
                            <th>Q_BITEL</th>
                         
                       
                          
                        </tr>
                    </thead>

                    <tbody >
                        <?php
                        while ($mostrar = mysqli_fetch_array($resultEXCEL)) {
                            ?>
                            <tr >
                                <td><?php echo utf8_decode($mostrar[0]) ?></td>
                                <td><?php echo utf8_decode($mostrar[1]) ?></td>
                                <td><?php echo utf8_decode($mostrar[2]) ?></td>
                                <td><?php echo utf8_decode($mostrar[3])?></td>
                                <td><?php echo utf8_decode($mostrar[4]) ?></td>
                                <td><?php echo utf8_decode($mostrar[5]) ?></td>
                                <td><?php echo utf8_decode($mostrar[6]) ?></td>
                                <td><?php echo utf8_decode($mostrar[7]) ?></td>
                                <td><?php echo utf8_decode($mostrar[8]) ?></td>
                                <td><?php echo utf8_decode($mostrar[9]) ?></td>
                                <td><?php echo utf8_decode($mostrar[10]) ?></td>
                                <td><?php echo utf8_decode($mostrar[11]) ?></td>
                                <td><?php echo utf8_decode($mostrar[12]) ?></td>
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