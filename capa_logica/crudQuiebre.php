<?php

class crudQuiebre
{
    public function agregarQuiebremovil($datosquiebre)
    {

        date_default_timezone_set("America/Lima");
        $hoy = date("Y-m-d");

        $obj = new conectar();
        $conexion = $obj->conexion();


        $sqlQuiebre = "INSERT INTO quiebre_movil (
                                            id_usuario,
                                            id_supervisor,
                                            fecha_ingreso,
                                            ruc,
                                            razon_social,
                                            q_lineas,
                                            cargo_fijo,
                                            modalidad,
                                            tipo,
                                            contacto,
                                            telefono1,
                                            correo,
                                            estado,
                                            validacion,
                                            zonal_telefonica,
                                            comentario_ejecutivo,
                                            oportunidad,
                                            nodo,
                                            dni
                                            )
                                    values ('$datosquiebre[0]',
                                            '$datosquiebre[1]',
                                            '$hoy',
                                            '$datosquiebre[5]',
                                            '$datosquiebre[6]',
                                            '$datosquiebre[2]',
                                            '$datosquiebre[4]',
                                            '$datosquiebre[3]',
                                            'QUIEBRE',
                                            '$datosquiebre[7]',
                                            '$datosquiebre[8]',
                                            '$datosquiebre[9]',
                                            'PENDIENTE',
                                            'PENDIENTE',
                                            '$datosquiebre[10]',
                                            '$datosquiebre[11]',
                                            '$datosquiebre[12]',
                                            'SINNODO',
                                            '$datosquiebre[13]'
                                            )";
        $rpta = mysqli_query($conexion, $sqlQuiebre);
        return $rpta;
    }

    public function obtenQuiebreMovil($idquiebre)
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
                        t.nombre,                           
                        usu.personal,                       
                        ncquiebre.comentario_ejecutivo,     
                        ncquiebre.estado,                   
                        ncquiebre.fecha_ingreso,            
                        ncquiebre.fecha_validacion,         
                        ncquiebre.validacion,               
                        ncquiebre.comentario_validador,     
                        ncquiebre.estado,                   
                        ncquiebre.ejecutivo_telefonica,     
                        ncquiebre.comentario_back,          
                        ncquiebre.zonal_telefonica,         
                        ncquiebre.fecha_actualizacion,      
                        ncquiebre.oportunidad,              
                        ncquiebre.id_cartera,               
                        ncquiebre.nodo,                     
                        ncquiebre.dni,
                        ncquiebre.casosf                       

                        from quiebre_movil as ncquiebre inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
                        left join tienda as t on t.id_tienda=ncquiebre.zonal_telefonica
                        where id_quiebre ='$idquiebre' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $sqlsup = "SELECT sup.nombre
                    from quiebre_movil as ncquiebre inner join supervisor as sup on ncquiebre.id_supervisor=sup.id_supervisor
                   
                    where id_quiebre ='$idquiebre' ";

        $resultsup = mysqli_query($conexion, $sqlsup);
        $versup = mysqli_fetch_array($resultsup);


        $sqlval = "SELECT usu.personal
                    from quiebre_movil as ncquiebre inner join usuario as usu on ncquiebre.id_validador=usu.id_usuario
                   
                    where id_quiebre ='$idquiebre' ";

        $resultval = mysqli_query($conexion, $sqlval);
        $verval = mysqli_fetch_array($resultval);


        $datos = array(
            'q_lineas' => $ver[0],
            'modalidad' => $ver[1],
            'cargo_fijo' => $ver[2],
            'ruc' => $ver[3],
            'razon_social' => $ver[4],
            'contacto' => $ver[5],
            'telefono1' => $ver[6],
            'correo' => $ver[7],
            'zonal' => $ver[8],
            'personal' => $ver[9],
            'comentario' => $ver[10],
            'estado' => $ver[11],
            'fecha_ingreso' => $ver[12],
            'supervisor' => $versup[0],
            'fecha_validacion' => $ver[13],
            'validacion' => $ver[14],
            'validador' => $verval[0],
            'comentario_validador' => $ver[15],
            'estado_actual' => $ver[16],
            'ejecutivo_telefonica' => $ver[22],
            'comentario_back' => $ver[18],
            'zonal_telefonica' => $ver[19],
            'fecha_actualizacion' => $ver[20],
            'oportunidad' => $ver[21],
            'nodo' => $ver[23],
            'dni' => $ver[24],
            'casosf' => $ver[25],
        );
        return $datos;
    }

    public function agregarQuiebreComentario($datos)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();
        $sqlquiebreMovil = "UPDATE quiebre_movil SET 
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


        $sqlquiebreMovil = "UPDATE quiebre_movil 
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

                        from quiebre_movil as ncquiebre inner join usuario as usu on ncquiebre.id_usuario=usu.id_usuario
                        left join tienda as t on t.id_tienda=ncquiebre.zonal
                        where id_quiebre ='$idquiebre' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $datos = array(
            'q_lineas' => $ver[0],
            'modalidad' => $ver[1],
            'cargo_fijo' => $ver[2],
            'ruc' => $ver[3],
            'razon_social' => $ver[4],
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
