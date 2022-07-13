<?php

class crudSupervisor {

    public function obtenDatos() {
        $datos=array();
        $obj = new conectar();
        $conexion = $obj->conexion();

        $sql = "SELECT id_supervisor , nombre from supervisor where estado=0 ";
       
        $result = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_array($result)) {

            $datos[] = $row;
        }

       
        return $datos;


    }

}

?>