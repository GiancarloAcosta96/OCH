<?php

class crudQuiebre
{
    public function agregarQuiebremovil($datosquiebre)
    {

        date_default_timezone_set("America/Lima");
        $hoy = date("Y-m-d");

        $obj = new conectar();
        $conexion = $obj->conexion();

        $sqlQuiebre = "INSERT INTO quiebre (
                                            id_usuario,
                                            id_supervisor,
                                            estado,
                                            fecha_inicio_averia,
                                            ruc,
                                            razon_social,
                                            servicio,
                                            numero_problema,
                                            fecha_activacion,
                                            tipo_averia,
                                            fecha_inicio,
                                            problema_equipo,
                                            detalle_equipo,
                                            contacto1,
                                            celular1,
                                            contacto2,
                                            celular2,
                                            ticket_atencion,
                                            numero_ticket,
                                            fecha_ticket_atencion,
                                            zonal_telefonica,
                                            comentario_ejecutivo
                                            )
                                    values (
                                            '$datosquiebre[0]',
                                            '$datosquiebre[1]',
                                            'PENDIENTE',
                                            '$datosquiebre[3]',
                                            '$datosquiebre[4]',
                                            '$datosquiebre[5]',
                                            '$datosquiebre[6]',
                                            '$datosquiebre[7]',
                                            '$datosquiebre[8]',
                                            '$datosquiebre[9]',
                                            '$datosquiebre[10]',
                                            '$datosquiebre[11]',
                                            '$datosquiebre[12]',
                                            '$datosquiebre[13]',
                                            '$datosquiebre[14]',
                                            '$datosquiebre[15]',
                                            '$datosquiebre[16]',
                                            '$datosquiebre[17]',
                                            '$datosquiebre[18]',
                                            '$datosquiebre[19]',
                                            '$datosquiebre[20]',
                                            '$datosquiebre[21]'
                                            )";
        $rpta = mysqli_query($conexion, $sqlQuiebre);
        return $rpta;
    }

    public function obtenQuiebreMovil($idquiebre)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();

        $sql = "SELECT  ncquiebre.estado,
                        ncquiebre.fecha_inicio_averia,
                        ncquiebre.ruc,
                        ncquiebre.razon_social,
                        ncquiebre.servicio,
                        ncquiebre.numero_problema,
                        ncquiebre.fecha_activacion,
                        ncquiebre.tipo_averia,
                        ncquiebre.fecha_inicio,
                        ncquiebre.problema_equipo,
                        ncquiebre.detalle_equipo,
                        ncquiebre.contacto1,
                        ncquiebre.celular1,
                        ncquiebre.contacto2,
                        ncquiebre.celular2,
                        ncquiebre.ticket_atencion,
                        ncquiebre.numero_ticket,
                        ncquiebre.fecha_ticket_atencion,
                        ncquiebre.zonal_telefonica,
                        ncquiebre.comentario_ejecutivo,
                        ncquiebre.id_validador,
                        ncquiebre.validacion,
                        ncquiebre.fecha_validacion,
                        ncquiebre.casosf,
                        ncquiebre.comentario_validador                      

                        from quiebre as ncquiebre 
                        inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
                        left join tienda as t on t.id_tienda=ncquiebre.zonal_telefonica
                        where id_quiebre ='$idquiebre' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $sqlsup = "SELECT sup.nombre
                    from quiebre as ncquiebre inner join supervisor as sup on ncquiebre.id_supervisor=sup.id_supervisor
                   
                    where id_quiebre ='$idquiebre' ";

        $resultsup = mysqli_query($conexion, $sqlsup);
        $versup = mysqli_fetch_array($resultsup);


        $sqlval = "SELECT usu.personal
                    from quiebre as ncquiebre inner join usuario as usu on ncquiebre.id_validador=usu.id_usuario
                   
                    where id_quiebre ='$idquiebre' ";

        $resultval = mysqli_query($conexion, $sqlval);
        $verval = mysqli_fetch_array($resultval);

        $datos = array(
            'estado' => $ver[0],
            'fecha_inicio_averia' => $ver[1],
            'ruc' => $ver[2],
            'razon_social' => $ver[3],
            'servicio' => $ver[4],
            'numero_problema' => $ver[5],
            'fecha_activacion' => $ver[6],
            'tipo_averia' => $ver[7],
            'fecha_inicio' => $ver[8],
            'problema_equipo' => $ver[9],
            'detalle_equipo' => $ver[10],
            'contacto1' => $ver[11],
            'celular1' => $ver[12],
            'contacto2' => $ver[13],
            'celular2' => $ver[14],
            'ticket_atencion' => $ver[15],
            'numero_ticket' => $ver[16],
            'fecha_ticket_atencion' => $ver[17],
            'zonal_telefonica' => $ver[18],
            'comentario_ejecutivo' => $ver[19],
            'validador' => $verval[0],
            'validacion' => $ver[20],
            'fecha_validacion' => $ver[21],
            'casosf' => $ver[22],
            'comentario_validador' => $ver[23]

        );
        return $datos;
    }

    public function agregarQuiebreComentario($datos)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();
        $sqlquiebreMovil = "UPDATE quiebre SET 
                            comentario_ejecutivo='$datos[1]',
                            telefono1='$datos[2]',
                            correo='$datos[3]',
                            q_lineas='$datos[4]',
                            cargo_fijo='$datos[5]',
                            dni='$datos[6]'
                            WHERE id_quiebre='$datos[0]' ";

        $rpta = mysqli_query($conexion, $sqlquiebreMovil);

        return $rpta;
    }

    public function agregarQuiebreValidacion($datos)
    {

        date_default_timezone_set("America/Lima");
        $hoy = date("Y-m-d");

        $obj = new conectar();
        $conexion = $obj->conexion();


        $sqlquiebreMovil = "UPDATE quiebre 
                            SET validacion='$datos[2]',
                                id_validador='$datos[1]',
                                fecha_validacion='$hoy',
                                casosf='$datos[5]',
                                comentario_validador='$datos[3]'
                                
                                WHERE id_quiebre='$datos[4]' ";
        $rpta = mysqli_query($conexion, $sqlquiebreMovil);

        return $rpta;
    }

    public function obtenQuiebreValid($idquiebre)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();

        $sql = "SELECT  ncquiebre.fecha_activacion,
                        ncquiebre.fecha_inicio_averia,
                        ncquiebre.ruc,
                        ncquiebre.razon_social,
                        ncquiebre.servicio,
                        ncquiebre.tipo_averia,
                        ncquiebre.problema_equipo,
                        ncquiebre.detalle_equipo,
                        ncquiebre.ticket_atencion,
                        ncquiebre.fecha_ticket_atencion,
                        ncquiebre.numero_ticket,
                        ncquiebre.contacto1,
                        ncquiebre.celular1,
                        ncquiebre.contacto2,
                        ncquiebre.celular2,
                        ncquiebre.numero_problema,
                        t.nombre,
                        ncquiebre.comentario_ejecutivo,
                        usu.personal


                        from quiebre as ncquiebre inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
                        left join tienda as t on t.id_tienda=ncquiebre.zonal_telefonica
                        where id_quiebre ='$idquiebre' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $datos = array(
            'fecha_activacion' => $ver[0],
            'fecha_inicio_averia' => $ver[1],
            'ruc' => $ver[2],
            'razon_social' => $ver[4],
            'servicio' => $ver[3],
            'tipo_averia' => $ver[5],
            'problema_equipo' => $ver[6],
            'detalle_equipo' => $ver[7],
            'ticket_atencion' => $ver[8],
            'fecha_ticket_atencion' => $ver[9],
            'numero_ticket' => $ver[10],
            'contacto1' => $ver[11],
            'celular1' => $ver[12],
            'contacto2' => $ver[13],
            'celular2' => $ver[14],
            'numero_problema' => $ver[11],
            'zonal_telefonica' => $ver[12],
            'comentario_ejecutivo' => $ver[13],
            'id_validador' => $ver[14],
            'casosf' => $ver[15],
            'comentario_validador' => $ver[16]
        );
        return $datos;
    }
}
