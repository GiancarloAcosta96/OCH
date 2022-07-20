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
                        ncquiebre.fechaInicio,               
                        ncquiebre.ruc,               
                        ncquiebre.razonsocial,                      
                        ncquiebre.quiebre_servicio,             
                        ncquiebre.quiebre_numero_problema,                
                        ncquiebre.fechaActivacion,                
                        ncquiebre.quiebre_tipo_averia,                                          
                        ncquiebre.fechaInicio,     
                        ncquiebre.quiebre_problemas,                   
                        ncquiebre.quiebre_detalle,            
                        ncquiebre.quiebre_contacto1,         
                        ncquiebre.quiebre_celular1,               
                        ncquiebre.quiebre_contacto2,     
                        ncquiebre.quiebre_celular2,                   
                        ncquiebre.quiebre_ticket,     
                        ncquiebre.quiebre_numero_ticket,          
                        ncquiebre.fechaTicket,         
                        ncquiebre.ncregion,      
                        ncquiebre.quiebre_observaciones,              
                        ncquiebre.fecha_validacion,
                        ncquiebre.id_validador,
                        ncquiebre.validacion,
                        ncquiebre.comentario_validador                      

                        from quiebre as ncquiebre inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
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
            'fechaInicio' => $ver[1],
            'ncrucs' => $ver[2],
            'ncrazonsocials' => $ver[3],
            'quiebre_servicios' => $ver[4],
            'quiebre_numero_problemas' => $ver[5],
            'fechaActivacion' => $ver[6],
            'quiebre_tipo_averias' => $ver[7],
            'fechaInicios' => $ver[8],
            'quiebre_problemas' => $ver[9],
            'quiebre_detalles' => $ver[10],
            'quiebre_contacto1' => $ver[11],
            'quiebre_celular1' => $ver[12],
            'quiebre_contacto2' => $ver[13],
            'quiebre_celular2' => $ver[14],
            'quiebre_tickets' => $ver[15],
            'quiebre_numero_tickets' => $ver[16],
            'fechaTickets' => $ver[17],
            'ncregions' => $ver[18],
            'ncrucss' => $ver[19],
            'ncrazonss' => $ver[20],
            'quiebre_tipo_averiass' => $ver[21],
            'casof' => $ver[22],
            'fechavalidacions' => $ver[23],
            'ncobservacioness' => $ver[24],
            'ncvalidadors' => $ver[25],
            'ncvalidacions' => $ver[26],
            'ncobservacionesvals' => $ver[27],
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

        $sql = "SELECT  ncquiebre.q_lineas,
                        ncquiebre.modalidad,
                        ncquiebre.cargo_fijo,
                        ncquiebre.ruc,
                        ncquiebre.razon_social,
                        ncquiebre.contacto,
                        ncquiebre.telefono1,
                        ncquiebre.correo,
                        ncquiebre.dni,
                        t.nombre,
                        usu.personal,
                        ncquiebre.comentario_ejecutivo,
                        ncquiebre.estado,
                        ncquiebre.casosf,
                        ncquiebre.comentario_validador  

                        from quiebre as ncquiebre inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
                        left join tienda as t on t.id_tienda=ncquiebre.zonal_telefonica
                        where id_quiebre ='$idquiebre' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $datos = array(
            'q_lineas' => $ver[0],
            'modalidad' => $ver[1],
            'cargo_fijo' => $ver[2],
            'ruc' => $ver[4],
            'razon_social' => $ver[3],
            'contacto' => $ver[5],
            'telefono1' => $ver[6],
            'correo' => $ver[7],
            'dni' => $ver[8],
            'zonal' => $ver[9],
            'personal' => $ver[10],
            'comentario' => $ver[11],
            'estado' => $ver[12],
            'casosf' => $ver[13],
            'comentario_validador' => $ver[14]

        );
        return $datos;
    }
}
