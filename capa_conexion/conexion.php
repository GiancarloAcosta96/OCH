<?php

class conectar {

    public function conexion() {
     $servername = "localhost";
		$database = "onechann_bdsnewsistema";
       $username = "root";
        $password = "";
        $conexion = mysqli_connect($servername, $username, $password, $database);
        return $conexion;
    }
}

