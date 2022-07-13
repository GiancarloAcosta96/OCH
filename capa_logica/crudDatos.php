<?php

class crud
{

    public function obtenDatos($ruc)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();

        $sql = "SELECT d.razon_social
					from datos as d 
					where ruc ='$ruc' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $datos = array(
            'razon_social' => $ver[0]
        );
        return $datos;
    }


    public function obtenRuc($nvoruc)
    {
        $obj = new conectar();
        $conexion = $obj->conexion();

        $sql = "SELECT d.estado,d.razon_social,d.ruc
                    from datos as d 
                    where ruc ='$nvoruc' ";

        $result = mysqli_query($conexion, $sql);
        $ver = mysqli_fetch_array($result);

        $datos = array(
            'estado' => $ver[0],
            'razon_social' => $ver[1],
            'ruc' => $ver[2]



        );
        return $datos;
    }


    public function SubirDatos()
    {
        $obj = new conectar();
        $conexion = $obj->conexion();


        $sql = "SELECT zonal, id_tienda, id_usuario, estado, ruc, razon_social, cliente_movistar, q_movistar, q_entel, q_claro, q_bitel, origen, fecha_asignacion, tipo_data, nodo
                    from datos_temporal  ";

        $result = mysqli_query($conexion, $sql);

        while ($mostrar = mysqli_fetch_array($result)) {

            $sqlid = "SELECT id_cliente
                        from datos where ruc='$mostrar[4]'";

            $resultid = mysqli_query($conexion, $sqlid);

            $total = mysqli_num_rows($resultid);

            if ($total === 0) {

                $transac = "INSERT INTO datos ( zonal, id_tienda, id_usuario, estado, ruc, razon_social, cliente_movistar, q_movistar, q_entel, q_claro, q_bitel, origen, fecha_asignacion, tipo_data, nodo) VALUES ('$mostrar[0]','$mostrar[1]','$mostrar[2]','$mostrar[3]','$mostrar[4]','$mostrar[5]','$mostrar[6]','$mostrar[7]','$mostrar[8]','$mostrar[9]','$mostrar[10]','$mostrar[11]','$mostrar[12]','$mostrar[13]','$mostrar[14]')";
            } else {

                $verid = mysqli_fetch_array($resultid);

                $transac = "UPDATE datos SET zonal='$mostrar[0]',id_tienda='$mostrar[1]',id_usuario='$mostrar[2]',estado='$mostrar[3]',ruc='$mostrar[4]',razon_social='$mostrar[5]',cliente_movistar='$mostrar[6]',q_movistar='$mostrar[7]',q_entel='$mostrar[8]',q_claro='$mostrar[9]',q_bitel='$mostrar[10]',origen='$mostrar[11]',fecha_asignacion='$mostrar[12]',tipo_data='$mostrar[13]',nodo='$mostrar[14]' WHERE id_cliente='$verid[0]'";
            }

            $resultransac = mysqli_query($conexion, $transac);
        }



        return $resultransac;
    }
}
